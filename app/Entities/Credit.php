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
     * @var \App\Entities\Episode
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
            $this->attributes['podcast_id']
        );
    }

    public function getEpisode()
    {
        if (empty($this->attributes['episode_id'])) {
            return null;
        } else {
            return (new EpisodeModel())->getEpisodeById(
                $this->attributes['podcast_id'],
                $this->attributes['episode_id']
            );
        }
    }

    public function getPerson()
    {
        return (new PersonModel())->getPersonById(
            $this->attributes['person_id']
        );
    }

    public function getGroupLabel()
    {
        if (empty($this->attributes['person_group'])) {
            return null;
        } else {
            return lang(
                "PersonsTaxonomy.persons.{$this->attributes['person_group']}.label"
            );
        }
    }

    public function getRoleLabel()
    {
        if (
            empty($this->attributes['person_group']) ||
            empty($this->attributes['person_role'])
        ) {
            return null;
        } else {
            return lang(
                "PersonsTaxonomy.persons.{$this->attributes['person_group']}.roles.{$this->attributes['person_role']}.label"
            );
        }
    }
}
