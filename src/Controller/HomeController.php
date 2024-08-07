<?php

namespace App\Controller;

use App\Repository\QuestionRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(AuthenticationUtils $authenticationUtils, QuestionRepository $questionRepository,
    UserRepository $userRepository): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        $lastUsername = $authenticationUtils->getLastUsername();

        $lastQuestion = $questionRepository->getLastQuestion();

        $threeLastQuestion = $questionRepository->getThreeLastQuestion();

        $fiveBestUser = $userRepository->getFiveBestUser();

        $rankedUsers = [];
        $rank = 1;
        foreach($fiveBestUser as $user){
            $user['rank'] = $rank++;
            $rankedUsers[] = $user;
        }

        return $this->render('home/index.html.twig', [
            'last_username' => $lastUsername,
            'error' => $error,
            'lastQuestion' => $lastQuestion,
            'threeLastQuestion' => $threeLastQuestion,
            'fiveBestUser' => $fiveBestUser,
            'rankedUser' => $rankedUsers,
        ]);
    }
}
