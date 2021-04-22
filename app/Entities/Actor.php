<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\PodcastModel;

class Actor extends \ActivityPub\Entities\Actor
{
    /**
     * @var App\Entities\Podcast|null
     */
    protected $podcast;

    /**
     * @var boolean
     */
    protected $is_podcast;

    public function getIsPodcast()
    {
        return !empty($this->podcast);
    }

    public function getPodcast()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Actor must be created before getting associated podcast.',
            );
        }

        if (empty($this->podcast)) {
            $this->podcast = (new PodcastModel())->getPodcastByActorId(
                $this->id,
            );
        }

        return $this->podcast;
    }
}
