<?php

declare(strict_types=1);

namespace App\Task\Dto;

use Symfony\Component\Validator\Constraints as Assert;

class CreateTaskDto
{
    public function __construct(
        #[Assert\NotBlank]
        #[Assert\Type('string')]
        #[Assert\Length(min: 3, max: 255)]
        public readonly string $title,

        #[Assert\Type('string')]
        #[Assert\Length(min: 3, max: 255)]
        public readonly ?string $description,
    ) {
    }
}