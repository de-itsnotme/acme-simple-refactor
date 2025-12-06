<?php

declare(strict_types=1);

namespace App\Factory;

use App\ValueObject\Token;

class TokenFactory implements TokenFactoryInterface
{
    public function createTokenById(?string $tokenId): Token
    {
        return new Token($tokenId);
    }
}
