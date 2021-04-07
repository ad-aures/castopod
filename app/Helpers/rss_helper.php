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
function get_rss_feed($podcast, $serviceSlug = '')
{
    $episodes = $podcast->episodes;

    $itunes_namespace = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

    $podcast_namespace =
        'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md';

    $rss = new SimpleRSSElement(
        "<?xml version='1.0' encoding='utf-8'?><rss version='2.0' xmlns:itunes='$itunes_namespace' xmlns:podcast='$podcast_namespace' xmlns:content='http://purl.org/rss/1.0/modules/content/'></rss>",
    );

    $channel = $rss->addChild('channel');

    $atom_link = $channel->addChild(
        'atom:link',
        null,
        'http://www.w3.org/2005/Atom',
    );
    $atom_link->addAttribute('href', $podcast->feed_url);
    $atom_link->addAttribute('rel', 'self');
    $atom_link->addAttribute('type', 'application/rss+xml');

    if (!empty($podcast->new_feed_url)) {
        $channel->addChild(
            'new-feed-url',
            $podcast->new_feed_url,
            $itunes_namespace,
        );
    }

    // the last build date corresponds to the creation of the feed.xml cache
    $channel->addChild(
        'lastBuildDate',
        (new Time('now'))->format(DATE_RFC1123),
    );
    $channel->addChild(
        'generator',
        'Castopod 0.0.0-development - https://castopod.org/',
    );
    $channel->addChild('docs', 'https://cyber.harvard.edu/rss/rss.html');

    $channel->addChild('title', $podcast->title);
    $channel->addChildWithCDATA('description', $podcast->description_html);
    $itunes_image = $channel->addChild('image', null, $itunes_namespace);
    $itunes_image->addAttribute('href', $podcast->image->original_url);
    $channel->addChild('language', $podcast->language_code);
    if (!empty($podcast->location_name)) {
        $locationElement = $channel->addChild(
            'location',
            htmlspecialchars($podcast->location_name),
            $podcast_namespace,
        );
        if (!empty($podcast->location_geo)) {
            $locationElement->addAttribute('geo', $podcast->location_geo);
        }
        if (!empty($podcast->location_osmid)) {
            $locationElement->addAttribute('osm', $podcast->location_osmid);
        }
    }
    if (!empty($podcast->payment_pointer)) {
        $valueElement = $channel->addChild('value', null, $podcast_namespace);
        $valueElement->addAttribute('type', 'webmonetization');
        $valueElement->addAttribute('method', '');
        $valueElement->addAttribute('suggested', '');
        $recipientElement = $valueElement->addChild(
            'valueRecipient',
            null,
            $podcast_namespace,
        );
        $recipientElement->addAttribute('name', $podcast->owner_name);
        $recipientElement->addAttribute('type', 'ILP');
        $recipientElement->addAttribute('address', $podcast->payment_pointer);
        $recipientElement->addAttribute('split', 100);
    }
    $channel
        ->addChild(
            'locked',
            $podcast->is_locked ? 'yes' : 'no',
            $podcast_namespace,
        )
        ->addAttribute('owner', $podcast->owner_email);
    if (!empty($podcast->imported_feed_url)) {
        $channel->addChild(
            'previousUrl',
            $podcast->imported_feed_url,
            $podcast_namespace,
        );
    }

    foreach ($podcast->podcastingPlatforms as $podcastingPlatform) {
        $podcastingPlatformElement = $channel->addChild(
            'id',
            null,
            $podcast_namespace,
        );
        $podcastingPlatformElement->addAttribute(
            'platform',
            $podcastingPlatform->slug,
        );
        if (!empty($podcastingPlatform->link_content)) {
            $podcastingPlatformElement->addAttribute(
                'id',
                $podcastingPlatform->link_content,
            );
        }
        if (!empty($podcastingPlatform->link_url)) {
            $podcastingPlatformElement->addAttribute(
                'url',
                htmlspecialchars($podcastingPlatform->link_url),
            );
        }
    }

    foreach ($podcast->socialPlatforms as $socialPlatform) {
        $socialPlatformElement = $channel->addChild(
            'social',
            $socialPlatform->link_content,
            $podcast_namespace,
        );
        $socialPlatformElement->addAttribute('platform', $socialPlatform->slug);
        if (!empty($socialPlatform->link_url)) {
            $socialPlatformElement->addAttribute(
                'url',
                htmlspecialchars($socialPlatform->link_url),
            );
        }
    }

    foreach ($podcast->fundingPlatforms as $fundingPlatform) {
        $fundingPlatformElement = $channel->addChild(
            'funding',
            $fundingPlatform->link_content,
            $podcast_namespace,
        );
        $fundingPlatformElement->addAttribute(
            'platform',
            $fundingPlatform->slug,
        );
        if (!empty($socialPlatform->link_url)) {
            $fundingPlatformElement->addAttribute(
                'url',
                htmlspecialchars($fundingPlatform->link_url),
            );
        }
    }

    foreach ($podcast->persons as $podcastPerson) {
        $podcastPersonElement = $channel->addChild(
            'person',
            htmlspecialchars($podcastPerson->person->full_name),
            $podcast_namespace,
        );
        if (
            !empty($podcastPerson->person_role) &&
            !empty($podcastPerson->person_group)
        ) {
            $podcastPersonElement->addAttribute(
                'role',
                htmlspecialchars(
                    lang(
                        "PersonsTaxonomy.persons.{$podcastPerson->person_group}.roles.{$podcastPerson->person_role}.label",
                        [],
                        'en',
                    ),
                ),
            );
        }
        if (!empty($podcastPerson->person_group)) {
            $podcastPersonElement->addAttribute(
                'group',
                htmlspecialchars(
                    lang(
                        "PersonsTaxonomy.persons.{$podcastPerson->person_group}.label",
                        [],
                        'en',
                    ),
                ),
            );
        }
        $podcastPersonElement->addAttribute(
            'img',
            $podcastPerson->person->image->large_url,
        );
        if (!empty($podcastPerson->person->information_url)) {
            $podcastPersonElement->addAttribute(
                'href',
                $podcastPerson->person->information_url,
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
        $itunes_namespace,
    );

    $channel->addChild(
        'author',
        $podcast->publisher ? $podcast->publisher : $podcast->owner_name,
        $itunes_namespace,
    );
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

    if (!empty($podcast->custom_rss)) {
        array_to_rss(
            [
                'elements' => $podcast->custom_rss,
            ],
            $channel,
        );
    }

    foreach ($episodes as $episode) {
        $item = $channel->addChild('item');
        $item->addChild('title', $episode->title);
        $enclosure = $item->addChild('enclosure');

        $enclosure->addAttribute(
            'url',
            $episode->enclosure_url .
                (empty($serviceSlug)
                    ? ''
                    : '?_from=' . urlencode($serviceSlug)),
        );
        $enclosure->addAttribute('length', $episode->enclosure_filesize);
        $enclosure->addAttribute('type', $episode->enclosure_mimetype);

        $item->addChild('guid', $episode->guid);
        $item->addChild(
            'pubDate',
            $episode->published_at->format(DATE_RFC1123),
        );
        if (!empty($episode->location_name)) {
            $locationElement = $item->addChild(
                'location',
                htmlspecialchars($episode->location_name),
                $podcast_namespace,
            );
            if (!empty($episode->location_geo)) {
                $locationElement->addAttribute('geo', $episode->location_geo);
            }
            if (!empty($episode->location_osmid)) {
                $locationElement->addAttribute('osm', $episode->location_osmid);
            }
        }
        $item->addChildWithCDATA(
            'description',
            $episode->getDescriptionHtml($serviceSlug),
        );
        $item->addChild(
            'duration',
            $episode->enclosure_duration,
            $itunes_namespace,
        );
        $item->addChild('link', $episode->link);
        $episode_itunes_image = $item->addChild(
            'image',
            null,
            $itunes_namespace,
        );
        $episode_itunes_image->addAttribute('href', $episode->image->feed_url);

        $episode->parental_advisory &&
            $item->addChild(
                'explicit',
                $episode->parental_advisory === 'explicit' ? 'true' : 'false',
                $itunes_namespace,
            );

        $episode->number &&
            $item->addChild('episode', $episode->number, $itunes_namespace);
        $episode->season_number &&
            $item->addChild(
                'season',
                $episode->season_number,
                $itunes_namespace,
            );
        $item->addChild('episodeType', $episode->type, $itunes_namespace);

        if ($episode->transcript) {
            $transcriptElement = $item->addChild(
                'transcript',
                null,
                $podcast_namespace,
            );
            $transcriptElement->addAttribute('url', $episode->transcriptUrl);
            $transcriptElement->addAttribute(
                'type',
                Mimes::guessTypeFromExtension(
                    pathinfo($episode->transcript_uri, PATHINFO_EXTENSION),
                ),
            );
            $transcriptElement->addAttribute(
                'language',
                $podcast->language_code,
            );
        }

        if ($episode->chapters) {
            $chaptersElement = $item->addChild(
                'chapters',
                null,
                $podcast_namespace,
            );
            $chaptersElement->addAttribute('url', $episode->chaptersUrl);
            $chaptersElement->addAttribute('type', 'application/json+chapters');
        }

        foreach ($episode->soundbites as $soundbite) {
            $soundbiteElement = $item->addChild(
                'soundbite',
                empty($soundbite->label) ? null : $soundbite->label,
                $podcast_namespace,
            );
            $soundbiteElement->addAttribute(
                'start_time',
                $soundbite->start_time,
            );
            $soundbiteElement->addAttribute('duration', $soundbite->duration);
        }

        foreach ($episode->persons as $episodePerson) {
            $episodePersonElement = $item->addChild(
                'person',
                htmlspecialchars($episodePerson->person->full_name),
                $podcast_namespace,
            );
            if (
                !empty($episodePerson->person_role) &&
                !empty($episodePerson->person_group)
            ) {
                $episodePersonElement->addAttribute(
                    'role',
                    htmlspecialchars(
                        lang(
                            "PersonsTaxonomy.persons.{$episodePerson->person_group}.roles.{$episodePerson->person_role}.label",
                            [],
                            'en',
                        ),
                    ),
                );
            }
            if (!empty($episodePerson->person_group)) {
                $episodePersonElement->addAttribute(
                    'group',
                    htmlspecialchars(
                        lang(
                            "PersonsTaxonomy.persons.{$episodePerson->person_group}.label",
                            [],
                            'en',
                        ),
                    ),
                );
            }
            $episodePersonElement->addAttribute(
                'img',
                $episodePerson->person->image->large_url,
            );
            if (!empty($episodePerson->person->information_url)) {
                $episodePersonElement->addAttribute(
                    'href',
                    $episodePerson->person->information_url,
                );
            }
        }

        $episode->is_blocked &&
            $item->addChild('block', 'Yes', $itunes_namespace);

        if (!empty($episode->custom_rss)) {
            array_to_rss(
                [
                    'elements' => $episode->custom_rss,
                ],
                $item,
            );
        }
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
            : $category->apple_category,
    );

    if ($category->parent) {
        $itunes_category_child = $itunes_category->addChild(
            'category',
            null,
            $itunes_namespace,
        );
        $itunes_category_child->addAttribute('text', $category->apple_category);
        $node->addChild('category', $category->parent->apple_category);
    }
    $node->addChild('category', $category->apple_category);
}

/**
 * Converts XML to array
 *
 * @param \SimpleRSSElement $xmlNode
 *
 * @return array
 */
function rss_to_array($xmlNode)
{
    $nameSpaces = [
        '',
        'http://www.itunes.com/dtds/podcast-1.0.dtd',
        'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md',
    ];
    $arrayNode = [];
    $arrayNode['name'] = $xmlNode->getName();
    $arrayNode['namespace'] = $xmlNode->getNamespaces(false);
    if (count($xmlNode->attributes()) > 0) {
        foreach ($xmlNode->attributes() as $key => $value) {
            $arrayNode['attributes'][$key] = (string) $value;
        }
    }
    $textcontent = trim((string) $xmlNode);
    if (strlen($textcontent) > 0) {
        $arrayNode['content'] = $textcontent;
    }
    foreach ($nameSpaces as $currentNameSpace) {
        foreach ($xmlNode->children($currentNameSpace) as $childXmlNode) {
            $arrayNode['elements'][] = rss_to_array($childXmlNode);
        }
    }
    return $arrayNode;
}

/**
 * Inserts array (converted to XML node) in XML node
 *
 * @param array $arrayNode
 * @param \SimpleRSSElement $xmlNode The XML parent node where this arrayNode should be attached
 *
 */
function array_to_rss($arrayNode, &$xmlNode)
{
    if (array_key_exists('elements', $arrayNode)) {
        foreach ($arrayNode['elements'] as $childArrayNode) {
            $childXmlNode = $xmlNode->addChild(
                $childArrayNode['name'],
                array_key_exists('content', $childArrayNode)
                    ? $childArrayNode['content']
                    : null,
                empty($childArrayNode['namespace'])
                    ? null
                    : current($childArrayNode['namespace']),
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
