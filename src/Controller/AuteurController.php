<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\QuestionType;
use App\Form\UserType;
use App\Repository\QuestionRepository;
use App\Repository\ThematicRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Attribute\Route;

class AuteurController extends AbstractController
{
    #[Route('/auteur', name: 'auteur')]
    public function index(UserRepository $userRepository, ThematicRepository $thematicRepository, Request $request): Response
    {
        $users = $userRepository->findAll();

        $thematics = $thematicRepository->findall();


        return $this->render('auteur/index.html.twig', [
            'users' => $users,
            'thematics' => $thematics
        ]);
    }

    #[Route('/inscription', name: 'inscription')]
    public function inscription(Request $request, EntityManagerInterface $entityManagerInterface,
    UserPasswordHasherInterface $passwordHasher)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid())
        {
            $hashedPassword = $passwordHasher->hashPassword(
                $user,
                $user->getPassword()
            );
            $user->setPassword($hashedPassword);

            $entityManagerInterface->persist($user);
            $entityManagerInterface->flush();

            return $this->redirectToRoute('home', [
                'id' => $user->getId(),
            ]);
        }else{
            $this->addFlash('error', 'Le formulaire contient des erreurs');
        }

        return $this->render('inscription/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/auteur/profil/{username}', name: 'profil_auteur')]
    public function afficherProfil($username, UserRepository $userRepository, QuestionRepository $questionRepository, ThematicRepository $thematicRepository): Response
    {
        $user = $userRepository->findOneBy(['username' => $username]);

        $thematics = $thematicRepository->findAll();

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        $questions = $questionRepository->findQuestionsByUser($user->getId());

        //dd($user);

        return $this->render('auteur/profil.html.twig', [
            'user' => $user,
            'questions' => $questions,
            'thematics' => $thematics,
        ]);
    }

    #[Route('/auteur/monprofil/{username}', name: 'mon_profil')]
    public function afficherMonProfil($username, UserRepository $userRepository, QuestionRepository $questionRepository, ThematicRepository $thematicRepository): Response
    {
        $user = $userRepository->findOneBy(['username'=> $username]);

        $thematics = $thematicRepository->findAll();

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        $questions = $questionRepository->findQuestionsByUser($user->getId());

        return $this->render('auteur/profil.html.twig', [
            'user' => $user,
            'questions' => $questions,
            'thematics' => $thematics,
        ]);
    }

    #[Route('/question/edit/{id}', name: 'modifier_ma_question')]
    public function editQuestion($id, Request $request, QuestionRepository $questionRepository,
    EntityManagerInterface $entityManager, ThematicRepository $thematicRepository): Response
    {
        // Récupération de la question par son ID
        $question = $questionRepository->find($id);

        $thematics = $thematicRepository->findAll();

        if (!$question) {
            throw $this->createNotFoundException('Question non trouvée');
        }

        // Vérifie si l'utilisateur connecté est l'auteur de la question
        if ($question->getAuthor() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous ne pouvez modifier que vos propres questions.');
        }

        // Création et gestion du formulaire
        $form = $this->createForm(QuestionType::class, $question);

        try{
            $form->handleRequest($request);
    
            if ($form->isSubmitted() && $form->isValid())
            {
                $entityManager->flush();
    
                // Redirige vers le profil après modification
                return $this->redirectToRoute('mon_profil', [
                    'username' => $this->getUser()->getUserIdentifier(),
                ]);
            }
            else{
                $this->addFlash('error','Le formulaire contient des erreurs');
            }
        }catch(Exception $e){
            echo $e;
        }

        return $this->render('auteur/edit.html.twig', [
            'form' => $form->createView(),
            'question' => $question,
            'thematics'=> $thematics,
        ]);
    }
}
