<?php

declare(strict_types=1);

namespace App\ValueObject;

use App\Enum\PermissionEnum;

class TokenPermissionsCollection
{
    /** @var array<int, TokenPermissions> */
    private array $tokenPermissionsCollection;

    /**
     * @param array<array{token: string, permissions: array<string>}> $tokenPermissionsData
     */
    public function __construct(array $tokenPermissionsData)
    {
        $this->tokenPermissionsCollection = [];

        foreach ($tokenPermissionsData as $tokenPermissionData) {
            $token = new Token($tokenPermissionData['token']);
            $permissions = $this->mapPermissions($tokenPermissionData['permissions']);

            $this->tokenPermissionsCollection[] = new TokenPermissions($token, $permissions);
        }
    }

    private function findTokenPermissionsByTokenId(Token $token): ?TokenPermissions
    {
        foreach ($this->tokenPermissionsCollection as $tokenPermission) {
            if ($token->isEquivalent($tokenPermission->token)) {
                return $tokenPermission;
            }
        }

        return null;
    }

    public function hasPermission(Token $token, PermissionEnum $permission): bool
    {
        $tokenPermission = $this->findTokenPermissionsByTokenId($token);

        if ($tokenPermission === null) {
            return false;
        }

        return in_array($permission, $tokenPermission->permissions);
    }

    /**
     * @param array<string> $availablePermissions
     *
     * @return array<int, PermissionEnum>
     */
    public function mapPermissions(array $availablePermissions): array
    {
        $permissions = [];

        foreach ($availablePermissions as $permissionData) {
            $validPermission = PermissionEnum::tryFrom($permissionData);

            if ($validPermission !== null) {
                $permissions[] = $validPermission;
            }
        }

        return $permissions;
    }
}
