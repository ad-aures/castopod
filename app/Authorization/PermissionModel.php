<?php

namespace App\Authorization;

class PermissionModel extends \Myth\Auth\Authorization\PermissionModel
{
    /**
     * Checks to see if a user, or one of their groups,
     * has a specific permission.
     *
     * @param $userId
     * @param $permissionId
     *
     * @return bool
     */
    public function doesGroupHavePermission(
        int $groupId,
        int $permissionId
    ): bool {
        // Check group permissions and take advantage of caching
        $groupPerms = $this->getPermissionsForGroup($groupId);

        return count($groupPerms) &&
            array_key_exists($permissionId, $groupPerms);
    }

    /**
     * Gets all permissions for a group in a way that can be
     * easily used to check against:
     *
     * [
     *  id => name,
     *  id => name
     * ]
     *
     * @param int $groupId
     *
     * @return array
     */
    public function getPermissionsForGroup(int $groupId): array
    {
        $cacheName = "group{$groupId}_permissions";
        if (!($found = cache($cacheName))) {
            $groupPermissions = $this->db
                ->table('auth_groups_permissions')
                ->select('id, auth_permissions.name')
                ->join(
                    'auth_permissions',
                    'auth_permissions.id = permission_id',
                    'inner',
                )
                ->where('group_id', $groupId)
                ->get()
                ->getResultObject();

            $found = [];
            foreach ($groupPermissions as $row) {
                $found[$row->id] = strtolower($row->name);
            }

            cache()->save($cacheName, $found, 300);
        }

        return $found;
    }
}
