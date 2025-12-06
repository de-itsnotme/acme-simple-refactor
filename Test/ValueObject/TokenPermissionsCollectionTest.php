<?php

declare(strict_types=1);

namespace Test\ValueObject;

use App\Enum\PermissionEnum;
use App\ValueObject\Token;
use App\ValueObject\TokenPermissionsCollection;
use PHPUnit\Framework\TestCase;

class TokenPermissionsCollectionTest extends TestCase
{
    public function testCreateObject(): void
    {
        $data = [
            ['token' => 'token1234', 'permissions' => ['read', 'write']],
            ['token' => 'tokenReadonly', 'permissions' => ['read']],
        ];

        $tokenPermissionsCollection = new TokenPermissionsCollection($data);

        $token = new Token('token1234');
        $this->assertTrue($tokenPermissionsCollection->hasPermission($token, PermissionEnum::READ));
        $this->assertTrue($tokenPermissionsCollection->hasPermission($token, PermissionEnum::WRITE));

        $token = new Token('tokenReadonly');
        $this->assertTrue($tokenPermissionsCollection->hasPermission($token, PermissionEnum::READ));
        $this->assertFalse($tokenPermissionsCollection->hasPermission($token, PermissionEnum::WRITE));

        $token = new Token('TokenThatCannotBeFound');
        $this->assertFalse($tokenPermissionsCollection->hasPermission($token, PermissionEnum::READ));
    }
}
