<?php

namespace App\Controller;

use App\Entity\User;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ApiLoginController extends AbstractController
{
    #[Route('/api/login', name: 'api_login')]
    public function index(#[CurrentUser] ?User $user): JsonResponse   
    {
        if(null === $user){
            return $this->json([
                'message' => 'pas connecter',
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = 'test';

        return $this->json([
            'user' => $user->getUserIdentifier(),
            'token' => $token,
        ]);
    }
}
