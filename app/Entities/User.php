<?php

namespace App\Entities;

use App\Models\PodcastModel;

class User extends \Myth\Auth\Entities\User
{
    /**
     * Per-user podcasts
     * @var \App\Entities\Podcast[]
     */
    protected $podcasts = [];

    /**
     * The podcast user is contributing to
     * @var \App\Entities\Podcast
     */
    protected $podcast;

    /**
     * Array of field names and the type of value to cast them as
     * when they are accessed.
     */
    protected $casts = [
        'active' => 'boolean',
        'force_pass_reset' => 'boolean',
        'podcast_role' => '?string',
        'podcast_id' => '?integer',
    ];

    /**
     * Returns the podcasts the user is contributing to
     *
     * @return \App\Entities\Podcast[]
     */
    public function getPodcasts()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Users must be created before getting podcasts.'
            );
        }

        if (empty($this->podcasts)) {
            $this->podcasts = (new PodcastModel())->getUserPodcasts($this->id);
        }

        return $this->podcasts;
    }

    public function getPodcast()
    {
        if (empty($this->podcast_id)) {
            throw new \RuntimeException(
                'Podcast_id must be set before getting podcast.'
            );
        }

        if (empty($this->podcast)) {
            $this->podcast = (new PodcastModel())->find($this->podcast_id);
        }

        return $this->podcast;
    }
}
