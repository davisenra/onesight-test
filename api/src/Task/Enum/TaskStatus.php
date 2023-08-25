<?php

declare(strict_types=1);

namespace App\Task\Enum;

enum TaskStatus: string
{
    case PENDING = 'pending';
    case DONE = 'done';
}
