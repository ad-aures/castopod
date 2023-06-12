<?php

declare(strict_types=1);

/**
 * Class TestSeeder Inserts a superadmin user in the database
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run(): void
    {
        helper('setting');

        /**
         * Inserts an owner with the following credentials: admin: `admin@example.com` password: `AGUehL3P`
         */
        $this->db->table('users')
            ->insert([
                'id'       => 1,
                'username' => 'admin',
                'is_owner' => 1,
            ]);

        $this->db->table('auth_identities')
            ->insert([
                'id'      => 1,
                'user_id' => 1,
                'type'    => 'email_password',
                'secret'  => 'admin@example.com',
                'secret2' => '$2y$10$TXJEHX/djW8jtzgpDVf7dOOCGo5rv1uqtAYWdwwwkttQcDkAeB2.6',
            ]);

        $this->db
            ->table('auth_groups_users')
            ->insert([
                'user_id' => 1,
                'group'   => setting('AuthGroups.mostPowerfulGroup'),
            ]);
    }
}
