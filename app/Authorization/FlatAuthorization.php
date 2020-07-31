<?php namespace App\Authorization;

class FlatAuthorization extends \Myth\Auth\Authorization\FlatAuthorization
{
    //--------------------------------------------------------------------
    // Actions
    //--------------------------------------------------------------------

    /**
     * Checks a group to see if they have the specified permission.
     *
     * @param int|string $permission
     * @param int        $groupId
     *
     * @return mixed
     */
    public function groupHasPermission($permission, int $groupId)
    {
        if (
            empty($permission) ||
            (!is_string($permission) && !is_numeric($permission))
        ) {
            return null;
        }

        if (empty($groupId) || !is_numeric($groupId)) {
            return null;
        }

        // Get the Permission ID
        $permissionId = $this->getPermissionID($permission);

        if (!is_numeric($permissionId)) {
            return false;
        }

        if (
            $this->permissionModel->doesGroupHavePermission(
                $groupId,
                (int) $permissionId
            )
        ) {
            return true;
        }

        return false;
    }

    /**
     * Makes a member a part of multiple groups.
     *
     * @param $user_id
     * @param array|null $groups // Either collection of ID or names
     *
     * @return bool
     */
    public function setUserGroups(int $user_id, $groups)
    {
        if (empty($user_id) || !is_numeric($user_id)) {
            return null;
        }

        // remove user from all groups before resetting it in new groups
        $this->groupModel->removeUserFromAllGroups($user_id);

        if (empty($groups)) {
            return true;
        }

        foreach ($groups as $group) {
            $this->addUserToGroup($user_id, $group);
        }

        return true;
    }
}
