<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Enum\PermissionEnum;

class TokenPermissions
{
    /**
     * @param Token $token
     * @param array<PermissionEnum> $permissions
     */
    public function __construct(public readonly Token $token, public readonly array $permissions)
    {
    }
}
