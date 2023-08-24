<?php

declare(strict_types=1);

namespace App\Auth\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Email]
        public readonly string $email,

        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Length(min: 12, max: 32)]
        public readonly string $password,
    ) {
    }
}