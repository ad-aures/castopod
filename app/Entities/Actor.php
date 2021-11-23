<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\PodcastModel;
use Modules\Fediverse\Entities\Actor as FediverseActor;
use RuntimeException;

/**
 * @property Podcast|null $podcast
 * @property boolean $is_podcast
 */
class Actor extends FediverseActor
{
    protected ?Podcast $podcast = null;

    protected bool $is_podcast = false;

    public function getIsPodcast(): bool
    {
        return $this->getPodcast() !== null;
    }

    public function getPodcast(): ?Podcast
    {
        if ($this->id === null) {
            throw new RuntimeException('Podcast id must be set before getting associated podcast.');
        }

        if (! $this->podcast instanceof Podcast) {
            $this->podcast = (new PodcastModel())->getPodcastByActorId($this->id);
        }

        return $this->podcast;
    }

    public function getAvatarImageUrl(): string
    {
        if ($this->podcast !== null) {
            return $this->podcast->cover->thumbnail_url;
        }

        return $this->attributes['avatar_image_url'];
    }

    public function getAvatarImageMimetype(): string
    {
        if ($this->podcast !== null) {
            return $this->podcast->cover->thumbnail_mimetype;
        }

        return $this->attributes['avatar_image_mimetype'];
    }
}
