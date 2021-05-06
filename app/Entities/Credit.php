<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use RuntimeException;
use App\Models\PersonModel;
use App\Models\PodcastModel;
use App\Models\EpisodeModel;
use CodeIgniter\Entity\Entity;

class Credit extends Entity
{
    /**
     * @var Person
     */
    protected $person;

    /**
     * @var Podcast
     */
    protected $podcast;

    /**
     * @var Episode|null
     */
    protected $episode;

    /**
     * @var string
     */
    protected $group_label;

    /**
     * @var string
     */
    protected $role_label;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'person_group' => 'string',
        'person_role' => 'string',
        'person_id' => 'integer',
        'full_name' => 'integer',
        'podcast_id' => 'integer',
        'episode_id' => '?integer',
    ];

    public function getPodcast(): Podcast
    {
        return (new PodcastModel())->getPodcastById(
            $this->attributes['podcast_id'],
        );
    }

    public function getEpisode(): ?Episode
    {
        if (empty($this->episode_id)) {
            throw new RuntimeException(
                'Credit must have episode_id before getting episode.',
            );
        }

        if (empty($this->episode)) {
            $this->episode = (new EpisodeModel())->getPublishedEpisodeById(
                $this->podcast_id,
                $this->episode_id,
            );
        }

        return $this->episode;
    }

    public function getPerson(): Person
    {
        if (empty($this->person_id)) {
            throw new RuntimeException(
                'Credit must have person_id before getting person.',
            );
        }

        if (empty($this->person)) {
            $this->person = (new PersonModel())->getPersonById(
                $this->person_id,
            );
        }

        return $this->person;
    }

    public function getGroupLabel(): ?string
    {
        if (empty($this->person_group)) {
            return null;
        }

        return lang("PersonsTaxonomy.persons.{$this->person_group}.label");
    }

    public function getRoleLabel(): ?string
    {
        if (empty($this->person_group)) {
            return null;
        }

        if (empty($this->person_role)) {
            return null;
        }

        return lang(
            "PersonsTaxonomy.persons.{$this->person_group}.roles.{$this->person_role}.label",
        );
    }
}
