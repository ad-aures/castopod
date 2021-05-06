<?php

namespace App\Authorization;

class FlatAuthorization extends \Myth\Auth\Authorization\FlatAuthorization
{
    /**
     * Checks a group to see if they have the specified permission.
     *
     * @param int|string $permission
     */
    public function groupHasPermission($permission, int $groupId): bool
    {
        // Get the Permission ID
        $permissionId = $this->getPermissionID($permission);

        if (!is_numeric($permissionId)) {
            return false;
        }

        return (bool) $this->permissionModel->doesGroupHavePermission(
            $groupId,
            $permissionId,
        );
    }

    /**
     * Makes user part of given groups.
     *
     * @param array $groups Either collection of ID or names
     */
    public function setUserGroups(int $userId, array $groups = []): bool
    {
        // remove user from all groups before resetting it in new groups
        $this->groupModel->removeUserFromAllGroups($userId);

        if ($groups = []) {
            return true;
        }

        foreach ($groups as $group) {
            $this->addUserToGroup($userId, $group);
        }

        return true;
    }
}
