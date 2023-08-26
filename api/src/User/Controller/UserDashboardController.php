<?php

declare(strict_types=1);

namespace App\User\Controller;

use App\Task\Entity\Task;
use App\Task\Enum\TaskStatus;
use App\User\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class UserDashboardController extends AbstractController
{
    public function __construct(
        private readonly SerializerInterface $serializer
    ) {
    }

    #[Route('/v1/dashboard', name: 'dashboard', methods: 'GET')]
    public function dashboard(): Response
    {
        /** @var User $user */
        $user = $this->getUser();
        $userTasks = $user->getTasks();
        $userTasksAsArray = $userTasks->toArray();

        $finishedTasks = array_filter(
            $userTasksAsArray,
            fn(Task $task) => $task->getStatus() === TaskStatus::DONE
        );

        $pendingTasks = array_filter(
            $userTasksAsArray,
            fn(Task $task) => $task->getStatus() === TaskStatus::PENDING
        );

        $weekStart = new \DateTime('now');
        $weekStart->modify('this week');
        $weekStart->setTime(0, 0);

        $createdThisWeek = array_filter(
            $userTasksAsArray,
            fn(Task $task) => $task->getCreatedAt() >= $weekStart
        );

        $data = [
            'user' => [
                'id' => $user->getId(),
                'email' => $user->getEmail(),
                'registredSince' => $user->getCreatedAt()
            ],
            'metadata' => [
                'totalTasks' => count($user->getTasks()),
                'finishedTasks' => count($finishedTasks),
                'pendingTasks' => count($pendingTasks),
                'createdThisWeek' => count($createdThisWeek),
            ],
            'tasks' => $user->getTasks(),
        ];

        return JsonResponse::fromJsonString(
            $this->serializer->serialize($data, 'json'),
            Response::HTTP_OK
        );
    }
}