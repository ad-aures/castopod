<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use ActivityPub\Entities\Actor as ActivityPubActor;
use App\Models\PodcastModel;
use RuntimeException;

/**
 * @property Podcast|null $podcast
 * @property boolean $is_podcast
 */
class Actor extends ActivityPubActor
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

        if ($this->podcast === null) {
            $this->podcast = (new PodcastModel())->getPodcastByActorId($this->id);
        }

        return $this->podcast;
    }
}
