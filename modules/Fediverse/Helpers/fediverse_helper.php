<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use CodeIgniter\HTTP\Exceptions\HTTPException;
use CodeIgniter\HTTP\URI;
use Config\Mimes;
use Embera\Embera;
use Modules\Fediverse\Activities\AcceptActivity;
use Modules\Fediverse\ActivityRequest;
use Modules\Fediverse\Core\ObjectType;
use Modules\Fediverse\Entities\Actor;
use Modules\Fediverse\Entities\PreviewCard;

if (! function_exists('get_webfinger_data')) {
    /**
     * Retrieve actor webfinger data from username and domain
     */
    function get_webfinger_data(string $username, string $domain): ?object
    {
        $webfingerUri = new URI();
        $webfingerUri->setScheme('https');
        $webfingerUri->setHost($domain);
        $webfingerUri->setPath('/.well-known/webfinger');
        $webfingerUri->setQuery("resource=acct:{$username}@{$domain}");

        $webfingerRequest = new ActivityRequest((string) $webfingerUri);
        $webfingerResponse = $webfingerRequest->get();

        return json_decode((string) $webfingerResponse->getBody(), false, 512, JSON_THROW_ON_ERROR);
    }
}

if (! function_exists('split_handle')) {
    /**
     * Splits handle into its parts (username, host and port)
     *
     * @return array{0:string,username:non-empty-string,1:non-empty-string,domain:non-empty-string,2:non-empty-string,port?:non-falsy-string,3?:non-falsy-string}
     */
    function split_handle(string $handle): array | false
    {
        if (
            ! preg_match('~^@?(?P<username>[\w\.\-]+)@(?P<domain>[\w\.\-]+)(?P<port>:[\d]+)?$~', $handle, $matches)
        ) {
            return false;
        }

        return $matches;
    }
}

if (! function_exists('accept_follow')) {
    /**
     * Sends an accept activity to the targetActor's inbox
     *
     * @param Actor $actor Actor which accepts the follow
     * @param Actor $targetActor Actor which receives the accept follow
     */
    function accept_follow(Actor $actor, Actor $targetActor, string $objectId): void
    {
        $acceptActivity = new AcceptActivity();

        $object = new ObjectType();
        $object->set('id', $objectId);
        $object->set('type', 'Follow');
        $object->set('actor', $targetActor->uri);
        $object->set('object', $actor->uri);

        $acceptActivity->set('actor', $actor->uri)
            ->set('object', $object);

        $db = db_connect();
        $db->transStart();

        $activityModel = model('ActivityModel', false);
        $activityId = $activityModel->newActivity(
            'Accept',
            $actor->id,
            $targetActor->id,
            null,
            $acceptActivity->toJSON(),
        );

        $acceptActivity->set('id', url_to('activity', esc($actor->username), $activityId));

        $activityModel->update($activityId, [
            'payload' => $acceptActivity->toJSON(),
        ]);

        try {
            $acceptRequest = new ActivityRequest($targetActor->inbox_url, $acceptActivity->toJSON());
            $acceptRequest->sign($actor->public_key_id, $actor->private_key);
            $acceptRequest->post();
        } catch (Exception) {
            $db->transRollback();
        }

        $db->transComplete();
    }
}

if (! function_exists('send_activity_to_actor')) {
    /**
     * Sends an activity to all actor followers
     */
    function send_activity_to_actor(Actor $actor, Actor $targetActor, string $activityPayload): void
    {
        try {
            $acceptRequest = new ActivityRequest($targetActor->inbox_url, $activityPayload);
            if ($actor->private_key !== null) {
                $acceptRequest->sign($actor->public_key_id, $actor->private_key);
            }

            $acceptRequest->post();
        } catch (Exception $exception) {
            // log error
            log_message('critical', $exception->getMessage());
        }
    }
}

if (! function_exists('send_activity_to_followers')) {
    /**
     * Sends an activity to all actor followers
     */
    function send_activity_to_followers(Actor $actor, string $activityPayload): void
    {
        // TODO: send activities in parallel with https://www.php.net/manual/en/function.curl-multi-init.php
        foreach ($actor->followers as $follower) {
            send_activity_to_actor($actor, $follower, $activityPayload);
        }
    }
}

if (! function_exists('extract_urls_from_message')) {
    /**
     * Returns an array of all urls from a string
     *
     * @return string[]
     */
    function extract_urls_from_message(string $message): array
    {
        preg_match_all('~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i', $message, $match);

        return $match[0];
    }
}

if (! function_exists('create_preview_card_from_url')) {
    /**
     * Extract open graph metadata from given url and create preview card
     */
    function create_preview_card_from_url(URI $url): ?PreviewCard
    {
        $embera = new Embera();
        $mediaData = $embera->getUrlData((string) $url);

        if ($mediaData !== []) {
            $mediaUrl = array_key_first($mediaData);
            $media = array_first($mediaData);

            if (array_key_exists('title', $media)) {
                $typeMapping = [
                    'photo'   => 'image',
                    'video'   => 'video',
                    'website' => 'link',
                    'rich'    => 'rich',
                ];

                // Check that, at least, the url and title are set
                $newPreviewCard = new PreviewCard([
                    'url'           => $mediaUrl,
                    'title'         => $media['title'] ?? '',
                    'description'   => $media['description'] ?? '',
                    'type'          => $typeMapping[$media['type']] ?? 'link',
                    'author_name'   => $media['author_name'] ?? null,
                    'author_url'    => $media['author_url'] ?? null,
                    'provider_name' => $media['provider_name'] ?? '',
                    'provider_url'  => $media['provider_url'] ?? '',
                    'image'         => $media['thumbnail_url'] ?? '',
                    'html'          => $media['html'] ?? '',
                ]);

                if (
                    ! ($newPreviewCardId = model('PreviewCardModel', false)->insert($newPreviewCard, true))
                ) {
                    return null;
                }

                $newPreviewCard->id = $newPreviewCardId;
                return $newPreviewCard;
            }
        }

        return null;
    }
}

if (! function_exists('get_or_create_preview_card_from_url')) {
    /**
     * Extract open graph metadata from given url and create preview card
     */
    function get_or_create_preview_card_from_url(URI $url): ?PreviewCard
    {
        // check if preview card has already been generated
        if (
            ($previewCard = model('PreviewCardModel', false)
                ->getPreviewCardFromUrl((string) $url)) instanceof PreviewCard
        ) {
            return $previewCard;
        }

        // create preview card
        return create_preview_card_from_url($url);
    }
}

if (! function_exists('get_or_create_actor_from_uri')) {
    /**
     * Retrieves actor from database using the actor uri If Actor is not present, it creates the record in the database
     * and returns it.
     */
    function get_or_create_actor_from_uri(string $actorUri): ?Actor
    {
        // check if actor exists in database already and return it
        if (($actor = model('ActorModel', false)->getActorByUri($actorUri)) instanceof Actor) {
            return $actor;
        }

        // if the actor doesn't exist, request actorUri to create it
        return create_actor_from_uri($actorUri);
    }
}

if (! function_exists('get_or_create_actor')) {
    /**
     * Retrieves actor from database using the actor username and domain If actor is not present, it creates the record
     * in the database and returns it.
     */
    function get_or_create_actor(string $username, string $domain): ?Actor
    {
        // check if actor exists in database already and return it
        if (
            ($actor = model('ActorModel', false)
                ->getActorByUsername($username, $domain)) instanceof Actor
        ) {
            return $actor;
        }

        // get actorUri with webfinger request
        $webfingerData = get_webfinger_data($username, $domain);
        $actorUriKey = array_search('self', array_column($webfingerData->links, 'rel'), true);

        return create_actor_from_uri($webfingerData->links[$actorUriKey]->href);
    }
}

if (! function_exists('create_actor_from_uri')) {
    /**
     * Creates actor record in database using the info gathered from the actorUri parameter
     */
    function create_actor_from_uri(string $actorUri): ?Actor
    {
        $activityRequest = new ActivityRequest($actorUri);
        $actorResponse = $activityRequest->get();
        $actorPayload = json_decode((string) $actorResponse->getBody(), false, 512, JSON_THROW_ON_ERROR);

        $newActor = new Actor();
        $newActor->uri = $actorUri;
        $newActor->username = $actorPayload->preferredUsername;
        $newActor->domain = $activityRequest->getDomain();
        $newActor->public_key = $actorPayload->publicKey->publicKeyPem;
        $newActor->private_key = null;
        $newActor->display_name = $actorPayload->name;
        $newActor->summary = property_exists($actorPayload, 'summary') ? $actorPayload->summary : null;
        if (property_exists($actorPayload, 'icon')) {
            $newActor->avatar_image_url = $actorPayload->icon->url;

            if (property_exists($actorPayload->icon, 'mediaType')) {
                $newActor->avatar_image_mimetype = $actorPayload->icon->mediaType;
            } else {
                $iconExtension = pathinfo((string) $actorPayload->icon->url, PATHINFO_EXTENSION);

                $newActor->avatar_image_mimetype = (string) Mimes::guessTypeFromExtension($iconExtension);
            }
        }

        if (property_exists($actorPayload, 'image')) {
            $newActor->cover_image_url = $actorPayload->image->url;

            if (property_exists($actorPayload->image, 'mediaType')) {
                $newActor->cover_image_mimetype = $actorPayload->image->mediaType;
            } else {
                $coverExtension = pathinfo((string) $actorPayload->image->url, PATHINFO_EXTENSION);

                $newActor->cover_image_mimetype = (string) Mimes::guessTypeFromExtension($coverExtension);
            }
        }

        $newActor->inbox_url = $actorPayload->inbox;
        $newActor->outbox_url = property_exists($actorPayload, 'outbox') ? $actorPayload->outbox : null;
        $newActor->followers_url = property_exists($actorPayload, 'followers') ? $actorPayload->followers : null;

        if (! ($newActorId = model('ActorModel', false)->insert($newActor, true))) {
            return null;
        }

        $newActor->id = $newActorId;
        return $newActor;
    }
}

if (! function_exists('get_current_domain')) {
    /**
     * Returns instance's domain name
     */
    function get_current_domain(): string
    {
        $uri = current_url(true);
        return $uri->getHost() . ($uri->getPort() ? ':' . $uri->getPort() : '');
    }
}

if (! function_exists('extract_text_from_html')) {
    /**
     * Extracts the text from html content
     */
    function extract_text_from_html(string $content): ?string
    {
        return preg_replace('~\s+~', ' ', strip_tags($content));
    }
}

if (! function_exists('get_message_from_object')) {
    /**
     * Gets the message from content, if no content key is present, checks for content in contentMap
     *
     * TODO: store multiple languages, convert markdown
     */
    function get_message_from_object(stdClass $object): string | false
    {
        if (property_exists($object, 'content') && is_string($object->content)) {
            extract_text_from_html($object->content);
            return $object->content;
        }

        $message = '';
        if (property_exists($object, 'contentMap')) {
            // TODO: update message to be json? (include all languages?)
            if (property_exists($object->contentMap, 'en')) {
                extract_text_from_html($object->contentMap->en);
                $message = $object->contentMap->en;
            } else {
                $message = current($object->contentMap);
            }
        }

        return $message;
    }
}

if (! function_exists('is_note_public')) {
    /**
     * Check whether note is public or not
     */
    function is_note_public(stdClass $object): bool
    {
        $isPublic = false;
        if (property_exists($object, 'to') && is_array($object->to)) {
            $isPublic = in_array('https://www.w3.org/ns/activitystreams#Public', $object->to, true);
        }

        if ($isPublic) {
            return true;
        }

        if (property_exists($object, 'cc') && is_array($object->cc)) {
            return in_array('https://www.w3.org/ns/activitystreams#Public', $object->cc, true);
        }

        return $isPublic;
    }
}

if (! function_exists('linkify')) {
    /**
     * Turn all link elements in clickable links. Transforms urls and handles
     *
     * @param string[] $protocols http/https, twitter
     */
    function linkify(string $text, array $protocols = ['http', 'handle']): string
    {
        $links = [];

        // Extract text links for each protocol
        foreach ($protocols as $protocol) {
            $text = match ($protocol) {
                'http', 'https' => preg_replace_callback(
                    '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i',
                    static function (array $match) use ($protocol, &$links): string {
                        if ($match[1] !== '' && $match[1] !== '0') {
                            $protocol = $match[1];
                        }

                        $link = $match[2] ?: $match[3];
                        helper('text');
                        $link = preg_replace('~^www\.(.+\.)~i', '$1', $link);
                        return '<' .
                            array_push(
                                $links,
                                anchor(
                                    "{$protocol}://{$link}",
                                    ellipsize(rtrim($link, '/'), 30),
                                    [
                                        'target' => '_blank',
                                        'rel'    => 'noopener noreferrer',
                                    ],
                                ),
                            ) .
                            '>';
                    },
                    (string) $text,
                ),
                'handle' => preg_replace_callback(
                    '~(?<!\w)@(?<username>\w++)(?:@(?<domain>(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]))?~',
                    static function (array $match) use (&$links): string {
                        // check if host is set and look for actor in database
                        if (isset($match['domain'])) {
                            if (
                                ($actor = model(
                                    'ActorModel',
                                )->getActorByUsername($match['username'], $match['domain'])) instanceof Actor
                            ) {
                                // TODO: check that host is local to remove target blank?
                                return '<' .
                                    array_push(
                                        $links,
                                        anchor($actor->uri, $match[0], [
                                            'target' => '_blank',
                                            'rel'    => 'noopener noreferrer',
                                        ]),
                                    ) .
                                    '>';
                            }

                            try {
                                $actor = get_or_create_actor($match['username'], $match['domain']);
                                return '<' .
                                    array_push(
                                        $links,
                                        anchor($actor->uri, $match[0], [
                                            'target' => '_blank',
                                            'rel'    => 'noopener noreferrer',
                                        ]),
                                    ) .
                                    '>';
                            } catch (HTTPException) {
                                // Couldn't retrieve actor, do not wrap the text in link
                                return '<' .
                                    array_push($links, $match[0]) .
                                    '>';
                            }
                        } else {
                            if (
                                ($actor = model('ActorModel', false)
                                    ->getActorByUsername($match['username'])) instanceof Actor
                            ) {
                                return '<' .
                                    array_push($links, anchor($actor->uri, $match[0])) .
                                    '>';
                            }

                            return '<' .
                                array_push($links, $match[0]) .
                                '>';
                        }
                    },
                    (string) $text,
                ),
                default => preg_replace_callback(
                    '~' .
                        preg_quote($protocol, '~') .
                        '://([^\s<]+?)(?<![\.,:])~i',
                    static function (array $match) use ($protocol, &$links): string {
                        return '<' .
                            array_push(
                                $links,
                                anchor(
                                    "{$protocol}://{$match[1]}",
                                    $match[1],
                                    [
                                        'target' => '_blank',
                                        'rel'    => 'noopener noreferrer',
                                    ],
                                ),
                            ) .
                            '>';
                    },
                    (string) $text,
                ),
            };
        }

        // Insert all links
        return preg_replace_callback(
            '~<(\d+)>~',
            static function (array $match) use (&$links): string {
                return $links[(int) $match[1] - 1];
            },
            (string) $text,
        );
    }
}
