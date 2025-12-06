<?php

declare(strict_types=1);

namespace App\Evaluator;

use App\Enum\PermissionEnum;
use App\ValueObject\Token;

interface PermissionEvaluatorInterface
{
    public function hasPermission(Token $inputToken, PermissionEnum $allowedPermission = PermissionEnum::READ): bool;
}
