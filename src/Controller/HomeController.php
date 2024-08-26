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
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $lastQuestion = $questionRepository->getLastQuestion();

        $threeLastQuestion = $questionRepository->getThreeLastQuestion();

        $fiveBestUser = $userRepository->getFiveBestUser();

        $threeQuestionRandomSameThematic = $questionRepository->getThreeQuestionSameThematic();
        
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

        //dd($threeLastQuestion, $threeRandomQuestion);

        return $this->render('home/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'lastQuestion' => $lastQuestion,
            'threeLastQuestion' => $threeLastQuestion,
            'fiveBestUser' => $rankedUsers,
            'rankedUsers' => $rankedUsers,
            'threeQuestionRandomSameThematic' => $threeQuestionRandomSameThematic,
            'bigRandomQuestion' => $bigRandomQuestion,
            'twoLittleRandomQuestion' => $twoLittleRandomQuestion,
            'thematics' => $thematics,
        ]);
    }
}