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
use CodeIgniter\Shield\Entities\User;
use Modules\Auth\Models\UserModel;
use Override;

class DevSuperadminSeeder extends Seeder
{
    #[Override]
    public function run(): void
    {
        if ((new UserModel())->where('is_owner', true)->first() instanceof User) {
            return;
        }

        /**
         * Inserts an owner with the following credentials: admin: `admin@example.com` password: `castopod`
         */

        // Get the User Provider (UserModel by default)
        $users = auth()
            ->getProvider();

        $user = new User([
            'username' => 'admin',
            'email'    => 'admin@castopod.local',
            'password' => 'castopod',
            'is_owner' => true,
        ]);
        $users->save($user);

        // To get the complete user object with ID, we need to get from the database
        $user = $users->findById($users->getInsertID());

        $user->addGroup(setting('AuthGroups.mostPowerfulGroup'));
    }
}
