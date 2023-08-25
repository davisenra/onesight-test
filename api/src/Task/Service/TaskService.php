<?php

declare(strict_types=1);

namespace App\Task\Service;

use App\Task\Dto\CreateTaskDto;
use App\Task\Entity\Task;
use App\Task\Enum\TaskStatus;
use App\Task\Repository\TaskRepository;
use App\User\Entity\User;

class TaskService
{
    public function __construct(
        private readonly TaskRepository $taskRepository
    ) {
    }

    /**
     * @return Task[]
     */
    public function allTasksByUser(User $user): array
    {
        return $this->taskRepository->findBy(['user' => $user]);
    }

    public function createTaskForUser(User $user, CreateTaskDto $payload): Task
    {
        $task = new Task();
        $task->setUser($user);
        $task->setTitle($payload->title);
        $task->setStatus(TaskStatus::PENDING);

        if ($payload->description) {
            $task->setDescription($payload->description);
        }

        $this->taskRepository->saveOrUpdate($task);

        return $task;
    }

    public function findUserTaskById(User $user, int $taskId): ?Task
    {
        return $this->taskRepository->findOneBy([
            'user' => $user,
            'id' => $taskId
        ]);
    }

    public function toggleTaskStatus(Task $task): void
    {
        if ($task->getStatus() === TaskStatus::PENDING) {
            $task->setStatus(TaskStatus::DONE);
        } else {
            $task->setStatus(TaskStatus::PENDING);
        }

        $this->taskRepository->saveOrUpdate($task);
    }

    public function removeTask(Task $task): void
    {
        $this->taskRepository->delete($task);
    }
}