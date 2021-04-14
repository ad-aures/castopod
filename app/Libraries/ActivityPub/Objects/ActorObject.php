<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace ActivityPub\Objects;

use ActivityPub\Core\ObjectType;

class ActorObject extends ObjectType
{
    /**
     * @var array|string
     */
    protected $context = [
        'https://www.w3.org/ns/activitystreams',
        'https://w3id.org/security/v1',
    ];

    /**
     * @var string
     */
    protected $type = 'Person';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $preferredUsername;

    /**
     * @var string
     */
    protected $summary;

    /**
     * @var string
     */
    protected $inbox;

    /**
     * @var string
     */
    protected $outbox;

    /**
     * @var string
     */
    protected $followers;

    /**
     * @var string
     */
    protected $url;

    /**
     * @var array|null
     */
    protected $image;

    /**
     * @var array
     */
    protected $icon;

    /**
     * @var object
     */
    protected $publicKey;

    /**
     * @param \ActivityPub\Entities\Actor $podcast
     */
    public function __construct($actor)
    {
        $this->id = $actor->uri;

        $this->name = $actor->display_name;
        $this->preferredUsername = $actor->username;
        $this->summary = $actor->summary;
        $this->url = $actor->uri;

        $this->inbox = $actor->inbox_url;
        $this->outbox = $actor->outbox_url;
        $this->followers = $actor->followers_url;

        $this->image = [
            'type' => 'Image',
            'mediaType' => $actor->cover_image_mimetype,
            'url' => $actor->cover_image_url,
        ];

        $this->icon = [
            'type' => 'Image',
            'mediaType' => $actor->avatar_image_mimetype,
            'url' => $actor->avatar_image_url,
        ];

        $this->publicKey = [
            'id' => $actor->key_id,
            'owner' => $actor->uri,
            'publicKeyPem' => $actor->public_key,
        ];
    }
}
