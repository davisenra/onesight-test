<?php

declare(strict_types=1);

namespace App\Task\Controller;

use App\Task\Dto\CreateTaskDto;
use App\Task\Service\TaskService;
use App\User\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class TaskController extends AbstractController
{
    public function __construct(
        private readonly TaskService $taskService,
        private readonly SerializerInterface $serializer
    ) {
    }

    #[Route('/v1/tasks', name: 'tasks_all', methods: 'GET')]
    public function index(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $tasks = $this->taskService->allTasksByUser($user);

        $data  = [
            'status' => true,
            'data' => $tasks,
        ];

        return JsonResponse::fromJsonString(
            $this->serializer->serialize($data, 'json'),
            Response::HTTP_OK
        );
    }

    #[Route('/v1/tasks', name: 'tasks_create', methods: 'POST')]
    public function store(#[MapRequestPayload] CreateTaskDto $payload): Response
    {

    }
}