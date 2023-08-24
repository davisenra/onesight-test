<?php

declare(strict_types=1);

namespace App\Auth\Controller;

use App\User\Entity\User;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;

class LoginController
{
    #[Route('/login', name: 'login', methods: 'POST')]
    public function authenticate(#[CurrentUser] ?User $user): Response
    {
        return new JsonResponse([
            'status' => true,
            'message' => 'You\'re now authenticated',
        ], Response::HTTP_OK);
    }
}