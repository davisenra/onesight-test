<?php

declare(strict_types=1);

namespace App\Auth\Service;

use App\Auth\Dto\RegisterUserDto;
use App\User\Entity\User;
use App\User\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegisterService
{
    public function __construct(
        private readonly UserRepository $userRepository,
        private readonly UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function register(RegisterUserDto $payload): void
    {
        $emailTaken = $this->userRepository->findBy(['email' => $payload->email]) !== [];

        if ($emailTaken) {
            throw new \Exception('This email is already registered');
        }

        $user = new User();
        $user->setEmail($payload->email);
        $hashedPassword = $this->passwordHasher->hashPassword($user, $payload->password);
        $user->setPassword($hashedPassword);

        $this->userRepository->saveOrUpdate($user);
    }
}