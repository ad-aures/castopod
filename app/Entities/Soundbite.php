<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int $id
 * @property int $podcast_id
 * @property int $episode_id
 * @property double $start_time
 * @property double $duration
 * @property string|null $label
 * @property int $created_by
 * @property int $updated_by
 */
class Soundbite extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'podcast_id' => 'integer',
        'episode_id' => 'integer',
        'start_time' => 'double',
        'duration' => 'double',
        'label' => '?string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];
}
