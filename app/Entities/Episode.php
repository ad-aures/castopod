<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Entities\Clip\Soundbite;
use App\Models\ClipModel;
use App\Models\EpisodeCommentModel;
use App\Models\EpisodeModel;
use App\Models\PersonModel;
use App\Models\PodcastModel;
use App\Models\PostModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\I18n\Time;
use Exception;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\MarkdownConverter;
use Modules\Media\Entities\Audio;
use Modules\Media\Entities\Chapters;
use Modules\Media\Entities\Image;
use Modules\Media\Entities\Transcript;
use Modules\Media\Models\MediaModel;
use Override;

/**
 * @property int $id
 * @property int $podcast_id
 * @property Podcast $podcast
 * @property ?string $preview_id
 * @property string $preview_link
 * @property string $link
 * @property string $guid
 * @property string $slug
 * @property string $title
 * @property int $audio_id
 * @property ?Audio $audio
 * @property string $audio_url
 * @property string $audio_web_url
 * @property string $audio_opengraph_url
 * @property string|null $description Holds text only description, striped of any markdown or html special characters
 * @property string $description_markdown
 * @property string $description_html
 * @property ?int $cover_id
 * @property ?Image $cover
 * @property int|null $transcript_id
 * @property Transcript|null $transcript
 * @property string|null $transcript_remote_url
 * @property int|null $chapters_id
 * @property Chapters|null $chapters
 * @property string|null $chapters_remote_url
 * @property string|null $parental_advisory
 * @property ?int $number
 * @property ?int $season_number
 * @property string $type
 * @property bool $is_blocked
 * @property Location|null $location
 * @property string|null $location_name
 * @property string|null $location_geo
 * @property string|null $location_osm
 * @property bool $is_published_on_hubs
 * @property int $downloads_count
 * @property int $posts_count
 * @property int $comments_count
 * @property EpisodeComment[]|null $comments
 * @property bool $is_premium
 * @property int $created_by
 * @property int $updated_by
 * @property string $publication_status
 * @property Time|null $published_at
 * @property Time $created_at
 * @property Time $updated_at
 *
 * @property Person[] $persons
 * @property Soundbite[] $soundbites
 * @property string $embed_url
 */
class Episode extends Entity
{
    public string $link = '';

    public string $audio_url = '';

    public string $audio_web_url = '';

    public string $audio_opengraph_url = '';

    protected Podcast $podcast;

    protected ?Audio $audio = null;

    protected string $embed_url = '';

    protected ?Image $cover = null;

    protected ?string $description = null;

    protected ?Transcript $transcript = null;

    protected ?Chapters $chapters = null;

    /**
     * @var Person[]|null
     */
    protected ?array $persons = null;

    /**
     * @var Soundbite[]|null
     */
    protected ?array $soundbites = null;

    /**
     * @var Post[]|null
     */
    protected ?array $posts = null;

    /**
     * @var EpisodeComment[]|null
     */
    protected ?array $comments = null;

    protected ?Location $location = null;

    protected ?string $publication_status = null;

    /**
     * @var array<int, string>
     * @phpstan-var list<string>
     */
    protected $dates = ['published_at', 'created_at', 'updated_at'];

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id'                    => 'integer',
        'podcast_id'            => 'integer',
        'preview_id'            => '?string',
        'guid'                  => 'string',
        'slug'                  => 'string',
        'title'                 => 'string',
        'audio_id'              => 'integer',
        'description_markdown'  => 'string',
        'description_html'      => 'string',
        'cover_id'              => '?integer',
        'transcript_id'         => '?integer',
        'transcript_remote_url' => '?string',
        'chapters_id'           => '?integer',
        'chapters_remote_url'   => '?string',
        'parental_advisory'     => '?string',
        'number'                => '?integer',
        'season_number'         => '?integer',
        'type'                  => 'string',
        'is_blocked'            => 'boolean',
        'location_name'         => '?string',
        'location_geo'          => '?string',
        'location_osm'          => '?string',
        'is_published_on_hubs'  => 'boolean',
        'downloads_count'       => 'integer',
        'posts_count'           => 'integer',
        'comments_count'        => 'integer',
        'is_premium'            => 'boolean',
        'created_by'            => 'integer',
        'updated_by'            => 'integer',
    ];

    /**
     * @param array<string, mixed> $data
     */
    #[Override]
    public function injectRawData(array $data): static
    {
        parent::injectRawData($data);

        $this->link = url_to('episode', esc($this->getPodcast()->handle, 'url'), esc($this->attributes['slug'], 'url'));

        $this->audio_url = url_to(
            'episode-audio',
            $this->getPodcast()
                ->handle,
            $this->slug,
            $this->getAudio()
                ->file_extension,
        );

        $this->audio_opengraph_url = $this->audio_url . '?_from=-+Open+Graph+-';
        $this->audio_web_url = $this->audio_url . '?_from=-+Website+-';

        return $this;
    }

    public function setCover(UploadedFile | File|null $file = null): self
    {
        if (! $file instanceof File || ($file instanceof UploadedFile && ! $file->isValid())) {
            return $this;
        }

        if (array_key_exists('cover_id', $this->attributes) && $this->attributes['cover_id'] !== null) {
            $this->getCover()
                ->setFile($file);
            $this->getCover()
                ->updated_by = $this->attributes['updated_by'];
            new MediaModel('image')
                ->updateMedia($this->getCover());
        } else {
            $cover = new Image([
                'file_key' => 'podcasts/' . $this->getPodcast()->handle . '/' . $this->attributes['slug'] . '.' . $file->getExtension(),
                'sizes'    => config('Images')
                    ->podcastCoverSizes,
                'uploaded_by' => $this->attributes['updated_by'],
                'updated_by'  => $this->attributes['updated_by'],
            ]);
            $cover->setFile($file);

            $this->attributes['cover_id'] = new MediaModel('image')->saveMedia($cover);
        }

        return $this;
    }

    public function getCover(): Image
    {
        if ($this->cover instanceof Image) {
            return $this->cover;
        }

        if ($this->cover_id === null) {
            $this->cover = $this->getPodcast()
                ->getCover();

            return $this->cover;
        }

        $this->cover = new MediaModel('image')
            ->getMediaById($this->cover_id);

        return $this->cover;
    }

    public function setAudio(UploadedFile | File|null $file = null): self
    {
        if (! $file instanceof File || ($file instanceof UploadedFile && ! $file->isValid())) {
            return $this;
        }

        if ($this->audio_id !== 0) {
            $this->getAudio()
                ->setFile($file);
            $this->getAudio()
                ->updated_by = $this->attributes['updated_by'];
            new MediaModel('audio')
                ->updateMedia($this->getAudio());
        } else {
            $audio = new Audio([
                'file_key'      => 'podcasts/' . $this->getPodcast()->handle . '/' . $file->getRandomName(),
                'language_code' => $this->getPodcast()
                    ->language_code,
                'uploaded_by' => $this->attributes['updated_by'],
                'updated_by'  => $this->attributes['updated_by'],
            ]);
            $audio->setFile($file);

            $this->attributes['audio_id'] = new MediaModel()->saveMedia($audio);
        }

        return $this;
    }

    public function getAudio(): Audio
    {
        if (! $this->audio instanceof Audio) {
            $this->audio = new MediaModel('audio')
                ->getMediaById($this->audio_id);
        }

        return $this->audio;
    }

    public function setTranscript(UploadedFile | File|null $file = null): self
    {
        if (! $file instanceof File || ($file instanceof UploadedFile && ! $file->isValid())) {
            return $this;
        }

        if ($this->getTranscript() instanceof Transcript) {
            $this->getTranscript()
                ->setFile($file);
            $this->getTranscript()
                ->updated_by = $this->attributes['updated_by'];
            new MediaModel('transcript')
                ->updateMedia($this->getTranscript());
        } else {
            $transcript = new Transcript([
                'file_key'      => 'podcasts/' . $this->getPodcast()->handle . '/' . $this->attributes['slug'] . '-transcript.' . $file->getExtension(),
                'language_code' => $this->getPodcast()
                    ->language_code,
                'uploaded_by' => $this->attributes['updated_by'],
                'updated_by'  => $this->attributes['updated_by'],
            ]);
            $transcript->setFile($file);

            $this->attributes['transcript_id'] = new MediaModel('transcript')->saveMedia($transcript);
        }

        return $this;
    }

    public function getTranscript(): ?Transcript
    {
        if ($this->transcript_id !== null && ! $this->transcript instanceof Transcript) {
            $this->transcript = new MediaModel('transcript')
                ->getMediaById($this->transcript_id);
        }

        return $this->transcript;
    }

    public function setChapters(UploadedFile | File|null $file = null): self
    {
        if (! $file instanceof File || ($file instanceof UploadedFile && ! $file->isValid())) {
            return $this;
        }

        if ($this->getChapters() instanceof Chapters) {
            $this->getChapters()
                ->setFile($file);
            $this->getChapters()
                ->updated_by = $this->attributes['updated_by'];
            new MediaModel('chapters')
                ->updateMedia($this->getChapters());
        } else {
            $chapters = new Chapters([
                'file_key'      => 'podcasts/' . $this->getPodcast()->handle . '/' . $this->attributes['slug'] . '-chapters' . '.' . $file->getExtension(),
                'language_code' => $this->getPodcast()
                    ->language_code,
                'uploaded_by' => $this->attributes['updated_by'],
                'updated_by'  => $this->attributes['updated_by'],
            ]);
            $chapters->setFile($file);

            $this->attributes['chapters_id'] = new MediaModel('chapters')->saveMedia($chapters);
        }

        return $this;
    }

    public function getChapters(): ?Chapters
    {
        if ($this->chapters_id !== null && ! $this->chapters instanceof Chapters) {
            $this->chapters = new MediaModel('chapters')
                ->getMediaById($this->chapters_id);
        }

        return $this->chapters;
    }

    /**
     * Gets transcript url from transcript file uri if it exists or returns the transcript_remote_url which can be null.
     */
    public function getTranscriptUrl(): ?string
    {
        if ($this->transcript instanceof Transcript) {
            return $this->transcript->file_url;
        }

        return $this->transcript_remote_url;
    }

    /**
     * Gets chapters file url from chapters file uri if it exists or returns the chapters_remote_url which can be null.
     */
    public function getChaptersFileUrl(): ?string
    {
        if ($this->chapters instanceof Chapters) {
            return $this->chapters->file_url;
        }

        return $this->chapters_remote_url;
    }

    /**
     * Returns the episode's persons
     *
     * @return Person[]
     */
    public function getPersons(): array
    {
        if ($this->persons === null) {
            $this->persons = new PersonModel()
                ->getEpisodePersons($this->podcast_id, $this->id);
        }

        return $this->persons;
    }

    /**
     * Returns the episode’s clips
     *
     * @return Soundbite[]
     */
    public function getSoundbites(): array
    {
        if ($this->soundbites === null) {
            $this->soundbites = new ClipModel()
                ->getEpisodeSoundbites($this->getPodcast()->id, $this->id);
        }

        return $this->soundbites;
    }

    /**
     * @return Post[]
     */
    public function getPosts(): array
    {
        if ($this->posts === null) {
            $this->posts = new PostModel()
                ->getEpisodePosts($this->id);
        }

        return $this->posts;
    }

    /**
     * @return EpisodeComment[]
     */
    public function getComments(): array
    {
        if ($this->comments === null) {
            $this->comments = new EpisodeCommentModel()
                ->getEpisodeComments($this->id);
        }

        return $this->comments;
    }

    public function getEmbedUrl(?string $theme = null): string
    {
        return $theme
                ? url_to('embed-theme', esc($this->getPodcast()->handle), esc($this->attributes['slug']), $theme)
                : url_to('embed', esc($this->getPodcast()->handle), esc($this->attributes['slug']));
    }

    public function setGuid(?string $guid = null): static
    {
        $this->attributes['guid'] = $guid ?? $this->link;

        return $this;
    }

    public function getPodcast(): ?Podcast
    {
        return new PodcastModel()
            ->getPodcastById($this->podcast_id);
    }

    public function setDescriptionMarkdown(string $descriptionMarkdown): static
    {
        $config = [
            'html_input'         => 'escape',
            'allow_unsafe_links' => false,
        ];

        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());
        $environment->addExtension(new AutolinkExtension());
        $environment->addExtension(new SmartPunctExtension());
        $environment->addExtension(new DisallowedRawHtmlExtension());

        $converter = new MarkdownConverter($environment);

        $this->attributes['description_markdown'] = $descriptionMarkdown;
        $this->attributes['description_html'] = $converter->convert($descriptionMarkdown);

        return $this;
    }

    public function getDescription(): string
    {
        if ($this->description === null) {
            $this->description = trim(
                (string) preg_replace('~\s+~', ' ', strip_tags((string) $this->attributes['description_html'])),
            );
        }

        return $this->description;
    }

    public function getPublicationStatus(): string
    {
        if ($this->publication_status === null) {
            if (! $this->published_at instanceof Time) {
                $this->publication_status = 'not_published';
            } elseif ($this->getPodcast()->publication_status !== 'published') {
                $this->publication_status = 'with_podcast';
            } elseif ($this->published_at->isBefore(Time::now())) {
                $this->publication_status = 'published';
            } else {
                $this->publication_status = 'scheduled';
            }
        }

        return $this->publication_status;
    }

    /**
     * Saves the location name and fetches OpenStreetMap info
     */
    public function setLocation(?Location $location = null): static
    {
        if (! $location instanceof Location) {
            $this->attributes['location_name'] = null;
            $this->attributes['location_geo'] = null;
            $this->attributes['location_osm'] = null;

            return $this;
        }

        if (
            ! isset($this->attributes['location_name']) ||
            $this->attributes['location_name'] !== $location->name
        ) {
            $location->fetchOsmLocation();

            $this->attributes['location_name'] = $location->name;
            $this->attributes['location_geo'] = $location->geo;
            $this->attributes['location_osm'] = $location->osm;
        }

        return $this;
    }

    public function getLocation(): ?Location
    {
        if ($this->location_name === null) {
            return null;
        }

        if (! $this->location instanceof Location) {
            $this->location = new Location($this->location_name, $this->location_geo, $this->location_osm);
        }

        return $this->location;
    }

    public function getPreviewLink(): string
    {
        if ($this->preview_id === null) {
            // generate preview id
            if (! $previewUUID = new EpisodeModel()->setEpisodePreviewId($this->id)) {
                throw new Exception('Could not set episode preview id');
            }

            $this->preview_id = $previewUUID;
        }

        return url_to('episode-preview', (string) $this->preview_id);
    }

    /**
     * Returns the episode's clip count
     */
    public function getClipCount(): int|string
    {
        return new ClipModel()
            ->getClipCount($this->podcast_id, $this->id);
    }
}
