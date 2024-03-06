<?php

declare(strict_types=1);

/**
 * Class AppSeeder Calls all required seeders for castopod to work properly
 *
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class DevSeeder extends Seeder
{
    public function run(): void
    {
        $this->call('CategorySeeder');
        $this->call('LanguageSeeder');
        $this->call('PlatformSeeder');
        $this->call('DevSuperadminSeeder');
    }
}
