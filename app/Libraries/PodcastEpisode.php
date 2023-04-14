<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Libraries;

use App\Entities\Actor;
use App\Entities\Episode;
use CodeIgniter\I18n\Time;
use Modules\Fediverse\Core\ObjectType;
use Modules\Media\Entities\Chapters;
use Modules\Media\Entities\Transcript;

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
            'id' => $episode->audio_url,
            'type' => 'Audio',
            'name' => esc($episode->title),
            'size' => $episode->audio->file_size,
            'duration' => $episode->audio->duration,
            'url' => [
                'href' => $episode->audio_url,
                'type' => 'Link',
                'mediaType' => $episode->audio->file_mimetype,
            ],
        ];

        if ($episode->transcript instanceof Transcript) {
            $this->audio['transcript'] = $episode->transcript->file_url;
        }

        if ($episode->chapters instanceof Chapters) {
            $this->audio['chapters'] = $episode->chapters->file_url;
        }

        $this->comments = url_to('episode-comments', $episode->podcast->handle, $episode->slug);

        if ($episode->published_at instanceof Time) {
            $this->published = $episode->published_at->format(DATE_W3C);
        }

        if ($episode->podcast->actor instanceof Actor) {
            $this->attributedTo = $episode->podcast->actor->uri;

            if ($episode->podcast->actor->followers_url) {
                $this->cc = [$episode->podcast->actor->followers_url];
            }
        }
    }
}
