<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Exception\InvalidTokenException;

class Token
{
    public readonly string $tokenId;

    public function __construct(?string $tokenId)
    {
        if (empty($tokenId)) {
            throw new InvalidTokenException('Token ID cannot be empty.');
        }

        if (!preg_match('/^[a-zA-Z0-9]+$/', $tokenId)) {
            throw new InvalidTokenException('String must contain only letters and numbers (A–Z, a–z, 0-9).');
        }

        $this->tokenId = $tokenId;
    }

    public function __toString(): string
    {
        return $this->tokenId;
    }

    public function isEquivalent(Token $otherToken): bool
    {
        return $this->tokenId === $otherToken->tokenId;
    }
}
