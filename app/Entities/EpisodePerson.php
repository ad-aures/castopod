<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use CodeIgniter\Entity\Entity;
use App\Models\PersonModel;

/**
 * @property int $id
 * @property int $podcast_id
 * @property int $episode_id
 * @property int $person_id
 * @property Person $person
 * @property string|null $person_group
 * @property string|null $person_role
 */
class EpisodePerson extends Entity
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
        'episode_id' => 'integer',
        'person_id' => 'integer',
        'person_group' => '?string',
        'person_role' => '?string',
    ];

    public function getPerson(): Person
    {
        return (new PersonModel())->getPersonById(
            $this->attributes['person_id'],
        );
    }
}
