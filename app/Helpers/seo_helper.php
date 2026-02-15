<?php

declare(strict_types=1);

use App\Entities\Actor;
use App\Entities\Episode;
use App\Entities\EpisodeComment;
use App\Entities\Page;
use App\Entities\Podcast;
use App\Entities\Post;
use App\Libraries\HtmlHead;
use Melbahja\Seo\Schema;
use Melbahja\Seo\Schema\Thing;
use Modules\Fediverse\Entities\PreviewCard;

/**
 * @copyright  2024 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

if (! function_exists('set_podcast_metatags')) {
    function set_podcast_metatags(Podcast $podcast, string $page): void
    {
        $category = '';
        if ($podcast->category->parent_id !== null) {
            $category .= $podcast->category->parent->apple_category . ' › ';
        }

        $category .= $podcast->category->apple_category;

        $schema = new Schema(
            new Thing(
                props: [
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
                ],
                type: 'PodcastSeries',
            ),
        );

        /** @var HtmlHead $head */
        $head = service('html_head');

        $head
            ->title(sprintf('%s (@%s) • %s', $podcast->title, $podcast->handle, lang('Podcast.' . $page)))
            ->description(esc($podcast->description))
            ->image((string) $podcast->cover->og_url)
            ->canonical((string) current_url())
            ->og('image:width', (string) config('Images')->podcastCoverSizes['og']['width'])
            ->og('image:height', (string) config('Images')->podcastCoverSizes['og']['height'])
            ->og('locale', $podcast->language_code)
            ->og('site_name', esc(service('settings')->get('App.siteName')))
            ->tag('link', null, [
                'rel'  => 'alternate',
                'type' => 'application/activity+json',
                'href' => url_to('podcast-activity', esc($podcast->handle)),
            ])->appendRawContent('<link type="application/rss+xml" rel="alternate" title="' . esc(
                $podcast->title,
            ) . '" href="' . $podcast->feed_url . '" />' . $schema);
    }
}

if (! function_exists('set_episode_metatags')) {
    function set_episode_metatags(Episode $episode): void
    {
        $schema = new Schema(
            new Thing(
                props: [
                    'url'             => url_to('episode', esc($episode->podcast->handle), $episode->slug),
                    'name'            => $episode->title,
                    'image'           => $episode->cover->feed_url,
                    'description'     => $episode->description,
                    'datePublished'   => $episode->published_at->format(DATE_ATOM),
                    'timeRequired'    => iso8601_duration($episode->audio->duration),
                    'duration'        => iso8601_duration($episode->audio->duration),
                    'associatedMedia' => new Thing(
                        props: [
                            'contentUrl' => $episode->audio_url,
                        ],
                        type: 'MediaObject',
                    ),
                    'partOfSeries' => new Thing(
                        props: [
                            'name' => $episode->podcast->title,
                            'url'  => $episode->podcast->link,
                        ],
                        type: 'PodcastSeries',
                    ),
                ],
                type: 'PodcastEpisode',
            ),
        );

        /** @var HtmlHead $head */
        $head = service('html_head');

        $head
            ->title($episode->title)
            ->description(esc($episode->description))
            ->image((string) $episode->cover->og_url, 'player')
            ->canonical($episode->link)
            ->og('site_name', esc(service('settings')->get('App.siteName')))
            ->og('image:width', (string) config('Images')->podcastCoverSizes['og']['width'])
            ->og('image:height', (string) config('Images')->podcastCoverSizes['og']['height'])
            ->og('locale', $episode->podcast->language_code)
            ->og('audio', $episode->audio_opengraph_url)
            ->og('audio:type', $episode->audio->file_mimetype)
            ->meta('article:published_time', $episode->published_at->format(DATE_ATOM))
            ->meta('article:modified_time', $episode->updated_at->format(DATE_ATOM))
            ->twitter('audio:partner', $episode->podcast->publisher ?? '')
            ->twitter('audio:artist_name', esc($episode->podcast->owner_name))
            ->twitter('player', $episode->getEmbedUrl('light'))
            ->twitter('player:width', (string) config('Embed')->width)
            ->twitter('player:height', (string) config('Embed')->height)
            ->tag('link', null, [
                'rel'  => 'alternate',
                'type' => 'application/activity+json',
                'href' => $episode->link,
            ])
            ->appendRawContent('<link rel="alternate" type="application/json+oembed" href="' . base_url(
                route_to('episode-oembed-json', $episode->podcast->handle, $episode->slug),
            ) . '" title="' . esc(
                $episode->title,
            ) . ' oEmbed json" />' . '<link rel="alternate" type="text/xml+oembed" href="' . base_url(
                route_to('episode-oembed-xml', $episode->podcast->handle, $episode->slug),
            ) . '" title="' . esc($episode->title) . ' oEmbed xml" />' . $schema);
    }
}

if (! function_exists('set_post_metatags')) {
    function set_post_metatags(Post $post): void
    {
        $socialMediaPosting = new Thing(
            props: [
                '@id'           => url_to('post', esc($post->actor->username), $post->id),
                'datePublished' => $post->published_at->format(DATE_ATOM),
                'author'        => new Thing(
                    props: [
                        'name' => $post->actor->display_name,
                        'url'  => $post->actor->uri,
                    ],
                    type: 'Person',
                ),
                'text' => $post->message,
            ],
            type: 'SocialMediaPosting',
        );

        if ($post->episode_id !== null) {
            $socialMediaPosting->__set('sharedContent', new Thing(
                props: [
                    'headline' => $post->episode->title,
                    'url'      => $post->episode->link,
                    'author'   => new Thing(
                        props: [
                            'name' => $post->episode->podcast->owner_name,
                        ],
                        type: 'Person',
                    ),
                ],
                type: 'Audio',
            ));
        } elseif ($post->preview_card instanceof PreviewCard) {
            $socialMediaPosting->__set('sharedContent', new Thing(
                props: [
                    'headline' => $post->preview_card->title,
                    'url'      => $post->preview_card->url,
                    'author'   => new Thing(
                        props: [
                            'name' => $post->preview_card->author_name,
                        ],
                        type: 'Person',
                    ),
                ],
                type: 'WebPage',
            ));
        }

        $schema = new Schema($socialMediaPosting);

        /** @var HtmlHead $head */
        $head = service('html_head');

        $head
            ->title(lang('Post.title', [
                'actorDisplayName' => $post->actor->display_name,
            ]))
            ->description($post->message)
            ->image($post->actor->avatar_image_url)
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')))
            ->tag('link', null, [
                'rel'  => 'alternate',
                'type' => 'application/activity+json',
                'href' => url_to('post', esc($post->actor->username), $post->id),
            ])->appendRawContent((string) $schema);
    }
}

if (! function_exists('set_episode_comment_metatags')) {
    function set_episode_comment_metatags(EpisodeComment $episodeComment): void
    {
        $schema = new Schema(new Thing(
            props: [
                '@id' => url_to(
                    'episode-comment',
                    esc($episodeComment->actor->username),
                    $episodeComment->episode->slug,
                    $episodeComment->id,
                ),
                'datePublished' => $episodeComment->created_at->format(DATE_ATOM),
                'author'        => new Thing(
                    props: [
                        'name' => $episodeComment->actor->display_name,
                        'url'  => $episodeComment->actor->uri,
                    ],
                    type: 'Person',
                ),
                'text'        => $episodeComment->message,
                'upvoteCount' => $episodeComment->likes_count,
            ],
            type: 'SocialMediaPosting',
        ));

        /** @var HtmlHead $head */
        $head = service('html_head');

        $head
            ->title(lang('Comment.title', [
                'actorDisplayName' => $episodeComment->actor->display_name,
                'episodeTitle'     => $episodeComment->episode->title,
            ]))
            ->description($episodeComment->message)
            ->image($episodeComment->actor->avatar_image_url)
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')))
            ->tag('link', null, [
                'rel'  => 'alternate',
                'type' => 'application/activity+json',
                'href' => url_to(
                    'episode-comment',
                    $episodeComment->actor->username,
                    $episodeComment->episode->slug,
                    $episodeComment->id,
                ),
            ])->appendRawContent((string) $schema);
    }
}

if (! function_exists('set_follow_metatags')) {
    function set_follow_metatags(Actor $actor): void
    {
        /** @var HtmlHead $head */
        $head = service('html_head');
        $head
            ->title(lang('Podcast.followTitle', [
                'actorDisplayName' => $actor->display_name,
            ]))
            ->description($actor->summary)
            ->image($actor->avatar_image_url)
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')));
    }
}

if (! function_exists('set_remote_actions_metatags')) {
    function set_remote_actions_metatags(Post $post, string $action): void
    {
        /** @var HtmlHead $head */
        $head = service('html_head');
        $head
            ->title(lang('Fediverse.' . $action . '.title', [
                'actorDisplayName' => $post->actor->display_name,
            ],))
            ->description($post->message)
            ->image($post->actor->avatar_image_url)
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')));
    }
}

if (! function_exists('set_home_metatags')) {
    function set_home_metatags(): void
    {
        /** @var HtmlHead $head */
        $head = service('html_head');
        $head
            ->title(service('settings')->get('App.siteName'))
            ->description(esc(service('settings')->get('App.siteDescription')))
            ->image(get_site_icon_url('512'))
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')));

    }
}

if (! function_exists('set_page_metatags')) {
    function set_page_metatags(Page $page): void
    {
        /** @var HtmlHead $head */
        $head = service('html_head');
        $head
            ->title(
                $page->title . service('settings')->get('App.siteTitleSeparator') . service(
                    'settings',
                )->get('App.siteName'),
            )
            ->description(esc(service('settings')->get('App.siteDescription')))
            ->image(get_site_icon_url('512'))
            ->canonical((string) current_url())
            ->og('site_name', esc(service('settings')->get('App.siteName')));

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
