<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\PersonModel;
use App\Models\PodcastModel;
use App\Models\EpisodeModel;

use CodeIgniter\Entity;

class Credit extends Entity
{
    /**
     * @var \App\Entities\Person
     */
    protected $person;

    /**
     * @var \App\Entities\Podcast
     */
    protected $podcast;

    /**
     * @var \App\Entities\Episode|null
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

    public function getPodcast()
    {
        return (new PodcastModel())->getPodcastById(
            $this->attributes['podcast_id'],
        );
    }

    public function getEpisode()
    {
        if (empty($this->episode_id)) {
            throw new \RuntimeException(
                'Credit must have episode_id before getting episode.',
            );
        }

        if (empty($this->episode)) {
            $this->episode = (new EpisodeModel())->getPublishedEpisodeById(
                $this->episode_id,
                $this->podcast_id,
            );
        }

        return $this->episode;
    }

    public function getPerson()
    {
        if (empty($this->person_id)) {
            throw new \RuntimeException(
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

    public function getGroupLabel()
    {
        if (empty($this->person_group)) {
            return null;
        } else {
            return lang("PersonsTaxonomy.persons.{$this->person_group}.label");
        }
    }

    public function getRoleLabel()
    {
        if (empty($this->person_group) || empty($this->person_role)) {
            return null;
        } else {
            return lang(
                "PersonsTaxonomy.persons.{$this->person_group}.roles.{$this->person_role}.label",
            );
        }
    }
}
