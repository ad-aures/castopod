<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use App\Entities\Episode;
use Modules\Fediverse\Core\ObjectType;

class PodcastEpisode extends ObjectType
{
    protected string $type = 'PodcastEpisode';

    protected string $attributedTo;

    protected string $comments;

    /**
     * @var array<mixed>
     */
    protected array $description = [];

    /**
     * @var array<string, string>
     */
    protected array $image = [];

    /**
     * @var array<mixed>
     */
    protected array $audio = [];

    public function __construct(Episode $episode)
    {
        // TODO: clean things up with specified spec
        $this->id = $episode->link;

        $this->description = [
            'type' => 'Note',
            'mediaType' => 'text/markdown',
            'content' => $episode->description_markdown,
            'contentMap' => [
                $episode->podcast->language_code => $episode->description_html,
            ],
        ];

        $this->image = [
            'type' => 'Image',
            'mediaType' => $episode->cover->file_mimetype,
            'url' => $episode->cover->feed_url,
        ];

        // add audio file
        $this->audio = [
            'id' => $episode->audio->file_url,
            'type' => 'Audio',
            'name' => $episode->title,
            'size' => $episode->audio->file_size,
            'duration' => $episode->audio->duration,
            'url' => [
                'href' => $episode->audio->file_url,
                'type' => 'Link',
                'mediaType' => $episode->audio->file_mimetype,
            ],
        ];

        if ($episode->transcript !== null) {
            $this->audio['transcript'] = $episode->transcript->file_url;
        }

        if ($episode->chapters !== null) {
            $this->audio['chapters'] = $episode->chapters->file_url;
        }

        $this->comments = url_to('episode-comments', $episode->podcast->handle, $episode->slug);

        if ($episode->published_at !== null) {
            $this->published = $episode->published_at->format(DATE_W3C);
        }

        if ($episode->podcast->actor !== null) {
            $this->attributedTo = $episode->podcast->actor->uri;

            if ($episode->podcast->actor->followers_url) {
                $this->cc = [$episode->podcast->actor->followers_url];
            }
        }
    }
}
