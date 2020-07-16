<?php
/**
 * Class PermissionSeeder
 * Inserts permissions
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AuthSeeder extends Seeder
{
    public function run()
    {
        helper('auth');

        $groups = [['id' => 1, 'name' => 'superadmin', 'description' => '']];

        /** Build permissions array as a list of:
         *
         * ```
         * context => [
         *      [action, description],
         *      [action, description],
         *      ...
         * ]
         * ```
         */
        $permissions = [
            'users' => [
                ['name' => 'create', 'description' => 'Create a user'],
                ['name' => 'list', 'description' => 'List all users'],
                [
                    'name' => 'manage_authorizations',
                    'description' =>
                        'Add or remove roles/permissions to a user',
                ],
                [
                    'name' => 'manage_bans',
                    'description' => 'Ban / unban a user',
                ],
                [
                    'name' => 'force_pass_reset',
                    'description' =>
                        'Force a user to update his password upon next login',
                ],
                [
                    'name' => 'delete',
                    'description' =>
                        'Delete user without removing him from database',
                ],
                [
                    'name' => 'delete_permanently',
                    'description' =>
                        'Delete all occurrences of a user from the database',
                ],
            ],
            'podcasts' => [
                ['name' => 'create', 'description' => 'Add a new podcast'],
                [
                    'name' => 'list',
                    'description' => 'List all podcasts and their episodes',
                ],
                ['name' => 'edit', 'description' => 'Edit any podcast'],
                [
                    'name' => 'manage_contributors',
                    'description' => 'Add / remove contributors to a podcast',
                ],
                [
                    'name' => 'manage_publication',
                    'description' => 'Publish / unpublish a podcast',
                ],
                [
                    'name' => 'delete',
                    'description' =>
                        'Delete a podcast without removing it from database',
                ],
                [
                    'name' => 'delete_permanently',
                    'description' => 'Delete any podcast from the database',
                ],
            ],
            'episodes' => [
                [
                    'name' => 'list',
                    'description' => 'List all episodes of any podcast',
                ],
                [
                    'name' => 'create',
                    'description' => 'Add a new episode to any podcast',
                ],
                ['name' => 'edit', 'description' => 'Edit any podcast episode'],
                [
                    'name' => 'manage_publications',
                    'description' => 'Publish / unpublish any podcast episode',
                ],
                [
                    'name' => 'delete',
                    'description' =>
                        'Delete any podcast episode without removing it from database',
                ],
                [
                    'name' => 'delete_permanently',
                    'description' => 'Delete any podcast episode from database',
                ],
            ],
        ];

        // Map permissions to a format the `auth_permissions` table expects
        $data_permissions = [];
        $data_groups_permissions = [];
        $permission_id = 0;
        foreach ($permissions as $context => $actions) {
            foreach ($actions as $action) {
                array_push($data_permissions, [
                    'id' => ++$permission_id,
                    'name' => get_permission($context, $action['name']),
                    'description' => $action['description'],
                ]);

                // add all permissions to superadmin
                array_push($data_groups_permissions, [
                    'group_id' => 1,
                    'permission_id' => $permission_id,
                ]);
            }
        }

        $this->db->table('auth_permissions')->insertBatch($data_permissions);
        $this->db->table('auth_groups')->insertBatch($groups);
        $this->db
            ->table('auth_groups_permissions')
            ->insertBatch($data_groups_permissions);

        // TODO: Remove superadmin user as it is used for testing purposes
        $this->db->table('users')->insert([
            'id' => 1,
            'username' => 'admin',
            'email' => 'admin@castopod.com',
            'password_hash' =>
                // password: AGUehL3P
                '$2y$10$TXJEHX/djW8jtzgpDVf7dOOCGo5rv1uqtAYWdwwwkttQcDkAeB2.6',
            'active' => 1,
        ]);
        $this->db
            ->table('auth_groups_users')
            ->insert(['group_id' => 1, 'user_id' => 1]);
    }
}
