<?php

declare(strict_types=1);

use App\Entities\Actor;

use App\Entities\Episode;
use App\Entities\EpisodeComment;
use App\Entities\Page;
use App\Entities\Podcast;
use App\Entities\Post;
use Config\Embed;
use Config\Images;
use Melbahja\Seo\MetaTags;
use Melbahja\Seo\Schema;
use Melbahja\Seo\Schema\Thing;
use Modules\Fediverse\Entities\PreviewCard;

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (! function_exists('get_podcast_metatags')) {
    function get_podcast_metatags(Podcast $podcast, string $page): string
    {
        $category = '';
        if ($podcast->category->parent_id !== null) {
            $category .= $podcast->category->parent->apple_category . ' › ';
        }

        $category .= $podcast->category->apple_category;

        $schema = new Schema(
            new Thing('PodcastSeries', [
                'name'        => $podcast->title,
                'headline'    => $podcast->title,
                'url'         => current_url(),
                'sameAs'      => $podcast->link,
                'identifier'  => $podcast->guid,
                'image'       => $podcast->cover->feed_url,
                'description' => $podcast->description,
                'webFeed'     => $podcast->feed_url,
                'accessMode'  => 'auditory',
                'author'      => $podcast->owner_name,
                'creator'     => $podcast->owner_name,
                'publisher'   => $podcast->publisher,
                'inLanguage'  => $podcast->language_code,
                'genre'       => $category,
            ])
        );

        $metatags = new MetaTags();

        $metatags
            ->title($podcast->title . ' (@' . $podcast->handle . ') • ' . lang('Podcast.' . $page))
            ->description(esc($podcast->description))
            ->image((string) $podcast->cover->og_url)
            ->canonical((string) current_url())
            ->og('image:width', (string) config(Images::class)->podcastCoverSizes['og']['width'])
            ->og('image:height', (string) config(Images::class)->podcastCoverSizes['og']['height'])
            ->og('locale', $podcast->language_code)
            ->og('site_name', esc(service('settings')->get('App.siteName')))
            ->push('link', [
                'rel'  => 'alternate',
                'type' => 'application/activity+json',
                'href' => url_to('podcast-activity', esc($podcast->handle)),
            ]);

        if ($podcast->payment_pointer) {
            $metatags->meta('monetization', $podcast->payment_pointer);
        }

        return '<link type="application/rss+xml" rel="alternate" title="' . esc(
            $podcast->title
        ) . '" href="' . $podcast->feed_url . '" />' . PHP_EOL . $metatags->__toString() . PHP_EOL . $schema->__toString();
    }
}

if (! function_exists('get_episode_metatags')) {
    function get_episode_metatags(Episode $episode): string
    {
        $schema = new Schema(
            new Thing('PodcastEpisode', [
                'url'             => url_to('episode', esc($episode->podcast->handle), $episode->slug),
                'name'            => $episode->title,
                'image'           => $episode->cover->feed_url,
                'description'     => $episode->description,
                'datePublished'   => $episode->published_at->format(DATE_ISO8601),
                'timeRequired'    => iso8601_duration($episode->audio->duration),
                'duration'        => iso8601_duration($episode->audio->duration),
                'associatedMedia' => new Thing('MediaObject', [
                    'contentUrl' => $episode->audio_url,
                ]),
                'partOfSeries' => new Thing('PodcastSeries', [
                    'name' => $episode->podcast->title,
                    'url'  => $episode->podcast->link,
                ]),
            ])
        );

        $metatags = new MetaTags();

        $metatags
            ->title($episode->title)
            ->description(esc($episode->description))
            ->image((string) $episode->cover->og_url, 'player')
            ->canonical($episode->link)
            ->og('site_name', esc(service('settings')->get('App.siteName')))
            ->og('image:width', (string) config(Images::class)->podcastCoverSizes['og']['width'])
            ->og('image:height', (string) config(Images::class)->podcastCoverSizes['og']['height'])
            ->og('locale', $episode->podcast->language_code)
            ->og('audio', $episode->audio_opengraph_url)
            ->og('audio:type', $episode->audio->file_mimetype)
            ->meta('article:published_time', $episode->published_at->format(DATE_ISO8601))
            ->meta('article:modified_time', $episode->updated_at->format(DATE_ISO8601))
            ->twitter('audio:partner', $episode->podcast->publisher ?? '')
            ->twitter('audio:artist_name', esc($episode->podcast->owner_name))
            ->twitter('player', $episode->getEmbedUrl('light'))
            ->twitter('player:width', (string) config(Embed::class)->width)
            ->twitter('player:height', (string) config(Embed::class)->height)
            ->push('link', [
                'rel'  => 'alternate',
                'type' => 'application/activity+json',
                'href' => url_to('episode', $episode->podcast->handle, $episode->slug),
            ]);

        if ($episode->podcast->payment_pointer) {
            $metatags->meta('monetization', $episode->podcast->payment_pointer);
        }

        return $metatags->__toString() . PHP_EOL . '<link rel="alternate" type="application/json+oembed" href="' . base_url(
            route_to('episode-oembed-json', $episode->podcast->handle, $episode->slug)
        ) . '" title="' . esc(
            $episode->title
        ) . ' oEmbed json" />' . PHP_EOL . '<link rel="alternate" type="text/xml+oembed" href="' . base_url(
            route_to('episode-oembed-xml', $episode->podcast->handle, $episode->slug)
        ) . '" title="' . esc($episode->title) . ' oEmbed xml" />' . PHP_EOL . $schema->__toString();
    }
}

if (! function_exists('get_post_metatags')) {
    function get_post_metatags(Post $post): string
    {
        $socialMediaPosting = new Thing('SocialMediaPosting', [
            '@id'           => url_to('post', esc($post->actor->username), $post->id),
            'datePublished' => $post->published_at->format(DATE_ISO8601),
            'author'        => new Thing('Person', [
                'name' => $post->actor->display_name,
                'url'  => $post->actor->uri,
            ]),
            'text' => $post->message,
        ]);

        if ($post->episode_id !== null) {
            $socialMediaPosting->__set('sharedContent', new Thing('Audio', [
                'headline' => $post->episode->title,
                'url'      => $post->episode->link,
                'author'   => new Thing('Person', [
                    'name' => $post->episode->podcast->owner_name,
                ]),
            ]));
        } elseif ($post->preview_card instanceof PreviewCard) {
            $socialMediaPosting->__set('sharedContent', new Thing('WebPage', [
                'headline' => $post->preview_card->title,
                'url'      => $post->preview_card->url,
                'author'   => new Thing('Person', [
                    'name' => $post->preview_card->author_name,
                ]),
            ]));
        }

        $schema = new Schema($socialMediaPosting);

        $metatags = new MetaTags();
        $metatags
            ->title(lang('Post.title', [
                'actorDisplayName' => $post->actor->display_name,
            ]))
            ->description($post->message)
            ->image($post->actor->avatar_image_url)
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')))
            ->push('link', [
                'rel'  => 'alternate',
                'type' => 'application/activity+json',
                'href' => url_to('post', esc($post->actor->username), $post->id),
            ]);

        return $metatags->__toString() . PHP_EOL . $schema->__toString();
    }
}

if (! function_exists('get_episode_comment_metatags')) {
    function get_episode_comment_metatags(EpisodeComment $episodeComment): string
    {
        $schema = new Schema(new Thing('SocialMediaPosting', [
            '@id' => url_to(
                'episode-comment',
                esc($episodeComment->actor->username),
                $episodeComment->episode->slug,
                $episodeComment->id
            ),
            'datePublished' => $episodeComment->created_at->format(DATE_ISO8601),
            'author'        => new Thing('Person', [
                'name' => $episodeComment->actor->display_name,
                'url'  => $episodeComment->actor->uri,
            ]),
            'text'        => $episodeComment->message,
            'upvoteCount' => $episodeComment->likes_count,
        ]));

        $metatags = new MetaTags();
        $metatags
            ->title(lang('Comment.title', [
                'actorDisplayName' => $episodeComment->actor->display_name,
                'episodeTitle'     => $episodeComment->episode->title,
            ]))
            ->description($episodeComment->message)
            ->image($episodeComment->actor->avatar_image_url)
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')))
            ->push('link', [
                'rel'  => 'alternate',
                'type' => 'application/activity+json',
                'href' => url_to(
                    'episode-comment',
                    $episodeComment->actor->username,
                    $episodeComment->episode->slug,
                    $episodeComment->id
                ),
            ]);

        return $metatags->__toString() . PHP_EOL . $schema->__toString();
    }
}

if (! function_exists('get_follow_metatags')) {
    function get_follow_metatags(Actor $actor): string
    {
        $metatags = new MetaTags();
        $metatags
            ->title(lang('Podcast.followTitle', [
                'actorDisplayName' => $actor->display_name,
            ]))
            ->description($actor->summary)
            ->image($actor->avatar_image_url)
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')));

        return $metatags->__toString();
    }
}

if (! function_exists('get_remote_actions_metatags')) {
    function get_remote_actions_metatags(Post $post, string $action): string
    {
        $metatags = new MetaTags();
        $metatags
            ->title(lang('Fediverse.' . $action . '.title', [
                'actorDisplayName' => $post->actor->display_name,
            ],))
            ->description($post->message)
            ->image($post->actor->avatar_image_url)
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')));

        return $metatags->__toString();
    }
}

if (! function_exists('get_home_metatags')) {
    function get_home_metatags(): string
    {
        $metatags = new MetaTags();
        $metatags
            ->title(service('settings')->get('App.siteName'))
            ->description(esc(service('settings')->get('App.siteDescription')))
            ->image(get_site_icon_url('512'))
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')));

        return $metatags->__toString();
    }
}

if (! function_exists('get_page_metatags')) {
    function get_page_metatags(Page $page): string
    {
        $metatags = new MetaTags();
        $metatags
            ->title(
                $page->title . service('settings')->get('App.siteTitleSeparator') . service(
                    'settings'
                )->get('App.siteName')
            )
            ->description(esc(service('settings')->get('App.siteDescription')))
            ->image(get_site_icon_url('512'))
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')));

        return $metatags->__toString();
    }
}

if (! function_exists('iso8601_duration')) {
    // From https://stackoverflow.com/a/40761380
    function iso8601_duration(float $seconds): string
    {
        $days = floor($seconds / 86400);
        $seconds = (int) $seconds % 86400;

        $hours = floor($seconds / 3600);
        $seconds %= 3600;

        $minutes = floor($seconds / 60);
        $seconds %= 60;

        return sprintf('P%dDT%dH%dM%dS', $days, $hours, $minutes, $seconds);
    }
}
