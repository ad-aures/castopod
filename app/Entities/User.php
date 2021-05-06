<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use RuntimeException;
use App\Models\PodcastModel;

class User extends \Myth\Auth\Entities\User
{
    /**
     * Per-user podcasts
     * @var Podcast[]
     */
    protected $podcasts = [];

    /**
     * The podcast the user is contributing to
     *
     * @var Podcast|null
     */
    protected $podcast;

    /**
     * Array of field names and the type of value to cast them as
     * when they are accessed.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'active' => 'boolean',
        'force_pass_reset' => 'boolean',
        'podcast_role' => '?string',
        'podcast_id' => '?integer',
    ];

    /**
     * Returns the podcasts the user is contributing to
     *
     * @return Podcast[]
     */
    public function getPodcasts(): array
    {
        if (empty($this->id)) {
            throw new RuntimeException(
                'Users must be created before getting podcasts.',
            );
        }

        if (empty($this->podcasts)) {
            $this->podcasts = (new PodcastModel())->getUserPodcasts($this->id);
        }

        return $this->podcasts;
    }

    /**
     * Returns a podcast the user is contributing to
     */
    public function getPodcast(): Podcast
    {
        if (empty($this->podcast_id)) {
            throw new RuntimeException(
                'Podcast_id must be set before getting podcast.',
            );
        }

        if (empty($this->podcast)) {
            $this->podcast = (new PodcastModel())->getPodcastById(
                $this->podcast_id,
            );
        }

        return $this->podcast;
    }
}
