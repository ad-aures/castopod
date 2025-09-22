<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\EpisodeModel;
use App\Models\PersonModel;
use App\Models\PodcastModel;
use CodeIgniter\Entity\Entity;
use RuntimeException;

/**
 * @property int $podcast_id
 * @property Podcast|null $podcast
 * @property int|null $episode_id
 * @property Episode|null $episode
 * @property string $full_name
 * @property string $person_group
 * @property string $group_label
 * @property string $person_role
 * @property string $role_label
 * @property int $person_id
 * @property Person|null $person
 */
class Credit extends Entity
{
    protected ?Person $person = null;

    protected ?Podcast $podcast = null;

    protected ?Episode $episode = null;

    protected string $group_label;

    protected string $role_label;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'podcast_id'   => 'integer',
        'episode_id'   => '?integer',
        'person_id'    => 'integer',
        'full_name'    => 'string',
        'person_group' => 'string',
        'person_role'  => 'string',
    ];

    public function getPerson(): ?Person
    {
        if (! $this->person instanceof Person) {
            $this->person = new PersonModel()
                ->getPersonById($this->person_id);
        }

        return $this->person;
    }

    public function getPodcast(): ?Podcast
    {
        if (! $this->podcast instanceof Podcast) {
            $this->podcast = new PodcastModel()
                ->getPodcastById($this->podcast_id);
        }

        return $this->podcast;
    }

    public function getEpisode(): ?Episode
    {
        if ($this->episode_id === null) {
            throw new RuntimeException('Credit must have episode_id before getting episode.');
        }

        if (! $this->episode instanceof Episode) {
            $this->episode = new EpisodeModel()
                ->getPublishedEpisodeById($this->podcast_id, $this->episode_id);
        }

        return $this->episode;
    }

    public function getGroupLabel(): string
    {
        if ($this->person_group === '') {
            return '';
        }

        /** @var string */
        return lang("PersonsTaxonomy.persons.{$this->person_group}.label");
    }

    public function getRoleLabel(): string
    {
        if ($this->person_group === '') {
            return '';
        }

        if ($this->person_role === '') {
            return '';
        }

        /** @var string */
        return lang("PersonsTaxonomy.persons.{$this->person_group}.roles.{$this->person_role}.label");
    }
}
