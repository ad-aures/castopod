<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;

class UserPodcast extends Entity
{
    protected $casts = [
        'user_id' => 'integer',
        'podcast_id' => 'integer',
    ];
}
