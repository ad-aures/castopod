<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Entities;

use RuntimeException;
use CodeIgniter\Entity\Entity;

class Actor extends Entity
{
    /**
     * @var string
     */
    protected $key_id;

    /**
     * @var Actor[]
     */
    protected $followers = [];

    /**
     * @var boolean
     */
    protected $is_local = false;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'uri' => 'string',
        'username' => 'string',
        'domain' => 'string',
        'display_name' => 'string',
        'summary' => '?string',
        'private_key' => '?string',
        'public_key' => '?string',
        'avatar_image_url' => '?string',
        'avatar_image_mimetype' => '?string',
        'cover_image_url' => '?string',
        'cover_image_mimetype' => '?string',
        'inbox_url' => 'string',
        'outbox_url' => '?string',
        'followers_url' => '?string',
        'followers_count' => 'integer',
        'notes_count' => 'integer',
        'is_blocked' => 'boolean',
    ];

    public function getKeyId(): string
    {
        return $this->uri . '#main-key';
    }

    public function getIsLocal(): bool
    {
        if (!$this->is_local) {
            $uri = current_url(true);

            $this->is_local =
                $this->domain ===
                $uri->getHost() .
                    ($uri->getPort() ? ':' . $uri->getPort() : '');
        }

        return $this->is_local;
    }

    /**
     * @return Follower[]
     */
    public function getFollowers(): array
    {
        if (empty($this->id)) {
            throw new RuntimeException(
                'Actor must be created before getting followers.',
            );
        }

        if (empty($this->followers)) {
            $this->followers = (array) model('ActorModel')->getFollowers(
                $this->id,
            );
        }

        return $this->followers;
    }

    public function getAvatarImageUrl(): string
    {
        if (empty($this->attributes['avatar_image_url'])) {
            return base_url(config('ActivityPub')->defaultAvatarImagePath);
        }

        return $this->attributes['avatar_image_url'];
    }

    public function getAvatarImageMimetype(): string
    {
        if (empty($this->attributes['avatar_image_mimetype'])) {
            return config('ActivityPub')->defaultAvatarImageMimetype;
        }

        return $this->attributes['avatar_image_mimetype'];
    }

    public function getCoverImageUrl(): string
    {
        if (empty($this->attributes['cover_image_url'])) {
            return base_url(config('ActivityPub')->defaultCoverImagePath);
        }

        return $this->attributes['cover_image_url'];
    }

    public function getCoverImageMimetype(): string
    {
        if (empty($this->attributes['cover_image_mimetype'])) {
            return config('ActivityPub')->defaultCoverImageMimetype;
        }

        return $this->attributes['cover_image_mimetype'];
    }
}
