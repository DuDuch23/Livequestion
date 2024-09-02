<?php

namespace App\Controller;

use App\Entity\Reponse;
use App\Form\ResponseType;
use App\Repository\QuestionRepository;
use App\Repository\ReponseRepository;
use App\Repository\ThematicRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class ReponseController extends AbstractController
{
    #[Route('/reponse/{id}', name: 'reponse')]
    #[IsGranted('ROLE_USER')]
    public function index($id, QuestionRepository $questionRepository, Request $request, Security $security,
    EntityManagerInterface $entityManagerInterface, ThematicRepository $thematicRepository,
    ReponseRepository $reponseRepository): Response
    {
        $question = $questionRepository->find($id);

        $responses = $reponseRepository->findByQuestion($question);

        $thematics = $thematicRepository->findAll();

        $response = new Reponse();
        $form = $this->createForm(ResponseType::class, $response);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $user = $security->getUser();
            $response->setQuestion($question);
            $response->setUser($user);
            //dd($response, $question);
            $entityManagerInterface->persist($response);
            $entityManagerInterface->flush();
            return $this->redirectToRoute('reponse', [
                'id'=> $question->getId(),
                'question' => $question,
            ]);
        }
        else{
            $this->addFlash('error', 'Le formulaire contient des erreurs');
        }


        //dd($question, $responses);
        return $this->render('reponse/index.html.twig', [
            'question' => $question,
            'responses' => $responses,
            'form' => $form,
            'thematics' => $thematics,
        ]);
    }
}
