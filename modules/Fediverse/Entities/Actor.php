<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Entities;

use CodeIgniter\Entity\Entity;

/**
 * @property int $id
 * @property string $uri
 * @property string $username
 * @property string $domain
 * @property string $display_name
 * @property string|null $summary
 * @property string|null $private_key
 * @property string|null $public_key
 * @property string $public_key_id
 * @property string|null $avatar_image_url
 * @property string|null $avatar_image_mimetype
 * @property string|null $cover_image_url
 * @property string|null $cover_image_mimetype
 * @property string $inbox_url
 * @property string|null $outbox_url
 * @property string|null $followers_url
 * @property int $followers_count
 * @property int $posts_count
 * @property bool $is_blocked
 *
 * @property Actor[] $followers
 * @property bool $is_local
 */
class Actor extends Entity
{
    protected string $public_key_id;

    /**
     * @var Actor[]|null
     */
    protected ?array $followers = null;

    protected bool $is_local = false;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'                    => 'integer',
        'uri'                   => 'string',
        'username'              => 'string',
        'domain'                => 'string',
        'display_name'          => 'string',
        'summary'               => '?string',
        'private_key'           => '?string',
        'public_key'            => '?string',
        'avatar_image_url'      => '?string',
        'avatar_image_mimetype' => '?string',
        'cover_image_url'       => '?string',
        'cover_image_mimetype'  => '?string',
        'inbox_url'             => 'string',
        'outbox_url'            => '?string',
        'followers_url'         => '?string',
        'followers_count'       => 'integer',
        'posts_count'           => 'integer',
        'is_blocked'            => 'boolean',
    ];

    public function getPublicKeyId(): string
    {
        return $this->uri . '#main-key';
    }

    public function getIsLocal(): bool
    {
        if (! $this->is_local) {
            $uri = current_url(true);

            $this->is_local =
                $this->domain ===
                $uri->getHost() .
                    ($uri->getPort() ? ':' . $uri->getPort() : '');
        }

        return $this->is_local;
    }

    /**
     * @return Actor[]
     */
    public function getFollowers(): array
    {
        if ($this->followers === null) {
            $this->followers = model('ActorModel', false)
                ->getFollowers($this->id);
        }

        return $this->followers;
    }

    public function getAvatarImageUrl(): string
    {
        if ($this->attributes['avatar_image_url'] === null) {
            return base_url(config('Fediverse')->defaultAvatarImagePath);
        }

        return $this->attributes['avatar_image_url'];
    }

    public function getAvatarImageMimetype(): string
    {
        if ($this->attributes['avatar_image_mimetype'] === null) {
            return config('Fediverse')->defaultAvatarImageMimetype;
        }

        return $this->attributes['avatar_image_mimetype'];
    }

    public function getCoverImageUrl(): string
    {
        if ($this->attributes['cover_image_url'] === null) {
            return base_url(config('Fediverse')->defaultCoverImagePath);
        }

        return $this->attributes['cover_image_url'];
    }

    public function getCoverImageMimetype(): string
    {
        if ($this->attributes['cover_image_mimetype'] === null) {
            return config('Fediverse')->defaultCoverImageMimetype;
        }

        return $this->attributes['cover_image_mimetype'];
    }
}
