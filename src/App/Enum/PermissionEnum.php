<?php

declare(strict_types=1);

namespace App\Enum;

enum PermissionEnum: string
{
    case READ = 'read';
    case WRITE = 'write';
}
