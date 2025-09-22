<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\PodcastModel;
use Modules\Fediverse\Entities\Actor as FediverseActor;
use Override;

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
        return $this->getPodcast() instanceof Podcast;
    }

    public function getPodcast(): ?Podcast
    {
        if (! $this->podcast instanceof Podcast) {
            $this->podcast = new PodcastModel()
                ->getPodcastByActorId($this->id);
        }

        return $this->podcast;
    }

    #[Override]
    public function getAvatarImageUrl(): string
    {
        if ($this->podcast instanceof Podcast) {
            return $this->podcast->cover->thumbnail_url;
        }

        return parent::getAvatarImageUrl();
    }

    #[Override]
    public function getAvatarImageMimetype(): string
    {
        if ($this->podcast instanceof Podcast) {
            return $this->podcast->cover->thumbnail_mimetype;
        }

        return parent::getAvatarImageMimetype();
    }
}
