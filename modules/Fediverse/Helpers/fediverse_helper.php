<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use CodeIgniter\HTTP\Exceptions\HTTPException;
use CodeIgniter\HTTP\URI;
use Config\Database;
use Essence\Essence;
use Modules\Fediverse\Activities\AcceptActivity;
use Modules\Fediverse\ActivityRequest;
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

        return json_decode($webfingerResponse->getBody(), false, 512, JSON_THROW_ON_ERROR);
    }
}

if (! function_exists('split_handle')) {
    /**
     * Splits handle into its parts (username, host and port)
     *
     * @return array<string, string>|false
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
        $acceptActivity->set('actor', $actor->uri)
            ->set('object', $objectId);

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

        $acceptActivity->set('id', url_to('activity', $actor->username, $activityId));

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
        $essence = new Essence([
            'filters' => [
                'OEmbedProvider' => '//',
                'OpenGraphProvider' => '//',
                'TwitterCardsProvider' => '//',
            ],
        ]);
        $media = $essence->extract((string) $url);

        if ($media) {
            $typeMapping = [
                'photo' => 'image',
                'video' => 'video',
                'website' => 'link',
                'rich' => 'rich',
            ];

            // Check that, at least, the url and title are set
            if ($media->url && $media->title) {
                $newPreviewCard = new PreviewCard([
                    'url' => (string) $url,
                    'title' => $media->title,
                    'description' => $media->description,
                    'type' => isset($typeMapping[$media->type])
                        ? $typeMapping[$media->type]
                        : 'link',
                    'author_name' => $media->authorName,
                    'author_url' => $media->authorUrl,
                    'provider_name' => $media->providerName,
                    'provider_url' => $media->providerUrl,
                    'image' => $media->thumbnailUrl,
                    'html' => $media->html,
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
            $previewCard = model('PreviewCardModel', false)
                ->getPreviewCardFromUrl((string) $url)
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
        if ($actor = model('ActorModel', false)->getActorByUri($actorUri)) {
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
            $actor = model('ActorModel', false)
                ->getActorByUsername($username, $domain)
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
        $actorPayload = json_decode($actorResponse->getBody(), false, 512, JSON_THROW_ON_ERROR);

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
            $newActor->avatar_image_mimetype = $actorPayload->icon->mediaType;
        }

        if (property_exists($actorPayload, 'image')) {
            $newActor->cover_image_url = $actorPayload->image->url;
            $newActor->cover_image_mimetype = $actorPayload->image->mediaType;
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
     *
     * @throws HTTPException
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
     *
     * @return string|false
     */
    function get_message_from_object(stdClass $object): string | false
    {
        if (property_exists($object, 'content')) {
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
                    function (array $match) use ($protocol, &$links) {
                        if ($match[1]) {
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
                                        'rel' => 'noopener noreferrer',
                                    ],
                                ),
                            ) .
                            '>';
                    },
                    $text,
                ),
                'handle' => preg_replace_callback(
                    '~(?<!\w)@(?<username>\w++)(?:@(?<domain>(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]))?~',
                    function ($match) use (&$links) {
                        // check if host is set and look for actor in database
                        if (isset($match['host'])) {
                            if (
                                $actor = model(
                                    'ActorModel',
                                )->getActorByUsername($match['username'], $match['domain'])
                            ) {
                                // TODO: check that host is local to remove target blank?
                                return '<' .
                                    array_push(
                                        $links,
                                        anchor($actor->uri, $match[0], [
                                            'target' => '_blank',
                                            'rel' => 'noopener noreferrer',
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
                                            'rel' => 'noopener noreferrer',
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
                                $actor = model('ActorModel', false)
                                    ->getActorByUsername($match['username'])
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
                    $text,
                ),
                default => preg_replace_callback(
                    '~' .
                        preg_quote($protocol, '~') .
                        '://([^\s<]+?)(?<![\.,:])~i',
                    function (array $match) use ($protocol, &$links) {
                        return '<' .
                            array_push(
                                $links,
                                anchor(
                                    "{$protocol}://{$match[1]}",
                                    $match[1],
                                    [
                                        'target' => '_blank',
                                        'rel' => 'noopener noreferrer',
                                    ],
                                ),
                            ) .
                            '>';
                    },
                    $text,
                ),
            };
        }

        // Insert all links
        return preg_replace_callback(
            '~<(\d+)>~',
            function ($match) use (&$links) {
                return $links[$match[1] - 1];
            },
            $text,
        );
    }
}
