<?php

declare(strict_types=1);

namespace Test\ValueObject;

use App\Exception\InvalidTokenException;
use App\ValueObject\Token;
use PHPUnit\Framework\TestCase;

class TokenTest extends TestCase
{
    public function testTokenIsCreatedForValidTokenString(): void
    {
        $tokenId = 'token1234';
        $token = new Token($tokenId);

        $this->assertEquals($tokenId, $token->tokenId);
    }

    public function testTokenWithEmptyStringThrowsException(): void
    {
        $this->expectException(InvalidTokenException::class);

        $tokenId = '';

        new Token($tokenId);
    }

    public function testTokenWithInvalidTokenStringThrowsException(): void
    {
        $this->expectException(InvalidTokenException::class);

        $tokenId = 'A!B';

        new Token($tokenId);
    }
}
