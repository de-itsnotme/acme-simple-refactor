<?php

declare(strict_types=1);

namespace Test\ValueObject;

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
        $this->expectException(\InvalidArgumentException::class);

        $tokenId = '';
        new Token($tokenId);
    }

    public function testTokenWithInvalidTokenStringThrowsException(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        $tokenId = 'A!B';
        new Token($tokenId);
    }
}
