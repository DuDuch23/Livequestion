<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use App\Repository\UserRepository;
use App\Repository\ThematicRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(AuthenticationUtils $authenticationUtils, QuestionRepository $questionRepository,
    UserRepository $userRepository, ThematicRepository $thematicRepository): Response
    {
        // Login
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();
        
        
        // GetQuestions
        $lastQuestion = $questionRepository->getLastQuestion();

        $threeLastQuestion = $questionRepository->getThreeLastQuestion();

        $fiveBestUser = $userRepository->getFiveBestUser();

        $threeQuestionsWithThematicSport = $questionRepository->getThreeQuestionsWithThematicSport('Sport');
        $thematicSport = $threeQuestionsWithThematicSport[0]->getThematicId();
        
        $threeRandomQuestion = $questionRepository->getThreeRandomQuestion();

        $bigRandomQuestion = $threeRandomQuestion['bigRandomQuestion'];
        $twoLittleRandomQuestion = $threeRandomQuestion['twoLittleRandomQuestion'];

        $rankedUsers = [];
        $rank = 1;
        foreach($fiveBestUser as $user){
            $userData = [
                'username' => $user['username'],
                'num_questions' => $user['num_questions'],
                'rank' => $rank++,
            ];
            $rankedUsers[] = $userData;
        }

        $thematics = $thematicRepository->findAll();

        //dd($threeQuestionsWithThematicSport, $thematicSport);

        return $this->render('home/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'lastQuestion' => $lastQuestion,
            'threeLastQuestion' => $threeLastQuestion,
            'fiveBestUser' => $rankedUsers,
            'rankedUsers' => $rankedUsers,
            'threeQuestionsWithThematicSport' => $threeQuestionsWithThematicSport,
            'thematicSport' => $thematicSport,
            'bigRandomQuestion' => $bigRandomQuestion,
            'twoLittleRandomQuestion' => $twoLittleRandomQuestion,
            'thematics' => $thematics,
        ]);
    }
}