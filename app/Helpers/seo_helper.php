<?php

declare(strict_types=1);

use App\Entities\Actor;
use App\Entities\Episode;
use App\Entities\EpisodeComment;
use App\Entities\Page;
use App\Entities\Podcast;
use App\Entities\Post;
use Melbahja\Seo\MetaTags;
use Melbahja\Seo\Schema;
use Melbahja\Seo\Schema\Thing;

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (! function_exists('get_podcast_metatags')) {
    function get_podcast_metatags(Podcast $podcast, string $page): string
    {
        $schema = new Schema(
            new Thing('PodcastSeries', [
                'name' => $podcast->title,
                'url' => $podcast->link,
                'image' => $podcast->cover->feed_url,
                'description' => $podcast->description,
                'webFeed' => $podcast->feed_url,
                'author' => new Thing('Person', [
                    'name' => $podcast->publisher,
                ]),
            ])
        );

        $metatags = new MetaTags();

        $metatags
            ->title('  ' . $podcast->title . " (@{$podcast->handle})" . ' • ' . lang('Podcast.' . $page))
            ->description(htmlspecialchars($podcast->description))
            ->image((string) $podcast->cover->large_url)
            ->canonical((string) current_url())
            ->og('image:width', (string) config('Images')->podcastCoverSizes['large']['width'])
            ->og('image:height', (string) config('Images')->podcastCoverSizes['large']['height'])
            ->og('locale', $podcast->language_code)
            ->og('site_name', service('settings')->get('App.siteName'));

        if ($podcast->payment_pointer) {
            $metatags->meta('monetization', $podcast->payment_pointer);
        }

        return '<link type="application/rss+xml" rel="alternate" title="' . $podcast->title . '" href="' . $podcast->feed_url . '" />' . PHP_EOL . $metatags->__toString() . PHP_EOL . $schema->__toString();
    }
}

if (! function_exists('get_episode_metatags')) {
    function get_episode_metatags(Episode $episode): string
    {
        $schema = new Schema(
            new Thing('PodcastEpisode', [
                'url' => url_to('episode', $episode->podcast->handle, $episode->slug),
                'name' => $episode->title,
                'image' => $episode->cover->feed_url,
                'description' => $episode->description,
                'datePublished' => $episode->published_at->format(DATE_ISO8601),
                'timeRequired' => iso8601_duration($episode->audio->duration),
                'associatedMedia' => new Thing('MediaObject', [
                    'contentUrl' => $episode->audio->file_url,
                ]),
                'partOfSeries' => new Thing('PodcastSeries', [
                    'name' => $episode->podcast->title,
                    'url' => $episode->podcast->link,
                ]),
            ])
        );

        $metatags = new MetaTags();

        $metatags
            ->title($episode->title)
            ->description(htmlspecialchars($episode->description))
            ->image((string) $episode->cover->large_url, 'player')
            ->canonical($episode->link)
            ->og('site_name', service('settings')->get('App.siteName'))
            ->og('image:width', (string) config('Images')->podcastCoverSizes['large']['width'])
            ->og('image:height', (string) config('Images')->podcastCoverSizes['large']['height'])
            ->og('locale', $episode->podcast->language_code)
            ->og('audio', $episode->audio_file_opengraph_url)
            ->og('audio:type', $episode->audio->file_content_type)
            ->meta('article:published_time', $episode->published_at->format(DATE_ISO8601))
            ->meta('article:modified_time', $episode->updated_at->format(DATE_ISO8601))
            ->twitter('audio:partner', $episode->podcast->publisher ?? '')
            ->twitter('audio:artist_name', $episode->podcast->owner_name)
            ->twitter('player', $episode->getEmbedUrl('light'))
            ->twitter('player:width', (string) config('Embed')->width)
            ->twitter('player:height', (string) config('Embed')->height);

        if ($episode->podcast->payment_pointer) {
            $metatags->meta('monetization', $episode->podcast->payment_pointer);
        }

        return $metatags->__toString() . PHP_EOL . '<link rel="alternate" type="application/json+oembed" href="' . base_url(
            route_to('episode-oembed-json', $episode->podcast->handle, $episode->slug)
        ) . '" title="' . $episode->title . ' oEmbed json" />' . PHP_EOL . '<link rel="alternate" type="text/xml+oembed" href="' . base_url(
            route_to('episode-oembed-xml', $episode->podcast->handle, $episode->slug)
        ) . '" title="' . $episode->title . ' oEmbed xml" />' . PHP_EOL . $schema->__toString();
    }
}

if (! function_exists('get_post_metatags')) {
    function get_post_metatags(Post $post): string
    {
        $socialMediaPosting = new Thing('SocialMediaPosting', [
            '@id' => url_to('post', $post->actor->username, $post->id),
            'datePublished' => $post->published_at->format(DATE_ISO8601),
            'author' => new Thing('Person', [
                'name' => $post->actor->display_name,
                'url' => $post->actor->uri,
            ]),
            'text' => $post->message,
        ]);

        if ($post->episode_id !== null) {
            $socialMediaPosting->__set('sharedContent', new Thing('Audio', [
                'headline' => $post->episode->title,
                'url' => $post->episode->link,
                'author' => new Thing('Person', [
                    'name' => $post->episode->podcast->owner_name,
                ]),
            ]));
        } elseif ($post->preview_card !== null) {
            $socialMediaPosting->__set('sharedContent', new Thing('WebPage', [
                'headline' => $post->preview_card->title,
                'url' => $post->preview_card->url,
                'author' => new Thing('Person', [
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
            ->og('site_name', service('settings')->get('App.siteName'));

        return $metatags->__toString() . PHP_EOL . $schema->__toString();
    }
}

if (! function_exists('get_episode_comment_metatags')) {
    function get_episode_comment_metatags(EpisodeComment $episodeComment): string
    {
        $schema = new Schema(new Thing('SocialMediaPosting', [
            '@id' => url_to(
                'episode-comment',
                $episodeComment->actor->username,
                $episodeComment->episode->slug,
                $episodeComment->id
            ),
            'datePublished' => $episodeComment->created_at->format(DATE_ISO8601),
            'author' => new Thing('Person', [
                'name' => $episodeComment->actor->display_name,
                'url' => $episodeComment->actor->uri,
            ]),
            'text' => $episodeComment->message,
            'upvoteCount' => $episodeComment->likes_count,
        ]));

        $metatags = new MetaTags();
        $metatags
            ->title(lang('Comment.title', [
                'actorDisplayName' => $episodeComment->actor->display_name,
                'episodeTitle' => $episodeComment->episode->title,
            ]))
            ->description($episodeComment->message)
            ->image($episodeComment->actor->avatar_image_url)
            ->canonical((string) current_url())
            ->og('site_name', service('settings')->get('App.siteName'));

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
            ->og('site_name', service('settings')->get('App.siteName'));

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
            ->og('site_name', service('settings')->get('App.siteName'));

        return $metatags->__toString();
    }
}

if (! function_exists('get_home_metatags')) {
    function get_home_metatags(): string
    {
        $metatags = new MetaTags();
        $metatags
            ->title(service('settings')->get('App.siteName'))
            ->description(service('settings')->get('App.siteDescription'))
            ->image(service('settings')->get('App.siteIcon')['512'])
            ->canonical((string) current_url())
            ->og('site_name', service('settings')->get('App.siteName'));

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
            ->description(service('settings')->get('App.siteDescription'))
            ->image(service('settings')->get('App.siteIcon')['512'])
            ->canonical((string) current_url())
            ->og('site_name', service('settings')->get('App.siteName'));

        return $metatags->__toString();
    }
}

if (! function_exists('iso8601_duration')) {
    // From https://stackoverflow.com/a/40761380
    function iso8601_duration(float $seconds): string
    {
        $days = floor($seconds / 86400);
        $seconds %= 86400;

        $hours = floor($seconds / 3600);
        $seconds %= 3600;

        $minutes = floor($seconds / 60);
        $seconds %= 60;

        return sprintf('P%dDT%dH%dM%dS', $days, $hours, $minutes, $seconds);
    }
}
