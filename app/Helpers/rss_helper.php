<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use App\Entities\Category;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;
use CodeIgniter\I18n\Time;
use Config\Mimes;

if (! function_exists('get_rss_feed')) {
    /**
     * Generates the rss feed for a given podcast entity
     *
     * @param string $serviceSlug The name of the service that fetches the RSS feed for future reference when the audio file is eventually downloaded
     * @return string rss feed as xml
     */
    function get_rss_feed(Podcast $podcast, string $serviceSlug = ''): string
    {
        $episodes = $podcast->episodes;

        $itunesNamespace = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

        $podcastNamespace =
            'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md';

        $rss = new SimpleRSSElement(
            "<?xml version='1.0' encoding='utf-8'?><rss version='2.0' xmlns:itunes='{$itunesNamespace}' xmlns:podcast='{$podcastNamespace}' xmlns:content='http://purl.org/rss/1.0/modules/content/'></rss>",
        );

        $channel = $rss->addChild('channel');

        $atomLink = $channel->addChild('atom:link', null, 'http://www.w3.org/2005/Atom');
        $atomLink->addAttribute('href', $podcast->feed_url);
        $atomLink->addAttribute('rel', 'self');
        $atomLink->addAttribute('type', 'application/rss+xml');

        if ($podcast->new_feed_url !== null) {
            $channel->addChild('new-feed-url', $podcast->new_feed_url, $itunesNamespace);
        }

        // the last build date corresponds to the creation of the feed.xml cache
        $channel->addChild('lastBuildDate', (new Time('now'))->format(DATE_RFC1123));
        $channel->addChild('generator', 'Castopod Host - https://castopod.org/');
        $channel->addChild('docs', 'https://cyber.harvard.edu/rss/rss.html');

        $channel->addChild('guid', $podcast->guid, $podcastNamespace);
        $channel->addChild('title', $podcast->title);
        $channel->addChildWithCDATA('description', $podcast->description_html);

        $itunesImage = $channel->addChild('image', null, $itunesNamespace);

        // FIXME: This should be downsized to 1400x1400
        $itunesImage->addAttribute('href', $podcast->image->url);

        $channel->addChild('language', $podcast->language_code);
        if ($podcast->location !== null) {
            $locationElement = $channel->addChild(
                'location',
                htmlspecialchars($podcast->location->name),
                $podcastNamespace,
            );
            if ($podcast->location->geo !== null) {
                $locationElement->addAttribute('geo', $podcast->location->geo);
            }
            if ($podcast->location->osm !== null) {
                $locationElement->addAttribute('osm', $podcast->location->osm);
            }
        }
        if ($podcast->payment_pointer !== null) {
            $valueElement = $channel->addChild('value', null, $podcastNamespace);
            $valueElement->addAttribute('type', 'webmonetization');
            $valueElement->addAttribute('method', '');
            $valueElement->addAttribute('suggested', '');
            $recipientElement = $valueElement->addChild('valueRecipient', null, $podcastNamespace);
            $recipientElement->addAttribute('name', $podcast->owner_name);
            $recipientElement->addAttribute('type', 'ILP');
            $recipientElement->addAttribute('address', $podcast->payment_pointer);
            $recipientElement->addAttribute('split', '100');
        }
        $channel
            ->addChild('locked', $podcast->is_locked ? 'yes' : 'no', $podcastNamespace)
            ->addAttribute('owner', $podcast->owner_email);
        if ($podcast->imported_feed_url !== null) {
            $channel->addChild('previousUrl', $podcast->imported_feed_url, $podcastNamespace);
        }

        foreach ($podcast->podcasting_platforms as $podcastingPlatform) {
            $podcastingPlatformElement = $channel->addChild('id', null, $podcastNamespace);
            $podcastingPlatformElement->addAttribute('platform', $podcastingPlatform->slug);
            if ($podcastingPlatform->link_content !== null) {
                $podcastingPlatformElement->addAttribute('id', $podcastingPlatform->link_content);
            }
            if ($podcastingPlatform->link_url !== null) {
                $podcastingPlatformElement->addAttribute('url', htmlspecialchars($podcastingPlatform->link_url));
            }
        }

        foreach ($podcast->social_platforms as $socialPlatform) {
            $socialPlatformElement = $channel->addChild(
                'social',
                $socialPlatform->link_content,
                $podcastNamespace,
            );
            $socialPlatformElement->addAttribute('platform', $socialPlatform->slug);
            if ($socialPlatform->link_url !== null) {
                $socialPlatformElement->addAttribute('url', htmlspecialchars($socialPlatform->link_url));
            }
        }

        foreach ($podcast->funding_platforms as $fundingPlatform) {
            $fundingPlatformElement = $channel->addChild(
                'funding',
                $fundingPlatform->link_content,
                $podcastNamespace,
            );
            $fundingPlatformElement->addAttribute('platform', $fundingPlatform->slug);
            if ($fundingPlatform->link_url !== null) {
                $fundingPlatformElement->addAttribute('url', htmlspecialchars($fundingPlatform->link_url));
            }
        }

        foreach ($podcast->persons as $person) {
            foreach ($person->roles as $role) {
                $personElement = $channel->addChild(
                    'person',
                    htmlspecialchars($person->full_name),
                    $podcastNamespace,
                );

                $personElement->addAttribute('img', $person->image->large_url);

                if ($person->information_url !== null) {
                    $personElement->addAttribute('href', $person->information_url);
                }

                $personElement->addAttribute(
                    'role',
                    htmlspecialchars(
                        lang("PersonsTaxonomy.persons.{$role->group}.roles.{$role->role}.label", [], 'en'),
                    ),
                );

                $personElement->addAttribute(
                    'group',
                    htmlspecialchars(lang("PersonsTaxonomy.persons.{$role->group}.label", [], 'en')),
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
            $itunesNamespace,
        );

        $channel->addChild(
            'author',
            $podcast->publisher ? $podcast->publisher : $podcast->owner_name,
            $itunesNamespace,
        );
        $channel->addChild('link', $podcast->link);

        $owner = $channel->addChild('owner', null, $itunesNamespace);

        $owner->addChild('name', $podcast->owner_name, $itunesNamespace);

        $owner->addChild('email', $podcast->owner_email, $itunesNamespace);

        $channel->addChild('type', $podcast->type, $itunesNamespace);
        $podcast->copyright &&
            $channel->addChild('copyright', $podcast->copyright);
        $podcast->is_blocked &&
            $channel->addChild('block', 'Yes', $itunesNamespace);
        $podcast->is_completed &&
            $channel->addChild('complete', 'Yes', $itunesNamespace);

        $image = $channel->addChild('image');
        $image->addChild('url', $podcast->image->feed_url);
        $image->addChild('title', $podcast->title);
        $image->addChild('link', $podcast->link);

        if ($podcast->custom_rss !== null) {
            array_to_rss([
                'elements' => $podcast->custom_rss,
            ], $channel);
        }

        foreach ($episodes as $episode) {
            $item = $channel->addChild('item');
            $item->addChild('title', $episode->title);
            $enclosure = $item->addChild('enclosure');

            $enclosure->addAttribute(
                'url',
                $episode->audio_file_analytics_url .
                    ($serviceSlug === ''
                        ? ''
                        : '?_from=' . urlencode($serviceSlug)),
            );
            $enclosure->addAttribute('length', (string) $episode->audio_file_size);
            $enclosure->addAttribute('type', $episode->audio_file_mimetype);

            $item->addChild('guid', $episode->guid);
            $item->addChild('pubDate', $episode->published_at->format(DATE_RFC1123));
            if ($episode->location !== null) {
                $locationElement = $item->addChild(
                    'location',
                    htmlspecialchars($episode->location->name),
                    $podcastNamespace,
                );
                if ($episode->location->geo !== null) {
                    $locationElement->addAttribute('geo', $episode->location->geo);
                }
                if ($episode->location->osm !== null) {
                    $locationElement->addAttribute('osm', $episode->location->osm);
                }
            }
            $item->addChildWithCDATA('description', $episode->getDescriptionHtml($serviceSlug));
            $item->addChild('duration', (string) $episode->audio_file_duration, $itunesNamespace);
            $item->addChild('link', $episode->link);
            $episodeItunesImage = $item->addChild('image', null, $itunesNamespace);
            $episodeItunesImage->addAttribute('href', $episode->image->feed_url);

            $episode->parental_advisory &&
                $item->addChild(
                    'explicit',
                    $episode->parental_advisory === 'explicit'
                        ? 'true'
                        : 'false',
                    $itunesNamespace,
                );

            $episode->number &&
                $item->addChild('episode', (string) $episode->number, $itunesNamespace);
            $episode->season_number &&
                $item->addChild('season', (string) $episode->season_number, $itunesNamespace);
            $item->addChild('episodeType', $episode->type, $itunesNamespace);

            // add link to episode comments as podcast-activity format
            $comments = $item->addChild('comments', null, $podcastNamespace);
            $comments->addAttribute('uri', url_to('episode-comments', $podcast->name, $episode->slug));
            $comments->addAttribute('contentType', 'application/podcast-activity+json');

            if ($episode->transcript_file_url) {
                $transcriptElement = $item->addChild('transcript', null, $podcastNamespace);
                $transcriptElement->addAttribute('url', $episode->transcript_file_url);
                $transcriptElement->addAttribute(
                    'type',
                    Mimes::guessTypeFromExtension(
                        pathinfo($episode->transcript_file_url, PATHINFO_EXTENSION)
                    ) ?? 'text/html',
                );
                $transcriptElement->addAttribute('language', $podcast->language_code);
            }

            if ($episode->chapters_file_url) {
                $chaptersElement = $item->addChild('chapters', null, $podcastNamespace);
                $chaptersElement->addAttribute('url', $episode->chapters_file_url);
                $chaptersElement->addAttribute('type', 'application/json+chapters');
            }

            foreach ($episode->soundbites as $soundbite) {
                $soundbiteElement = $item->addChild('soundbite', $soundbite->label, $podcastNamespace);
                $soundbiteElement->addAttribute('start_time', (string) $soundbite->start_time);
                $soundbiteElement->addAttribute('duration', (string) $soundbite->duration);
            }

            foreach ($episode->persons as $person) {
                foreach ($person->roles as $role) {
                    $personElement = $item->addChild(
                        'person',
                        htmlspecialchars($person->full_name),
                        $podcastNamespace,
                    );

                    $personElement->addAttribute(
                        'role',
                        htmlspecialchars(
                            lang("PersonsTaxonomy.persons.{$role->group}.roles.{$role->role}.label", [], 'en'),
                        ),
                    );

                    $personElement->addAttribute(
                        'group',
                        htmlspecialchars(lang("PersonsTaxonomy.persons.{$role->group}.label", [], 'en')),
                    );

                    $personElement->addAttribute('img', $person->image->large_url);

                    if ($person->information_url !== null) {
                        $personElement->addAttribute('href', $person->information_url);
                    }
                }
            }

            $episode->is_blocked &&
                $item->addChild('block', 'Yes', $itunesNamespace);

            if ($episode->custom_rss !== null) {
                array_to_rss([
                    'elements' => $episode->custom_rss,
                ], $item);
            }
        }

        return $rss->asXML();
    }
}

if (! function_exists('add_category_tag')) {
    /**
     * Adds <itunes:category> and <category> tags to node for a given category
     */
    function add_category_tag(SimpleXMLElement $node, Category $category): void
    {
        $itunesNamespace = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

        $itunesCategory = $node->addChild('category', '', $itunesNamespace);
        $itunesCategory->addAttribute(
            'text',
            $category->parent !== null
                ? $category->parent->apple_category
                : $category->apple_category,
        );

        if ($category->parent !== null) {
            $itunesCategoryChild = $itunesCategory->addChild('category', '', $itunesNamespace);
            $itunesCategoryChild->addAttribute('text', $category->apple_category);
            $node->addChild('category', $category->parent->apple_category);
        }
        $node->addChild('category', $category->apple_category);
    }
}

if (! function_exists('rss_to_array')) {
    /**
     * Converts XML to array
     *
     * FIXME: param should be SimpleRSSElement
     *
     * @return array<string, mixed>
     */
    function rss_to_array(SimpleXMLElement $rssNode): array
    {
        $nameSpaces = [
            '',
            'http://www.itunes.com/dtds/podcast-1.0.dtd',
            'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md',
        ];
        $arrayNode = [];
        $arrayNode['name'] = $rssNode->getName();
        $arrayNode['namespace'] = $rssNode->getNamespaces(false);
        foreach ($rssNode->attributes() as $key => $value) {
            $arrayNode['attributes'][$key] = (string) $value;
        }
        $textcontent = trim((string) $rssNode);
        if (strlen($textcontent) > 0) {
            $arrayNode['content'] = $textcontent;
        }
        foreach ($nameSpaces as $currentNameSpace) {
            foreach ($rssNode->children($currentNameSpace) as $childXmlNode) {
                $arrayNode['elements'][] = rss_to_array($childXmlNode);
            }
        }

        return $arrayNode;
    }
}

if (! function_exists('array_to_rss')) {
    /**
     * Inserts array (converted to XML node) in XML node
     *
     * @param array<string, mixed> $arrayNode
     * @param SimpleRSSElement $xmlNode The XML parent node where this arrayNode should be attached
     */
    function array_to_rss(array $arrayNode, SimpleRSSElement &$xmlNode): SimpleRSSElement
    {
        if (array_key_exists('elements', $arrayNode)) {
            foreach ($arrayNode['elements'] as $childArrayNode) {
                $childXmlNode = $xmlNode->addChild(
                    $childArrayNode['name'],
                    $childArrayNode['content'] ?? null,
                    $childArrayNode['namespace'] === []
                        ? null
                        : current($childArrayNode['namespace'])
                );
                if (array_key_exists('attributes', $childArrayNode)) {
                    foreach (
                        $childArrayNode['attributes']
                        as $attributeKey => $attributeValue
                    ) {
                        $childXmlNode->addAttribute($attributeKey, $attributeValue);
                    }
                }
                array_to_rss($childArrayNode, $childXmlNode);
            }
        }

        return $xmlNode;
    }
}
