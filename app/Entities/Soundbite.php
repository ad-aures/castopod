<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;

class Soundbite extends Entity
{
    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'podcast_id' => 'integer',
        'episode_id' => 'integer',
        'start_time' => 'float',
        'duration' => 'float',
        'label' => '?string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function setUpdatedBy(User $user): self
    {
        $this->attributes['updated_by'] = $user->id;

        return $this;
    }
}
