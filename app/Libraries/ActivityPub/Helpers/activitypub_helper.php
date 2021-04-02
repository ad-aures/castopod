<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use ActivityPub\Activities\AcceptActivity;
use ActivityPub\ActivityRequest;
use CodeIgniter\HTTP\Exceptions\HTTPException;

if (!function_exists('get_webfinger_data')) {
    /**
     * Retrieve actor webfinger data from username and domain
     *
     * @param string $username
     * @param string $domain
     * @return mixed
     * @throws HTTPException
     * @throws InvalidArgumentException
     */
    function get_webfinger_data($username, $domain)
    {
        $webfingerUri = new \CodeIgniter\HTTP\URI();
        $webfingerUri->setScheme('https');
        $webfingerUri->setHost($domain);
        isset($port) && $webfingerUri->setPort((int) $port);
        $webfingerUri->setPath('/.well-known/webfinger');
        $webfingerUri->setQuery("resource=acct:{$username}@{$domain}");

        $webfingerRequest = new ActivityRequest($webfingerUri);
        $webfingerResponse = $webfingerRequest->get();

        return json_decode($webfingerResponse->getBody());
    }
}

if (!function_exists('split_handle')) {
    /**
     * Splits handle into its parts (username, host and port)
     *
     * @param  string $handle
     * @return bool|array
     */
    function split_handle(string $handle)
    {
        if (
            !preg_match(
                '/^@?(?P<username>[\w\.\-]+)@(?P<domain>[\w\.\-]+)(?P<port>:[\d]+)?$/',
                $handle,
                $matches,
            )
        ) {
            return false;
        }

        return $matches;
    }
}

if (!function_exists('accept_follow')) {
    /**
     * Sends an accept activity to the targetActor's inbox
     *
     * @param \ActivityPub\Entities\Actor $actor Actor which accepts the follow
     * @param \ActivityPub\Entities\Actor $targetActor Actor which receives the accept follow
     * @param string $objectId
     * @return void
     */
    function accept_follow($actor, $targetActor, $objectId)
    {
        $acceptActivity = new AcceptActivity();
        $acceptActivity->set('actor', $actor->uri)->set('object', $objectId);

        $db = \Config\Database::connect();
        $db->transStart();

        $activityModel = model('ActivityModel');
        $activityId = $activityModel->newActivity(
            'Accept',
            $actor->id,
            $targetActor->id,
            null,
            $acceptActivity->toJSON(),
        );

        $acceptActivity->set(
            'id',
            url_to('activity', $actor->username, $activityId),
        );

        $activityModel->update($activityId, [
            'payload' => $acceptActivity->toJSON(),
        ]);

        try {
            $acceptRequest = new ActivityRequest(
                $targetActor->inbox_url,
                $acceptActivity->toJSON(),
            );
            $acceptRequest->sign($actor->key_id, $actor->private_key);
            $acceptRequest->post();
        } catch (\Exception $e) {
            $db->transRollback();
        }

        $db->transComplete();
    }
}

if (!function_exists('send_activity_to_followers')) {
    /**
     * Sends an activity to all actor followers
     *
     * @param \ActivityPub\Entities\Actor $actor
     * @param string $activity
     * @return void
     */
    function send_activity_to_followers($actor, $activityPayload)
    {
        foreach ($actor->followers as $follower) {
            try {
                $acceptRequest = new ActivityRequest(
                    $follower->inbox_url,
                    $activityPayload,
                );
                $acceptRequest->sign($actor->key_id, $actor->private_key);
                $acceptRequest->post();
            } catch (\Exception $e) {
                // log error
                log_message('critical', $e);
            }
        }
    }
}

if (!function_exists('extract_urls_from_message')) {
    /**
     * Returns an array of all urls from a string
     *
     * @param mixed $message
     * @return string[]
     */
    function extract_urls_from_message($message)
    {
        preg_match_all(
            '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i',
            $message,
            $match,
        );

        return $match[0];
    }
}

if (!function_exists('create_preview_card_from_url')) {
    /**
     * Extract open graph metadata from given url and create preview card
     *
     * @param \CodeIgniter\HTTP\URI $url
     * @return \ActivityPub\Entities\PreviewCard|null
     */
    function create_preview_card_from_url($url)
    {
        $essence = new \Essence\Essence([
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
                $preview_card = new \ActivityPub\Entities\PreviewCard([
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
                    !($newPreviewCardId = model('PreviewCardModel')->insert(
                        $preview_card,
                        true,
                    ))
                ) {
                    return null;
                }

                $preview_card->id = $newPreviewCardId;
                return $preview_card;
            }
        }

        return null;
    }
}

if (!function_exists('get_or_create_preview_card_from_url')) {
    /**
     * Extract open graph metadata from given url and create preview card
     *
     * @param \CodeIgniter\HTTP\URI $url
     * @return \ActivityPub\Entities\PreviewCard|null
     */
    function get_or_create_preview_card_from_url($url)
    {
        // check if preview card has already been generated
        if (
            $previewCard = model('PreviewCardModel')->getPreviewCardFromUrl(
                (string) $url,
            )
        ) {
            return $previewCard;
        }

        // create preview card
        return create_preview_card_from_url($url);
    }
}

if (!function_exists('get_or_create_actor_from_uri')) {
    /**
     * Retrieves actor from database using the actor uri
     * If Actor is not present, it creates the record in the database and returns it.
     *
     * @param string $actorUri
     * @return \ActivityPub\Entities\Actor|null
     */
    function get_or_create_actor_from_uri($actorUri)
    {
        // check if actor exists in database already and return it
        if ($actor = model('ActorModel')->getActorByUri($actorUri)) {
            return $actor;
        }

        // if the actor doesn't exist, request actorUri to create it
        return create_actor_from_uri($actorUri);
    }
}

if (!function_exists('get_or_create_actor')) {
    /**
     * Retrieves actor from database using the actor username and domain
     * If actor is not present, it creates the record in the database and returns it.
     *
     * @param string $username
     * @param string $domain
     * @return \ActivityPub\Entities\Actor|null
     */
    function get_or_create_actor($username, $domain)
    {
        // check if actor exists in database already and return it
        if (
            $actor = model('ActorModel')->getActorByUsername($username, $domain)
        ) {
            return $actor;
        }

        // get actorUri with webfinger request
        $webfingerData = get_webfinger_data($username, $domain);
        $actorUriKey = array_search(
            'self',
            array_column($webfingerData->links, 'rel'),
        );

        return create_actor_from_uri($webfingerData->links[$actorUriKey]->href);
    }
}

if (!function_exists('create_actor_from_uri')) {
    /**
     * Creates actor record in database using
     * the info gathered from the actorUri parameter
     *
     * @param string $actorUri
     * @return \ActivityPub\Entities\Actor|null
     */
    function create_actor_from_uri($actorUri)
    {
        $activityRequest = new ActivityRequest($actorUri);
        $actorResponse = $activityRequest->get();
        $actorPayload = json_decode($actorResponse->getBody());

        $newActor = new \ActivityPub\Entities\Actor();
        $newActor->uri = $actorUri;
        $newActor->username = $actorPayload->preferredUsername;
        $newActor->domain = $activityRequest->getDomain();
        $newActor->public_key = $actorPayload->publicKey->publicKeyPem;
        $newActor->private_key = null;
        $newActor->display_name = $actorPayload->name;
        $newActor->summary = $actorPayload->summary;
        if (property_exists($actorPayload, 'icon')) {
            $newActor->avatar_image_url = $actorPayload->icon->url;
            $newActor->avatar_image_mimetype = $actorPayload->icon->mediaType;
        }

        if (property_exists($actorPayload, 'image')) {
            $newActor->cover_image_url = $actorPayload->image->url;
            $newActor->cover_image_mimetype = $actorPayload->image->mediaType;
        }
        $newActor->inbox_url = $actorPayload->inbox;
        $newActor->outbox_url = $actorPayload->outbox;
        $newActor->followers_url = $actorPayload->followers;

        if (!($newActorId = model('ActorModel')->insert($newActor, true))) {
            return null;
        }

        $newActor->id = $newActorId;
        return $newActor;
    }
}

if (!function_exists('get_current_domain')) {
    /**
     * Returns instance's domain name
     *
     * @return string
     * @throws HTTPException
     */
    function get_current_domain()
    {
        $uri = current_url(true);
        return $uri->getHost() . ($uri->getPort() ? ':' . $uri->getPort() : '');
    }
}

if (!function_exists('extract_text_from_html')) {
    /**
     * Extracts the text from html content
     *
     * @param mixed $content
     * @return string|string[]|null
     */
    function extract_text_from_html($content)
    {
        return preg_replace('/\s+/', ' ', strip_tags($content));
    }
}

if (!function_exists('linkify')) {
    /**
     * Turn all link elements in clickable links.
     * Transforms urls and handles
     *
     * @param string $value
     * @param array  $protocols  http/https, ftp, mail, twitter
     * @param array  $attributes
     * @return string
     */
    function linkify($text, $protocols = ['http', 'handle'])
    {
        $links = [];

        // Extract text links for each protocol
        foreach ((array) $protocols as $protocol) {
            switch ($protocol) {
                case 'http':
                case 'https':
                    $text = preg_replace_callback(
                        '~(?:(https?)://([^\s<]+)|(www\.[^\s<]+?\.[^\s<]+))(?<![\.,:])~i',
                        function ($match) use ($protocol, &$links) {
                            if ($match[1]) {
                                $protocol = $match[1];
                            }
                            $link = $match[2] ?: $match[3];

                            helper('text');

                            $link = preg_replace(
                                '#^www\.(.+\.)#i',
                                '$1',
                                $link,
                            );

                            return '<' .
                                array_push(
                                    $links,
                                    anchor(
                                        "$protocol://$link",
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
                    );
                    break;
                case 'handle':
                    $text = preg_replace_callback(
                        '~(?<!\w)@(?<username>\w++)(?:@(?<domain>(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]))?~',
                        function ($match) use (&$links) {
                            // check if host is set and look for actor in database
                            if (isset($match['host'])) {
                                if (
                                    $actor = model(
                                        'ActorModel',
                                    )->getActorByUsername(
                                        $match['username'],
                                        $match['domain'],
                                    )
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
                                } else {
                                    try {
                                        $actor = get_or_create_actor(
                                            $match['username'],
                                            $match['domain'],
                                        );
                                        return '<' .
                                            array_push(
                                                $links,
                                                anchor($actor->uri, $match[0], [
                                                    'target' => '_blank',
                                                    'rel' =>
                                                        'noopener noreferrer',
                                                ]),
                                            ) .
                                            '>';
                                    } catch (\CodeIgniter\HTTP\Exceptions\HTTPException $e) {
                                        // Couldn't retrieve actor, do not wrap the text in link
                                        return '<' .
                                            array_push($links, $match[0]) .
                                            '>';
                                    }
                                }
                            } else {
                                if (
                                    $actor = model(
                                        'ActorModel',
                                    )->getActorByUsername($match['username'])
                                ) {
                                    return '<' .
                                        array_push(
                                            $links,
                                            anchor($actor->uri, $match[0]),
                                        ) .
                                        '>';
                                }

                                return '<' .
                                    array_push($links, $match[0]) .
                                    '>';
                            }
                        },
                        $text,
                    );
                    break;
                default:
                    $text = preg_replace_callback(
                        '~' .
                            preg_quote($protocol, '~') .
                            '://([^\s<]+?)(?<![\.,:])~i',
                        function ($match) use ($protocol, &$links) {
                            return '<' .
                                array_push(
                                    $links,
                                    anchor("$protocol://$match[1]", $match[1], [
                                        'target' => '_blank',
                                        'rel' => 'noopener noreferrer',
                                    ]),
                                ) .
                                '>';
                        },
                        $text,
                    );
                    break;
            }
        }

        // Insert all links
        return preg_replace_callback(
            '/<(\d+)>/',
            function ($match) use (&$links) {
                return $links[$match[1] - 1];
            },
            $text,
        );
    }
}
