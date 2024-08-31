<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use App\Repository\ThematicRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class QuestionController extends AbstractController
{
    #[Route('/question', name: 'question', methods: ['GET'])]
    public function index(QuestionRepository $questionRepository, UserRepository $userRepository,
    ThematicRepository $thematicRepository, Request $request): Response
    {
        // Récupération de tout les utilisateurs
        $users = $userRepository->findAll();

        // Récupération des thématiques
        $thematics = $thematicRepository->findAll();
        
        // 
        $getTitle = $request->query->get('title');
        $getAuthorName = $request->query->get('authorName');
        $getThematicName = $request->query->get('thematicName');

        // Récupération des questions filtrées par thématique si le paramètre est présent

        // Tableaux des questions trouvées
        $questions = [];

        // pagination
        $countPerPage = 10;
        $currentPage = $request->query->getInt('page', 1);

        // Nombres de questions trouvées
        $totalQuestionFound = 0;

        // Déclaration de l'activation de la pagination
        $activatePaginate = false;

        if ($getTitle && $getAuthorName && $getThematicName)
        {
            $questions = $questionRepository->searchQuestionByTitleAuthorThematic($getTitle, $getAuthorName, $getThematicName, $currentPage, $countPerPage);
            $totalQuestionFound = count($questions);
        } elseif ($getAuthorName && $getThematicName)
        {
            $questions = $questionRepository->searchQuestionByAuthorThematic($getAuthorName, $getThematicName, $currentPage, $countPerPage);
            $totalQuestionFound = count($questions);
        } elseif ($getTitle && $getAuthorName)
        {
            $questions = $questionRepository->searchQuestionByTitleAuthor($getTitle, $getAuthorName, $currentPage, $countPerPage);
            $totalQuestionFound = count($questions);
        } elseif ($getTitle && $getThematicName)
        {
            $questions = $questionRepository->searchQuestionByTitleThematic($getTitle, $getThematicName, $currentPage, $countPerPage);
            $totalQuestionFound = count($questions);
        } elseif ($getTitle)
        {
            $questions = $questionRepository->searchQuestionByTitle($getTitle, $currentPage, $countPerPage);
            $totalQuestionFound = count($questions);
        } elseif ($getAuthorName)
        {
            $questions = $questionRepository->searchQuestionByAuthor($getAuthorName, $currentPage, $countPerPage);
            $totalQuestionFound = count($questions);
        } elseif ($getThematicName)
        {
            $questions = $questionRepository->searchQuestionByThematic($getThematicName, $currentPage, $countPerPage);
            $totalQuestionFound = count($questions);
        }
         else{
            $questions = $questionRepository->paginate('p', $currentPage, $countPerPage);
            $totalQuestionFound = count($questions);
        }

        $countQuestion = $questionRepository->count([]);
        $countPages = ceil($countQuestion / $countPerPage);
        $activatePaginate = true;

        if ($currentPage > $countPages || $currentPage <= 0) {
            return $this->redirectToRoute('question', ['page' => 1]);
        }

        //dd($currentPage, $countPages, $totalQuestionFound);

        return $this->render('question/index.html.twig', [
            'users' => $users,
            'thematics' => $thematics,
            'questions' => $questions,
            'totalQuestionFound' => $totalQuestionFound,
            'countPages' => $countPages,
            'currentPage' => $currentPage
        ]);
    }
}
