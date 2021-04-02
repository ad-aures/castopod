<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

class Actor extends \ActivityPub\Controllers\ActorController
{
    public function follow()
    {
        helper(['form', 'components', 'svg']);
        $data = [
            'actor' => $this->actor,
        ];

        return view('podcast/follow', $data);
    }
}
