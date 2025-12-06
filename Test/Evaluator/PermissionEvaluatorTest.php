<?php

declare(strict_types=1);

namespace Test\Evaluator;

use App\Evaluator\PermissionEvaluator;
use App\Provider\TokenDataProvider;
use App\ValueObject\Token;
use PHPUnit\Framework\TestCase;

class PermissionEvaluatorTest extends TestCase
{
    public function testValidTokenWithValidPermissionsShouldReturnTrue(): void
    {
        $tokenDataProviderMock = $this->createMock(TokenDataProvider::class);
        $tokenDataProviderMock->method('getTokens')->willReturn(
            [
                ['token' => 'token1234', 'permissions' => ['read', 'write']],
                ['token' => 'tokenReadonly', 'permissions' => ['read']],
            ]
        );

        $permissionEvaluator = new PermissionEvaluator($tokenDataProviderMock);

        $token = new Token('token1234');
        $this->assertTrue($permissionEvaluator->hasPermission($token));
    }

    public function testInvalidTokenWithValidPermissionsShouldReturnFalse(): void
    {
        $tokenDataProviderMock = $this->createMock(TokenDataProvider::class);
        $tokenDataProviderMock->method('getTokens')->willReturn(
            [
                ['token' => 'token1234', 'permissions' => ['read', 'write']],
                ['token' => 'tokenReadonly', 'permissions' => ['read']],
            ]
        );

        $permissionEvaluator = new PermissionEvaluator($tokenDataProviderMock);

        $token = new Token('invalidTokenId');
        $this->assertFalse($permissionEvaluator->hasPermission($token));
    }

    public function testValidTokenIdWithInValidPermissionsShouldReturnFalse(): void
    {
        $tokenDataProviderMock = $this->createMock(TokenDataProvider::class);
        $tokenDataProviderMock->method('getTokens')->willReturn(
            [
                ['token' => 'token1234', 'permissions' => ['a', 'b']],
                ['token' => 'tokenReadonly', 'permissions' => ['c']],
            ]
        );

        $permissionEvaluator = new PermissionEvaluator($tokenDataProviderMock);

        $token = new Token('token1234');
        $this->assertFalse($permissionEvaluator->hasPermission($token));
    }
}
