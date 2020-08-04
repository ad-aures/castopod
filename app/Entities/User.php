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
     * Array of field names and the type of value to cast them as
     * when they are accessed.
     */
    protected $casts = [
        'active' => 'boolean',
        'force_pass_reset' => 'boolean',
        'podcast_role' => '?string',
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
}
