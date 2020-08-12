<?php

/**
 * Class AppSeeder
 * Calls all required seeders for castopod to work properly
 *
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class AppSeeder extends Seeder
{
    public function run()
    {
        $this->call('AuthSeeder');
        $this->call('CategorySeeder');
        $this->call('LanguageSeeder');
        $this->call('PlatformSeeder');
    }
}
