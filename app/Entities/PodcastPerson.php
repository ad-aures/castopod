<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity;
use App\Models\PersonModel;

class PodcastPerson extends Entity
{
    /**
     * @var \App\Entities\Person
     */
    protected $person;

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
            $this->attributes['person_id']
        );
    }
}
