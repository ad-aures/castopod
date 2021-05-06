<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\PersonModel;

class PodcastPerson extends Entity
{
    /**
     * @var Person
     */
    protected $person;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'podcast_id' => 'integer',
        'person_id' => 'integer',
        'person_group' => '?string',
        'person_role' => '?string',
    ];

    public function getPerson()
    {
        return (new PersonModel())->getPersonById(
            $this->attributes['person_id'],
        );
    }
}
