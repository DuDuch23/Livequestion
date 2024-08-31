<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use App\Repository\ThematicRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
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

    #[Route('/auteur/profil/{username}', name: 'profil_auteur')]
    public function afficherProfil($username, UserRepository $userRepository, QuestionRepository $questionRepository): Response
    {
        $user = $userRepository->findOneBy(['username' => $username]);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        $questions = $questionRepository->findQuestionsByUser($user->getId());

        //dd($user);

        return $this->render('auteur/profil.html.twig', [
            'user' => $user,
            'questions' => $questions,
        ]);
    }

    #[Route('/auteur/monprofil/{username}', name: 'mon_profil_auteur')]
    public function afficherMonProfil($username, UserRepository $userRepository, QuestionRepository $questionRepository): Response
    {
        $user = $userRepository->findOneBy(['username'=> $username]);

        if (!$user) {
            throw $this->createNotFoundException('Utilisateur non trouvé');
        }

        $questions = $questionRepository->findQuestionsByUser($user->getId());

        return $this->render('auteur/profil.html.twig', [
            'user' => $user,
            'questions' => $questions,
        ]);
    }
}
