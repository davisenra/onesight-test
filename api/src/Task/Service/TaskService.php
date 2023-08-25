<?php

declare(strict_types=1);

namespace App\Task\Service;

use App\Task\Entity\Task;
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
}