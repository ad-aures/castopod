<?php
/**
 * Class TestSeeder
 * Inserts a superadmin user in the database
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class TestSeeder extends Seeder
{
    public function run()
    {
        /** Inserts an active user with the following credentials:
         *      username: admin
         *      password: AGUehL3P
         */
        $this->db->table('users')->insert([
            'id' => 1,
            'username' => 'admin',
            'email' => 'admin@castopod.com',
            'password_hash' =>
                '$2y$10$TXJEHX/djW8jtzgpDVf7dOOCGo5rv1uqtAYWdwwwkttQcDkAeB2.6',
            'active' => 1,
        ]);
        $this->db
            ->table('auth_groups_users')
            ->insert(['group_id' => 1, 'user_id' => 1]);
    }
}
