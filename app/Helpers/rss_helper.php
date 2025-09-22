<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */
use App\Entities\Category;
use App\Entities\Location;
use App\Entities\Podcast;
use App\Libraries\RssFeed;
use App\Models\PodcastModel;
use CodeIgniter\I18n\Time;
use Config\Mimes;
use Modules\Media\Entities\Chapters;
use Modules\Media\Entities\Transcript;
use Modules\Plugins\Core\Plugins;
use Modules\PremiumPodcasts\Entities\Subscription;

if (! function_exists('get_rss_feed')) {
    /**
     * Generates the rss feed for a given podcast entity
     *
     * @param string $serviceSlug The name of the service that fetches the RSS feed for future reference when the audio file is eventually downloaded
     * @return string rss feed as xml
     */
    function get_rss_feed(
        Podcast $podcast,
        string $serviceSlug = '',
        ?Subscription $subscription = null,
        ?string $token = null,
    ): string {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $episodes = $podcast->episodes;

        $rss = new RssFeed();

        $plugins->rssBeforeChannel($podcast);

        $channel = $rss->addChild('channel');

        $atomLink = $channel->addChild('link', null, RssFeed::ATOM_NAMESPACE);
        $atomLink->addAttribute('href', $podcast->feed_url);
        $atomLink->addAttribute('rel', 'self');
        $atomLink->addAttribute('type', 'application/rss+xml');

        // websub: add links to hubs defined in config
        $websubHubs = config('WebSub')
            ->hubs;
        foreach ($websubHubs as $websubHub) {
            $atomLinkHub = $channel->addChild('link', null, RssFeed::ATOM_NAMESPACE);
            $atomLinkHub->addAttribute('href', $websubHub);
            $atomLinkHub->addAttribute('rel', 'hub');
            $atomLinkHub->addAttribute('type', 'application/rss+xml');
        }

        if ($podcast->new_feed_url !== null) {
            $channel->addChild('new-feed-url', $podcast->new_feed_url, RssFeed::ITUNES_NAMESPACE);
        }

        // the last build date corresponds to the creation of the feed.xml cache
        $channel->addChild('lastBuildDate', new Time('now')->format(DATE_RFC1123));
        $channel->addChild('generator', 'Castopod - https://castopod.org/');
        $channel->addChild('docs', 'https://cyber.harvard.edu/rss/rss.html');

        if ($podcast->guid === '') {
            // FIXME: guid shouldn't be empty here as it should be filled upon Podcast creation
            $uuid = service('uuid');
            // 'ead4c236-bf58-58c6-a2c6-a6b28d128cb6' is the uuid of the podcast namespace
            $podcast->guid = $uuid->uuid5('ead4c236-bf58-58c6-a2c6-a6b28d128cb6', $podcast->feed_url)
                ->toString();

            new PodcastModel()
                ->save($podcast);
        }

        $channel->addChild('guid', $podcast->guid, RssFeed::PODCAST_NAMESPACE);
        $channel->addChild('title', $podcast->title, null, false);
        $channel->addChildWithCDATA('description', $podcast->description_html);

        $itunesImage = $channel->addChild('image', null, RssFeed::ITUNES_NAMESPACE);

        $itunesImage->addAttribute('href', $podcast->cover->feed_url);

        $channel->addChild('language', $podcast->language_code);
        if ($podcast->location instanceof Location) {
            $locationElement = $channel->addChild('location', $podcast->location->name, RssFeed::PODCAST_NAMESPACE);
            if ($podcast->location->geo !== null) {
                $locationElement->addAttribute('geo', $podcast->location->geo);
            }

            if ($podcast->location->osm !== null) {
                $locationElement->addAttribute('osm', $podcast->location->osm);
            }
        }

        $channel
            ->addChild('locked', $podcast->is_locked ? 'yes' : 'no', RssFeed::PODCAST_NAMESPACE)
            ->addAttribute('owner', $podcast->owner_email);

        if ($podcast->imported_feed_url !== null) {
            $channel->addChild('previousUrl', $podcast->imported_feed_url, RssFeed::PODCAST_NAMESPACE);
        }

        foreach ($podcast->podcasting_platforms as $podcastingPlatform) {
            $podcastingPlatformElement = $channel->addChild('id', null, RssFeed::PODCAST_NAMESPACE);
            $podcastingPlatformElement->addAttribute('platform', $podcastingPlatform->slug);
            if ($podcastingPlatform->account_id !== null) {
                $podcastingPlatformElement->addAttribute('id', $podcastingPlatform->account_id);
            }

            $podcastingPlatformElement->addAttribute('url', $podcastingPlatform->link_url);
        }

        $castopodSocialElement = $channel->addChild('social', null, RssFeed::PODCAST_NAMESPACE);
        $castopodSocialElement->addAttribute('priority', '1');
        $castopodSocialElement->addAttribute('platform', 'castopod');
        $castopodSocialElement->addAttribute('protocol', 'activitypub');
        $castopodSocialElement->addAttribute('accountId', "@{$podcast->actor->username}@{$podcast->actor->domain}");
        $castopodSocialElement->addAttribute('accountUrl', $podcast->link);

        foreach ($podcast->social_platforms as $socialPlatform) {
            $socialElement = $channel->addChild('social', null, RssFeed::PODCAST_NAMESPACE);
            $socialElement->addAttribute('priority', '2');
            $socialElement->addAttribute('platform', $socialPlatform->slug);

            // TODO: get activitypub info somewhere else
            if (in_array(
                $socialPlatform->slug,
                ['mastodon', 'peertube', 'funkwhale', 'misskey', 'mobilizon', 'pixelfed', 'plume', 'writefreely'],
                true,
            )) {
                $socialElement->addAttribute('protocol', 'activitypub');
            } else {
                $socialElement->addAttribute('protocol', $socialPlatform->slug);
            }

            if ($socialPlatform->account_id !== null) {
                $socialElement->addAttribute('accountId', esc($socialPlatform->account_id));
            }

            $socialElement->addAttribute('accountUrl', esc($socialPlatform->link_url));

            if ($socialPlatform->slug === 'mastodon') {
                $socialSignUpelement = $socialElement->addChild('socialSignUp', null, RssFeed::PODCAST_NAMESPACE);
                $socialSignUpelement->addAttribute('priority', '1');
                $socialSignUpelement->addAttribute(
                    'homeUrl',
                    parse_url((string) $socialPlatform->link_url, PHP_URL_SCHEME) . '://' . parse_url(
                        (string) $socialPlatform->link_url,
                        PHP_URL_HOST,
                    ) . '/public',
                );
                $socialSignUpelement->addAttribute(
                    'signUpUrl',
                    parse_url((string) $socialPlatform->link_url, PHP_URL_SCHEME) . '://' . parse_url(
                        (string) $socialPlatform->link_url,
                        PHP_URL_HOST,
                    ) . '/auth/sign_up',
                );
                $castopodSocialSignUpelement = $castopodSocialElement->addChild(
                    'socialSignUp',
                    null,
                    RssFeed::PODCAST_NAMESPACE,
                );
                $castopodSocialSignUpelement->addAttribute('priority', '1');
                $castopodSocialSignUpelement->addAttribute(
                    'homeUrl',
                    parse_url((string) $socialPlatform->link_url, PHP_URL_SCHEME) . '://' . parse_url(
                        (string) $socialPlatform->link_url,
                        PHP_URL_HOST,
                    ) . '/public',
                );
                $castopodSocialSignUpelement->addAttribute(
                    'signUpUrl',
                    parse_url((string) $socialPlatform->link_url, PHP_URL_SCHEME) . '://' . parse_url(
                        (string) $socialPlatform->link_url,
                        PHP_URL_HOST,
                    ) . '/auth/sign_up',
                );
            }
        }

        foreach ($podcast->funding_platforms as $fundingPlatform) {
            $fundingPlatformElement = $channel->addChild(
                'funding',
                $fundingPlatform->account_id,
                RssFeed::PODCAST_NAMESPACE,
            );
            $fundingPlatformElement->addAttribute('platform', $fundingPlatform->slug);
            $fundingPlatformElement->addAttribute('url', $fundingPlatform->link_url);
        }

        foreach ($podcast->persons as $person) {
            foreach ($person->roles as $role) {
                $personElement = $channel->addChild('person', $person->full_name, RssFeed::PODCAST_NAMESPACE);

                $personElement->addAttribute('img', get_avatar_url($person, 'medium'));

                if ($person->information_url !== null) {
                    $personElement->addAttribute('href', $person->information_url);
                }

                $personElement->addAttribute(
                    'role',
                    lang("PersonsTaxonomy.persons.{$role->group}.roles.{$role->role}.label", [], 'en'),
                );

                $personElement->addAttribute(
                    'group',
                    lang("PersonsTaxonomy.persons.{$role->group}.label", [], 'en'),
                );
            }
        }

        // set main category first, then other categories as apple
        add_category_tag($channel, $podcast->category);
        foreach ($podcast->other_categories as $other_category) {
            add_category_tag($channel, $other_category);
        }

        $channel->addChild(
            'explicit',
            $podcast->parental_advisory === 'explicit' ? 'true' : 'false',
            RssFeed::ITUNES_NAMESPACE,
        );

        $channel->addChild('author', $podcast->publisher ?: $podcast->owner_name, RssFeed::ITUNES_NAMESPACE, false);
        $channel->addChild('link', $podcast->link);

        $owner = $channel->addChild('owner', null, RssFeed::ITUNES_NAMESPACE);

        $owner->addChild('name', $podcast->owner_name, RssFeed::ITUNES_NAMESPACE, false);
        $owner->addChild('email', $podcast->owner_email, RssFeed::ITUNES_NAMESPACE);

        $channel->addChild('type', $podcast->type, RssFeed::ITUNES_NAMESPACE);
        $podcast->copyright &&
            $channel->addChild('copyright', $podcast->copyright);
        if ($podcast->is_blocked || $subscription instanceof Subscription) {
            $channel->addChild('block', 'Yes', RssFeed::ITUNES_NAMESPACE);
        }

        if ($podcast->is_completed) {
            $channel->addChild('complete', 'Yes', RssFeed::ITUNES_NAMESPACE);
        }

        $image = $channel->addChild('image');
        $image->addChild('url', $podcast->cover->feed_url);
        $image->addChild('title', $podcast->title, null, false);
        $image->addChild('link', $podcast->link);

        // run plugins hook at the end
        $plugins->rssAfterChannel($podcast, $channel);

        foreach ($episodes as $episode) {
            if ($episode->is_premium && ! $subscription instanceof Subscription) {
                continue;
            }

            $plugins->rssBeforeItem($episode);

            $item = $channel->addChild('item');
            $item->addChild('title', $episode->title, null, false);
            $enclosure = $item->addChild('enclosure');

            $enclosureParams = implode('&', array_filter([
                $episode->is_premium ? 'token=' . $token : null,
                $serviceSlug !== '' ? '_from=' . urlencode($serviceSlug) : null,
            ]));

            $enclosure->addAttribute(
                'url',
                $episode->audio_url . ($enclosureParams === '' ? '' : '?' . $enclosureParams),
            );
            $enclosure->addAttribute('length', (string) $episode->audio->file_size);
            $enclosure->addAttribute('type', $episode->audio->file_mimetype);

            $item->addChild('guid', $episode->guid);
            $item->addChild('pubDate', $episode->published_at->format(DATE_RFC1123));
            if ($episode->location instanceof Location) {
                $locationElement = $item->addChild('location', $episode->location->name, RssFeed::PODCAST_NAMESPACE);
                if ($episode->location->geo !== null) {
                    $locationElement->addAttribute('geo', $episode->location->geo);
                }

                if ($episode->location->osm !== null) {
                    $locationElement->addAttribute('osm', $episode->location->osm);
                }
            }

            $item->addChildWithCDATA('description', $episode->description_html);
            $item->addChild('duration', (string) round($episode->audio->duration), RssFeed::ITUNES_NAMESPACE);
            $item->addChild('link', $episode->link);
            $episodeItunesImage = $item->addChild('image', null, RssFeed::ITUNES_NAMESPACE);
            $episodeItunesImage->addAttribute('href', $episode->cover->feed_url);

            $episode->parental_advisory &&
                $item->addChild(
                    'explicit',
                    $episode->parental_advisory === 'explicit'
                        ? 'true'
                        : 'false',
                    RssFeed::ITUNES_NAMESPACE,
                );

            $episode->number &&
                $item->addChild('episode', (string) $episode->number, RssFeed::ITUNES_NAMESPACE);
            $episode->season_number &&
                $item->addChild('season', (string) $episode->season_number, RssFeed::ITUNES_NAMESPACE);
            $item->addChild('episodeType', $episode->type, RssFeed::ITUNES_NAMESPACE);

            // If episode is of type trailer, add podcast:trailer tag on channel level
            if ($episode->type === 'trailer') {
                $trailer = $channel->addChild('trailer', $episode->title, RssFeed::PODCAST_NAMESPACE);
                $trailer->addAttribute('pubdate', $episode->published_at->format(DATE_RFC2822));
                $trailer->addAttribute(
                    'url',
                    $episode->audio_url . ($enclosureParams === '' ? '' : '?' . $enclosureParams),
                );
                $trailer->addAttribute('length', (string) $episode->audio->file_size);
                $trailer->addAttribute('type', $episode->audio->file_mimetype);
                if ($episode->season_number !== null) {
                    $trailer->addAttribute('season', (string) $episode->season_number);
                }
            }

            // add link to episode comments as podcast-activity format
            $comments = $item->addChild('comments', null, RssFeed::PODCAST_NAMESPACE);
            $comments->addAttribute('uri', url_to('episode-comments', $podcast->handle, $episode->slug));
            $comments->addAttribute('contentType', 'application/podcast-activity+json');

            if ($episode->getPosts()) {
                $socialInteractUri = $episode->getPosts()[0]
                    ->uri;
                $socialInteractElement = $item->addChild('socialInteract', null, RssFeed::PODCAST_NAMESPACE);
                $socialInteractElement->addAttribute('uri', $socialInteractUri);
                $socialInteractElement->addAttribute('priority', '1');
                $socialInteractElement->addAttribute('platform', 'castopod');
                $socialInteractElement->addAttribute('protocol', 'activitypub');
                $socialInteractElement->addAttribute(
                    'accountId',
                    "@{$podcast->actor->username}@{$podcast->actor->domain}",
                );
                $socialInteractElement->addAttribute(
                    'pubDate',
                    $episode->getPosts()[0]
                        ->published_at->format(DateTime::ISO8601),
                );
            }

            if ($episode->transcript instanceof Transcript) {
                $transcriptElement = $item->addChild('transcript', null, RssFeed::PODCAST_NAMESPACE);
                $transcriptElement->addAttribute('url', $episode->transcript->file_url);
                $transcriptElement->addAttribute(
                    'type',
                    Mimes::guessTypeFromExtension(
                        pathinfo($episode->transcript->file_url, PATHINFO_EXTENSION),
                    ) ?? 'text/html',
                );
                // Castopod only allows for captions (SubRip files)
                $transcriptElement->addAttribute('rel', 'captions');
                // TODO: allow for multiple languages
                $transcriptElement->addAttribute('language', $podcast->language_code);
            }

            if ($episode->getChapters() instanceof Chapters) {
                $chaptersElement = $item->addChild('chapters', null, RssFeed::PODCAST_NAMESPACE);
                $chaptersElement->addAttribute('url', $episode->chapters->file_url);
                $chaptersElement->addAttribute('type', 'application/json+chapters');
            }

            foreach ($episode->soundbites as $soundbite) {
                // TODO: differentiate video from soundbites?
                $soundbiteElement = $item->addChild('soundbite', $soundbite->title, RssFeed::PODCAST_NAMESPACE);
                $soundbiteElement->addAttribute('startTime', (string) $soundbite->start_time);
                $soundbiteElement->addAttribute('duration', (string) round($soundbite->duration, 3));
            }

            foreach ($episode->persons as $person) {
                foreach ($person->roles as $role) {
                    $personElement = $item->addChild('person', esc($person->full_name), RssFeed::PODCAST_NAMESPACE);

                    $personElement->addAttribute(
                        'role',
                        esc(lang("PersonsTaxonomy.persons.{$role->group}.roles.{$role->role}.label", [], 'en')),
                    );

                    $personElement->addAttribute(
                        'group',
                        esc(lang("PersonsTaxonomy.persons.{$role->group}.label", [], 'en')),
                    );

                    $personElement->addAttribute('img', get_avatar_url($person, 'medium'));

                    if ($person->information_url !== null) {
                        $personElement->addAttribute('href', $person->information_url);
                    }
                }
            }

            if ($episode->is_blocked) {
                $item->addChild('block', 'Yes', RssFeed::ITUNES_NAMESPACE);
            }

            $plugins->rssAfterItem($episode, $item);
        }

        return $rss->asXML();
    }
}

if (! function_exists('add_category_tag')) {
    /**
     * Adds <itunes:category> and <category> tags to node for a given category
     */
    function add_category_tag(RssFeed $node, Category $category): void
    {
        $itunesCategory = $node->addChild('category', null, RssFeed::ITUNES_NAMESPACE);
        $itunesCategory->addAttribute(
            'text',
            $category->parent instanceof Category
                ? $category->parent->apple_category
                : $category->apple_category,
        );

        if ($category->parent instanceof Category) {
            $itunesCategoryChild = $itunesCategory->addChild('category', null, RssFeed::ITUNES_NAMESPACE);
            $itunesCategoryChild->addAttribute('text', $category->apple_category);
            $node->addChild('category', $category->parent->apple_category);
        }

        $node->addChild('category', $category->apple_category);
    }
}
