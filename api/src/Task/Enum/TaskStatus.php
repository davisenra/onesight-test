<?php

declare(strict_types=1);

namespace App\Task\Enum;

enum TaskStatus: int
{
    case PENDING = 0;
    case DONE = 1;
}
