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

    #[Route('/v1/tasks/{id}', name: 'tasks_show', requirements: ['id' => '\d+'], methods: 'GET')]
    public function show(int $id): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $task = $this->taskService->findUserTaskById($user, $id);

        if (!$task) {
            return new JsonResponse([
                'status' => false,
                'message' => 'Resource not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $data  = [
            'status' => true,
            'data' => $task,
        ];

        return JsonResponse::fromJsonString(
            $this->serializer->serialize($data, 'json'),
            Response::HTTP_OK
        );
    }

    #[Route('/v1/tasks', name: 'tasks_create', methods: 'POST')]
    public function store(#[MapRequestPayload] CreateTaskDto $payload): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $task = $this->taskService->createTaskForUser($user, $payload);

        $data  = [
            'status' => true,
            'data' => $task,
        ];

        return JsonResponse::fromJsonString(
            $this->serializer->serialize($data, 'json'),
            Response::HTTP_CREATED
        );
    }

    #[Route('/v1/tasks/{id}/done', name: 'tasks_toggle_status', requirements: ['id' => '\d+'], methods: 'PUT')]
    public function toggleStatus(int $id): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $task = $this->taskService->findUserTaskById($user, $id);

        if (!$task) {
            return new JsonResponse([
                'status' => false,
                'message' => 'Resource not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $this->taskService->toggleTaskStatus($task);

        return new Response(null, Response::HTTP_NO_CONTENT);
    }

    #[Route('/v1/tasks/{id}', name: 'tasks_remove', requirements: ['id' => '\d+'], methods: 'DELETE')]
    public function remove(int $id): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $task = $this->taskService->findUserTaskById($user, $id);

        if (!$task) {
            return new JsonResponse([
                'status' => false,
                'message' => 'Resource not found',
            ], Response::HTTP_NOT_FOUND);
        }

        $this->taskService->removeTask($task);

        return new Response(null, Response::HTTP_NO_CONTENT);
    }
}