<?php

declare(strict_types=1);

namespace App\ValueObject;

use InvalidArgumentException;

class Token
{
    public readonly string $tokenId;

    public function __construct(?string $tokenId)
    {
        if (empty($tokenId)) {
            throw new InvalidArgumentException('Token ID cannot be empty');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $tokenId)) {
            throw new InvalidArgumentException('String must contain only letters (A–Z, a–z).');
        }


        $this->tokenId = $tokenId;
    }

    public function isEquivalent(Token $otherToken): bool
    {
        return $this->tokenId === $otherToken->tokenId;
    }
}
