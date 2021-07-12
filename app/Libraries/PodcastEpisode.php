<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use ActivityPub\Core\ObjectType;
use App\Entities\Episode;

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
            'mediaType' => $episode->image_mimetype,
            'url' => $episode->image->url,
        ];

        // add audio file
        $this->audio = [
            'id' => $episode->audio_file_url,
            'type' => 'Audio',
            'name' => $episode->title,
            'size' => $episode->audio_file_size,
            'duration' => $episode->audio_file_duration,
            'url' => [
                'href' => $episode->audio_file_url,
                'type' => 'Link',
                'mediaType' => $episode->audio_file_mimetype,
            ],
            'transcript' => $episode->transcript_file_url,
            'chapters' => $episode->chapters_file_url,
        ];

        $this->comments = url_to('episode-comments', $episode->podcast->name, $episode->slug);

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
