<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use App\Libraries\SimpleRSSElement;
use CodeIgniter\I18n\Time;
use Config\Mimes;

/**
 * Generates the rss feed for a given podcast entity
 *
 * @param App\Entities\Podcast $podcast
 * @param string $service The name of the service that fetches the RSS feed for future reference when the audio file is eventually downloaded
 * @return string rss feed as xml
 */
function get_rss_feed($podcast, $serviceName = '')
{
    $episodes = $podcast->episodes;

    $itunes_namespace = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

    $podcast_namespace =
        'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md';

    $rss = new SimpleRSSElement(
        "<?xml version='1.0' encoding='utf-8'?><rss version='2.0' xmlns:itunes='$itunes_namespace' xmlns:podcast='$podcast_namespace' xmlns:content='http://purl.org/rss/1.0/modules/content/'></rss>"
    );

    $channel = $rss->addChild('channel');

    $atom_link = $channel->addChild(
        'atom:link',
        null,
        'http://www.w3.org/2005/Atom'
    );
    $atom_link->addAttribute('href', $podcast->feed_url);
    $atom_link->addAttribute('rel', 'self');
    $atom_link->addAttribute('type', 'application/rss+xml');

    if (!empty($podcast->new_feed_url)) {
        $channel->addChild(
            'new-feed-url',
            $podcast->new_feed_url,
            $itunes_namespace
        );
    }

    // the last build date corresponds to the creation of the feed.xml cache
    $channel->addChild(
        'lastBuildDate',
        (new Time('now'))->format(DATE_RFC1123)
    );
    $channel->addChild(
        'generator',
        'Castopod 0.0.0-development - https://castopod.org/'
    );
    $channel->addChild('docs', 'https://cyber.harvard.edu/rss/rss.html');

    $channel->addChild('title', $podcast->title);
    $channel->addChildWithCDATA('description', $podcast->description_html);
    $itunes_image = $channel->addChild('image', null, $itunes_namespace);
    $itunes_image->addAttribute('href', $podcast->image->original_url);
    $channel->addChild('language', $podcast->language_code);

    if (!empty($podcast->payment_pointer)) {
        $channel->addChild(
            'monetization',
            $podcast->payment_pointer,
            $podcast_namespace
        );
    }
    $channel
        ->addChild(
            'locked',
            $podcast->is_locked ? 'yes' : 'no',
            $podcast_namespace
        )
        ->addAttribute('owner', $podcast->owner_email);
    if (!empty($podcast->imported_feed_url)) {
        $channel->addChildWithCDATA(
            'previousUrl',
            $podcast->imported_feed_url,
            $podcast_namespace
        );
    }

    foreach ($podcast->podcastingPlatforms as $podcastingPlatform) {
        $podcastingPlatformElement = $channel->addChild(
            'id',
            null,
            $podcast_namespace
        );
        $podcastingPlatformElement->addAttribute(
            'platform',
            $podcastingPlatform->slug
        );
        if (!empty($podcastingPlatform->link_content)) {
            $podcastingPlatformElement->addAttribute(
                'id',
                $podcastingPlatform->link_content
            );
        }
        if (!empty($podcastingPlatform->link_url)) {
            $podcastingPlatformElement->addAttribute(
                'url',
                htmlspecialchars($podcastingPlatform->link_url)
            );
        }
    }

    foreach ($podcast->socialPlatforms as $socialPlatform) {
        $socialPlatformElement = $channel->addChild(
            'social',
            $socialPlatform->link_content,
            $podcast_namespace
        );
        $socialPlatformElement->addAttribute('platform', $socialPlatform->slug);
        if (!empty($socialPlatform->link_url)) {
            $socialPlatformElement->addAttribute(
                'url',
                htmlspecialchars($socialPlatform->link_url)
            );
        }
    }

    foreach ($podcast->fundingPlatforms as $fundingPlatform) {
        $fundingPlatformElement = $channel->addChild(
            'funding',
            $fundingPlatform->link_content,
            $podcast_namespace
        );
        $fundingPlatformElement->addAttribute(
            'platform',
            $fundingPlatform->slug
        );
        if (!empty($socialPlatform->link_url)) {
            $fundingPlatformElement->addAttribute(
                'url',
                htmlspecialchars($fundingPlatform->link_url)
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
        $itunes_namespace
    );

    $podcast->publisher &&
        $channel->addChild('author', $podcast->publisher, $itunes_namespace);
    $channel->addChild('link', $podcast->link);

    $owner = $channel->addChild('owner', null, $itunes_namespace);
    $owner->addChild('name', $podcast->owner_name, $itunes_namespace);
    $owner->addChild('email', $podcast->owner_email, $itunes_namespace);

    $channel->addChild('type', $podcast->type, $itunes_namespace);
    $podcast->copyright && $channel->addChild('copyright', $podcast->copyright);
    $podcast->is_blocked &&
        $channel->addChild('block', 'Yes', $itunes_namespace);
    $podcast->is_completed &&
        $channel->addChild('complete', 'Yes', $itunes_namespace);

    $image = $channel->addChild('image');
    $image->addChild('url', $podcast->image->feed_url);
    $image->addChild('title', $podcast->title);
    $image->addChild('link', $podcast->link);

    foreach ($episodes as $episode) {
        $item = $channel->addChild('item');
        $item->addChild('title', $episode->title);
        $enclosure = $item->addChild('enclosure');

        $enclosure->addAttribute(
            'url',
            $episode->enclosure_url .
                (empty($serviceName) ? '' : '?_from=' . urlencode($serviceName))
        );
        $enclosure->addAttribute('length', $episode->enclosure_filesize);
        $enclosure->addAttribute('type', $episode->enclosure_mimetype);

        $item->addChild('guid', $episode->guid);
        $item->addChild(
            'pubDate',
            $episode->published_at->format(DATE_RFC1123)
        );
        $item->addChildWithCDATA('description', $episode->description_html);
        $item->addChild(
            'duration',
            $episode->enclosure_duration,
            $itunes_namespace
        );
        $item->addChild('link', $episode->link);
        $episode_itunes_image = $item->addChild(
            'image',
            null,
            $itunes_namespace
        );
        $episode_itunes_image->addAttribute('href', $episode->image->feed_url);

        $episode->parental_advisory &&
            $item->addChild(
                'explicit',
                $episode->parental_advisory === 'explicit' ? 'true' : 'false',
                $itunes_namespace
            );

        $episode->number &&
            $item->addChild('episode', $episode->number, $itunes_namespace);
        $episode->season_number &&
            $item->addChild(
                'season',
                $episode->season_number,
                $itunes_namespace
            );
        $item->addChild('episodeType', $episode->type, $itunes_namespace);

        if ($episode->transcript) {
            $transcriptElement = $item->addChild(
                'transcript',
                null,
                $podcast_namespace
            );
            $transcriptElement->addAttribute('url', $episode->transcriptUrl);
            $transcriptElement->addAttribute(
                'type',
                Mimes::guessTypeFromExtension(
                    pathinfo($episode->transcript_uri, PATHINFO_EXTENSION)
                )
            );
            $transcriptElement->addAttribute(
                'language',
                $podcast->language_code
            );
        }

        if ($episode->chapters) {
            $chaptersElement = $item->addChild(
                'chapters',
                null,
                $podcast_namespace
            );
            $chaptersElement->addAttribute('url', $episode->chaptersUrl);
            $chaptersElement->addAttribute('type', 'application/json+chapters');
        }

        $episode->is_blocked &&
            $item->addChild('block', 'Yes', $itunes_namespace);
    }

    return $rss->asXML();
}

/**
 * Adds <itunes:category> and <category> tags to node for a given category
 *
 * @param \SimpleXMLElement $node
 * @param \App\Entities\Category $category
 *
 * @return void
 */
function add_category_tag($node, $category)
{
    $itunes_namespace = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

    $itunes_category = $node->addChild('category', null, $itunes_namespace);
    $itunes_category->addAttribute(
        'text',
        $category->parent
            ? $category->parent->apple_category
            : $category->apple_category
    );

    if ($category->parent) {
        $itunes_category_child = $itunes_category->addChild(
            'category',
            null,
            $itunes_namespace
        );
        $itunes_category_child->addAttribute('text', $category->apple_category);
        $node->addChild('category', $category->parent->apple_category);
    }
    $node->addChild('category', $category->apple_category);
}
