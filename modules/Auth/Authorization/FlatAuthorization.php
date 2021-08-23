<?php

declare(strict_types=1);

namespace Modules\Auth\Authorization;

use Myth\Auth\Authorization\FlatAuthorization as MythAuthFlatAuthorization;

class FlatAuthorization extends MythAuthFlatAuthorization
{
    /**
     * The group model to use. Usually the class noted below (or an extension thereof) but can be any compatible
     * CodeIgniter Model.
     *
     * @var PermissionModel
     */
    protected $permissionModel;

    /**
     * Checks a group to see if they have the specified permission.
     */
    public function groupHasPermission(int | string $permission, int $groupId): bool
    {
        // Get the Permission ID
        $permissionId = $this->getPermissionID($permission);

        if (! is_numeric($permissionId)) {
            return false;
        }

        return $this->permissionModel->doesGroupHavePermission($groupId, $permissionId);
    }

    /**
     * Makes user part of given groups.
     *
     * @param array<string, string> $groups Either collection of ID or names
     */
    public function setUserGroups(int $userId, array $groups = []): bool
    {
        // remove user from all groups before resetting it in new groups
        $this->groupModel->removeUserFromAllGroups($userId);

        if ($groups === []) {
            return true;
        }

        foreach ($groups as $group) {
            $this->addUserToGroup($userId, $group);
        }

        return true;
    }
}
