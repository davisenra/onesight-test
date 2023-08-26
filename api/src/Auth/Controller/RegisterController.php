<?php

declare(strict_types=1);

namespace App\Auth\Controller;

use App\Auth\Dto\RegisterUserDto;
use App\Auth\Service\RegisterService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    public function __construct(
        private readonly RegisterService $registerService
    ) {
    }

    #[Route('/register', name: 'register', methods: 'POST')]
    public function register(#[MapRequestPayload(acceptFormat: 'json')] RegisterUserDto $payload): Response
    {
        $this->registerService->register($payload);

        return new JsonResponse([
            'status' => true,
            'message' => 'You were registered successfully',
        ], Response::HTTP_CREATED);
    }
}