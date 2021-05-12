<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use App\Libraries\SimpleRSSElement;
use CodeIgniter\I18n\Time;
use Config\Mimes;
use App\Entities\Podcast;
use App\Entities\Category;

if (!function_exists('get_rss_feed')) {
    /**
     * Generates the rss feed for a given podcast entity
     *
     * @param string $serviceSlug The name of the service that fetches the RSS feed for future reference when the audio file is eventually downloaded
     * @return string rss feed as xml
     */
    function get_rss_feed(Podcast $podcast, ?string $serviceSlug = null): string
    {
        $episodes = $podcast->episodes;

        $itunes_namespace = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

        $podcast_namespace =
            'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md';

        $rss = new SimpleRSSElement(
            "<?xml version='1.0' encoding='utf-8'?><rss version='2.0' xmlns:itunes='{$itunes_namespace}' xmlns:podcast='{$podcast_namespace}' xmlns:content='http://purl.org/rss/1.0/modules/content/'></rss>",
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

        if ($podcast->new_feed_url !== null) {
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
            'Castopod Host - https://castopod.org/',
        );
        $channel->addChild('docs', 'https://cyber.harvard.edu/rss/rss.html');

        $channel->addChild('title', $podcast->title);
        $channel->addChildWithCDATA('description', $podcast->description_html);

        $itunes_image = $channel->addChild('image', null, $itunes_namespace);

        // FIXME: This should be downsized to 1400x1400
        $itunes_image->addAttribute('href', $podcast->image->url);

        $channel->addChild('language', $podcast->language_code);
        if ($podcast->location !== null) {
            $locationElement = $channel->addChild(
                'location',
                htmlspecialchars($podcast->location->name),
                $podcast_namespace,
            );
            if ($podcast->location->geo !== null) {
                $locationElement->addAttribute('geo', $podcast->location->geo);
            }
            if ($podcast->location->osm_id !== null) {
                $locationElement->addAttribute(
                    'osm',
                    $podcast->location->osm_id,
                );
            }
        }
        if ($podcast->payment_pointer !== null) {
            $valueElement = $channel->addChild(
                'value',
                null,
                $podcast_namespace,
            );
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
            $recipientElement->addAttribute(
                'address',
                $podcast->payment_pointer,
            );
            $recipientElement->addAttribute('split', '100');
        }
        $channel
            ->addChild(
                'locked',
                $podcast->is_locked ? 'yes' : 'no',
                $podcast_namespace,
            )
            ->addAttribute('owner', $podcast->owner_email);
        if ($podcast->imported_feed_url !== null) {
            $channel->addChild(
                'previousUrl',
                $podcast->imported_feed_url,
                $podcast_namespace,
            );
        }

        foreach ($podcast->podcasting_platforms as $podcastingPlatform) {
            $podcastingPlatformElement = $channel->addChild(
                'id',
                null,
                $podcast_namespace,
            );
            $podcastingPlatformElement->addAttribute(
                'platform',
                $podcastingPlatform->slug,
            );
            if ($podcastingPlatform->link_content !== null) {
                $podcastingPlatformElement->addAttribute(
                    'id',
                    $podcastingPlatform->link_content,
                );
            }
            if ($podcastingPlatform->link_url !== null) {
                $podcastingPlatformElement->addAttribute(
                    'url',
                    htmlspecialchars($podcastingPlatform->link_url),
                );
            }
        }

        foreach ($podcast->social_platforms as $socialPlatform) {
            $socialPlatformElement = $channel->addChild(
                'social',
                $socialPlatform->link_content,
                $podcast_namespace,
            );
            $socialPlatformElement->addAttribute(
                'platform',
                $socialPlatform->slug,
            );
            if ($socialPlatform->link_url !== null) {
                $socialPlatformElement->addAttribute(
                    'url',
                    htmlspecialchars($socialPlatform->link_url),
                );
            }
        }

        foreach ($podcast->funding_platforms as $fundingPlatform) {
            $fundingPlatformElement = $channel->addChild(
                'funding',
                $fundingPlatform->link_content,
                $podcast_namespace,
            );
            $fundingPlatformElement->addAttribute(
                'platform',
                $fundingPlatform->slug,
            );
            if ($fundingPlatform->link_url !== null) {
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
                $podcastPerson->person_role !== null &&
                $podcastPerson->person_group !== null
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

            if ($podcastPerson->person_group !== null) {
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

            if ($podcastPerson->person->information_url !== null) {
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
        $podcast->copyright &&
            $channel->addChild('copyright', $podcast->copyright);
        $podcast->is_blocked &&
            $channel->addChild('block', 'Yes', $itunes_namespace);
        $podcast->is_completed &&
            $channel->addChild('complete', 'Yes', $itunes_namespace);

        $image = $channel->addChild('image');
        $image->addChild('url', $podcast->image->feed_url);
        $image->addChild('title', $podcast->title);
        $image->addChild('link', $podcast->link);

        if ($podcast->custom_rss !== null) {
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
                $episode->audio_file_analytics_url .
                    ($serviceSlug === ''
                        ? ''
                        : '?_from=' . urlencode($serviceSlug)),
            );
            $enclosure->addAttribute('length', $episode->audio_file_size);
            $enclosure->addAttribute('type', $episode->audio_file_mimetype);

            $item->addChild('guid', $episode->guid);
            $item->addChild(
                'pubDate',
                $episode->published_at->format(DATE_RFC1123),
            );
            if ($episode->location !== null) {
                $locationElement = $item->addChild(
                    'location',
                    htmlspecialchars($episode->location->name),
                    $podcast_namespace,
                );
                if ($episode->location->geo !== null) {
                    $locationElement->addAttribute(
                        'geo',
                        $episode->location->geo,
                    );
                }
                if ($episode->location->osm_id !== null) {
                    $locationElement->addAttribute(
                        'osm',
                        $episode->location->osm_id,
                    );
                }
            }
            $item->addChildWithCDATA(
                'description',
                $episode->getDescriptionHtml($serviceSlug),
            );
            $item->addChild(
                'duration',
                $episode->audio_file_duration,
                $itunes_namespace,
            );
            $item->addChild('link', $episode->link);
            $episode_itunes_image = $item->addChild(
                'image',
                null,
                $itunes_namespace,
            );
            $episode_itunes_image->addAttribute(
                'href',
                $episode->image->feed_url,
            );

            $episode->parental_advisory &&
                $item->addChild(
                    'explicit',
                    $episode->parental_advisory === 'explicit'
                        ? 'true'
                        : 'false',
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

            if ($episode->transcript_file_url) {
                $transcriptElement = $item->addChild(
                    'transcript',
                    null,
                    $podcast_namespace,
                );
                $transcriptElement->addAttribute(
                    'url',
                    $episode->transcript_file_url,
                );
                $transcriptElement->addAttribute(
                    'type',
                    Mimes::guessTypeFromExtension(
                        pathinfo(
                            $episode->transcript_file_url,
                            PATHINFO_EXTENSION,
                        ),
                    ),
                );
                $transcriptElement->addAttribute(
                    'language',
                    $podcast->language_code,
                );
            }

            if ($episode->chapters_file_url) {
                $chaptersElement = $item->addChild(
                    'chapters',
                    null,
                    $podcast_namespace,
                );
                $chaptersElement->addAttribute(
                    'url',
                    $episode->chapters_file_url,
                );
                $chaptersElement->addAttribute(
                    'type',
                    'application/json+chapters',
                );
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
                $soundbiteElement->addAttribute(
                    'duration',
                    $soundbite->duration,
                );
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
}

if (!function_exists('add_category_tag')) {
    /**
     * Adds <itunes:category> and <category> tags to node for a given category
     */
    function add_category_tag(SimpleXMLElement $node, Category $category): void
    {
        $itunes_namespace = 'http://www.itunes.com/dtds/podcast-1.0.dtd';

        $itunes_category = $node->addChild('category', '', $itunes_namespace);
        $itunes_category->addAttribute(
            'text',
            $category->parent !== null
                ? $category->parent->apple_category
                : $category->apple_category,
        );

        if ($category->parent !== null) {
            $itunes_category_child = $itunes_category->addChild(
                'category',
                '',
                $itunes_namespace,
            );
            $itunes_category_child->addAttribute(
                'text',
                $category->apple_category,
            );
            $node->addChild('category', $category->parent->apple_category);
        }
        $node->addChild('category', $category->apple_category);
    }
}

if (!function_exists('rss_to_array')) {
    /**
     * Converts XML to array
     *
     * FIXME: should be SimpleRSSElement
     * @param SimpleXMLElement $xmlNode
     */
    function rss_to_array(SimpleXMLElement $xmlNode): array
    {
        $nameSpaces = [
            '',
            'http://www.itunes.com/dtds/podcast-1.0.dtd',
            'https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md',
        ];
        $arrayNode = [];
        $arrayNode['name'] = $xmlNode->getName();
        $arrayNode['namespace'] = $xmlNode->getNamespaces(false);
        foreach ($xmlNode->attributes() as $key => $value) {
            $arrayNode['attributes'][$key] = (string) $value;
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
}

if (!function_exists('array_to_rss')) {
    /**
     * Inserts array (converted to XML node) in XML node
     *
     * @param SimpleRSSElement $xmlNode The XML parent node where this arrayNode should be attached
     */
    function array_to_rss(array $arrayNode, SimpleRSSElement &$xmlNode)
    {
        if (array_key_exists('elements', $arrayNode)) {
            foreach ($arrayNode['elements'] as $childArrayNode) {
                $childXmlNode = $xmlNode->addChild(
                    $childArrayNode['name'],
                    $childArrayNode['content'] ?? null,
                    empty($childArrayNode['namespace'])
                        ? null
                        : current($childArrayNode['namespace']),
                );
                if (array_key_exists('attributes', $childArrayNode)) {
                    foreach (
                        $childArrayNode['attributes']
                        as $attributeKey => $attributeValue
                    ) {
                        $childXmlNode->addAttribute(
                            $attributeKey,
                            $attributeValue,
                        );
                    }
                }
                array_to_rss($childArrayNode, $childXmlNode);
            }
        }

        return $xmlNode;
    }
}
