<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use App\Models\CategoryModel;
use CodeIgniter\I18n\Time;

/**
 * Generates the rss feed for a given podcast entity
 *
 * @param App\Entities\Podcast $podcast
 * @return string rss feed as xml
 */
function get_rss_feed($podcast)
{
    $category_model = new CategoryModel();

    $episodes = $podcast->episodes;

    $podcast_category = $category_model
        ->where('code', $podcast->category)
        ->first();

    $itunes_namespace = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

    $rss = new SimpleRSSElement(
        "<?xml version='1.0' encoding='utf-8'?><rss version='2.0' xmlns:itunes='$itunes_namespace' xmlns:content='http://purl.org/rss/1.0/modules/content/'></rss>"
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

    // the last build date corresponds to the creation of the feed.xml cache
    $channel->addChild(
        'lastBuildDate',
        (new Time('now'))->format(DATE_RFC1123)
    );
    $channel->addChild(
        'generator',
        'Castopod 0.0.0-development - https://castopod.org'
    );
    $channel->addChild('docs', 'https://cyber.harvard.edu/rss/rss.html');

    $channel->addChild('title', $podcast->title);
    $channel->addChildWithCDATA('description', $podcast->description);
    $itunes_image = $channel->addChild('image', null, $itunes_namespace);
    $itunes_image->addAttribute('href', $podcast->image_url);
    $channel->addChild('language', $podcast->language);

    $itunes_category = $channel->addChild('category', null, $itunes_namespace);
    $itunes_category->addAttribute(
        'text',
        $podcast_category->parent
            ? $podcast_category->parent->apple_category
            : $podcast_category->apple_category
    );

    if ($podcast_category->parent) {
        $itunes_category_child = $itunes_category->addChild(
            'category',
            null,
            $itunes_namespace
        );
        $itunes_category_child->addAttribute(
            'text',
            $podcast_category->apple_category
        );
        $channel->addChild(
            'category',
            $podcast_category->parent->apple_category
        );
    }
    $channel->addChild('category', $podcast_category->apple_category);

    $channel->addChild(
        'explicit',
        $podcast->explicit ? 'true' : 'false',
        $itunes_namespace
    );

    $podcast->author_name &&
        $channel->addChild('author', $podcast->author_name, $itunes_namespace);
    $channel->addChild('link', $podcast->link);

    if ($podcast->owner_name || $podcast->owner_email) {
        $owner = $channel->addChild('owner', null, $itunes_namespace);
        $podcast->owner_name &&
            $owner->addChild('name', $podcast->owner_name, $itunes_namespace);
        $podcast->owner_email &&
            $owner->addChild('email', $podcast->owner_email, $itunes_namespace);
    }

    $channel->addChild('type', $podcast->type, $itunes_namespace);
    $podcast->copyright && $channel->addChild('copyright', $podcast->copyright);
    $podcast->block && $channel->addChild('block', 'Yes', $itunes_namespace);
    $podcast->complete &&
        $channel->addChild('complete', 'Yes', $itunes_namespace);

    $image = $channel->addChild('image');
    $image->addChild('url', $podcast->image_url);
    $image->addChild('title', $podcast->title);
    $image->addChild('link', $podcast->link);

    foreach ($episodes as $episode) {
        $item = $channel->addChild('item');
        $item->addChild('title', $episode->title);
        $enclosure = $item->addChild('enclosure');

        $enclosure_metadata = $episode->enclosure_metadata;
        $enclosure->addAttribute('url', $episode->enclosure_url);
        $enclosure->addAttribute('length', $enclosure_metadata['filesize']);
        $enclosure->addAttribute('type', $enclosure_metadata['mime_type']);

        $item->addChild('guid', $episode->guid);
        $item->addChild('pubDate', $episode->pub_date->format(DATE_RFC1123));
        $item->addChildWithCDATA('description', $episode->description);
        $item->addChild(
            'duration',
            $enclosure_metadata['playtime_seconds'],
            $itunes_namespace
        );
        $item->addChild('link', $episode->link);
        $episode_itunes_image = $item->addChild(
            'image',
            null,
            $itunes_namespace
        );
        $episode_itunes_image->addAttribute('href', $episode->image_url);
        $item->addChild(
            'explicit',
            $episode->explicit ? 'true' : 'false',
            $itunes_namespace
        );

        if ($episode->author_email || $episode->author_name) {
            $item->addChild(
                'author',
                $episode->author_name
                    ? $episode->author_email .
                        ' (' .
                        $episode->author_name .
                        ')'
                    : $episode->author_email
            );
        }

        $item->addChild('episode', $episode->number, $itunes_namespace);
        $episode->season_number &&
            $item->addChild(
                'season',
                $episode->season_number,
                $itunes_namespace
            );
        $item->addChild('episodeType', $episode->type, $itunes_namespace);

        $episode->block && $item->addChild('block', 'Yes', $itunes_namespace);
    }

    return $rss->asXML();
}
