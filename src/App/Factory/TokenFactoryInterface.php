<?php

declare(strict_types=1);

namespace App\Factory;

use App\ValueObject\Token;

interface TokenFactoryInterface
{
    public function createTokenById(?string $tokenId): Token;
}
