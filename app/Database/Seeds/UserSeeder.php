<?php
/**
 * Class UserSeeder
 * Inserts 'admin' user in users table for testing purposes
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            'username' => 'admin',
            'email' => 'admin@castopod.com',
            'password_hash' =>
                // password: AGUehL3P
                '$2y$10$TXJEHX/djW8jtzgpDVf7dOOCGo5rv1uqtAYWdwwwkttQcDkAeB2.6',
            'active' => 1,
        ];

        $this->db->table('users')->insert($data);
    }
}
