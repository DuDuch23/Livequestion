<?php

namespace App\Controller;

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

    #[Route('/auteur/profil/{id}', name: 'profil_auteur')]
    public function afficherProfil($id, UserRepository $userRepository): Response
    {
        $user = $userRepository->find($id);

        return $this->render('auteur/profil.html.twig', [
            'user'=> $user,
        ]);
    }
}
