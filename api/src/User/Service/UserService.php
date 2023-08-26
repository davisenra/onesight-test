<?php

declare(strict_types=1);

namespace App\User\Service;

use App\User\Repository\UserRepository;

class UserService
{
    public function __construct(
        private readonly UserRepository $userRepository
    ) {
    }
}