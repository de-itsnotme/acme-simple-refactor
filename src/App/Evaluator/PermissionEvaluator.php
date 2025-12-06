<?php

declare(strict_types=1);

namespace App\Evaluator;

use App\Enum\PermissionEnum;
use App\Provider\TokenDataProvider;
use App\ValueObject\Token;
use App\ValueObject\TokenPermissionsCollection;

class PermissionEvaluator implements PermissionEvaluatorInterface
{
    public function __construct(private readonly TokenDataProvider $tokenDataProvider)
    {
    }
    
    public function hasPermission(Token $inputToken, PermissionEnum $allowedPermission = PermissionEnum::READ): bool
    {
        $tokensData = $this->tokenDataProvider->getTokens();
        $tokenPermissionsCollection = new TokenPermissionsCollection($tokensData);

        return $tokenPermissionsCollection->hasPermission($inputToken, $allowedPermission);
    }
}
