<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\ActorModel;
use App\Models\CategoryModel;
use App\Models\EpisodeModel;
use App\Models\PersonModel;
use CodeIgniter\Entity\Entity;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use CodeIgniter\I18n\Time;
use CodeIgniter\Shield\Entities\User;
use Exception;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\Autolink\AutolinkExtension;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\MarkdownConverter;
use Modules\Auth\Models\UserModel;
use Modules\Media\Entities\Image;
use Modules\Media\Models\MediaModel;
use Modules\Platforms\Entities\Platform;
use Modules\Platforms\Models\PlatformModel;
use Modules\PremiumPodcasts\Entities\Subscription;
use Modules\PremiumPodcasts\Models\SubscriptionModel;
use RuntimeException;

/**
 * @property int $id
 * @property string $guid
 * @property int $actor_id
 * @property Actor|null $actor
 * @property string $handle
 * @property string $at_handle
 * @property string $link
 * @property string $feed_url
 * @property string $title
 * @property string|null $description Holds text only description, striped of any markdown or html special characters
 * @property string $description_markdown
 * @property  string $description_html
 * @property int $cover_id
 * @property ?Image $cover
 * @property int|null $banner_id
 * @property ?Image $banner
 * @property string $language_code
 * @property int $category_id
 * @property Category|null $category
 * @property int[] $other_categories_ids
 * @property Category[] $other_categories
 * @property string|null $parental_advisory
 * @property string|null $publisher
 * @property string $owner_name
 * @property string $owner_email
 * @property string $type
 * @property string|null $copyright
 * @property bool $is_blocked
 * @property bool $is_completed
 * @property bool $is_locked
 * @property string|null $imported_feed_url
 * @property string|null $new_feed_url
 * @property Location|null $location
 * @property string|null $location_name
 * @property string|null $location_geo
 * @property string|null $location_osm
 * @property bool $is_published_on_hubs
 * @property int $created_by
 * @property int $updated_by
 * @property string $publication_status
 * @property bool $is_premium_by_default
 * @property bool $is_premium
 * @property Time|null $published_at
 * @property Time $created_at
 * @property Time $updated_at
 *
 * @property Episode[] $episodes
 * @property Person[] $persons
 * @property User[] $contributors
 * @property Subscription[] $subscriptions
 * @property Platform[] $podcasting_platforms
 * @property Platform[] $social_platforms
 * @property Platform[] $funding_platforms
 */
class Podcast extends Entity
{
    protected string $link;

    protected string $at_handle;

    protected ?Actor $actor = null;

    protected ?Image $cover = null;

    protected ?Image $banner = null;

    protected ?string $description = null;

    protected ?Category $category = null;

    /**
     * @var Category[]|null
     */
    protected ?array $other_categories = null;

    /**
     * @var int[]
     */
    protected array $other_categories_ids = [];

    /**
     * @var Episode[]|null
     */
    protected ?array $episodes = null;

    /**
     * @var Person[]|null
     */
    protected ?array $persons = null;

    /**
     * @var User[]|null
     */
    protected ?array $contributors = null;

    /**
     * @var Subscription[]|null
     */
    protected ?array $subscriptions = null;

    /**
     * @var Platform[]|null
     */
    protected ?array $podcasting_platforms = null;

    /**
     * @var Platform[]|null
     */
    protected ?array $social_platforms = null;

    /**
     * @var Platform[]|null
     */
    protected ?array $funding_platforms = null;

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
        'guid'                  => 'string',
        'actor_id'              => 'integer',
        'handle'                => 'string',
        'title'                 => 'string',
        'description_markdown'  => 'string',
        'description_html'      => 'string',
        'cover_id'              => 'int',
        'banner_id'             => '?int',
        'language_code'         => 'string',
        'category_id'           => 'integer',
        'parental_advisory'     => '?string',
        'publisher'             => '?string',
        'owner_name'            => 'string',
        'owner_email'           => 'string',
        'type'                  => 'string',
        'copyright'             => '?string',
        'is_blocked'            => 'boolean',
        'is_completed'          => 'boolean',
        'is_locked'             => 'boolean',
        'is_premium_by_default' => 'boolean',
        'imported_feed_url'     => '?string',
        'new_feed_url'          => '?string',
        'location_name'         => '?string',
        'location_geo'          => '?string',
        'location_osm'          => '?string',
        'is_published_on_hubs'  => 'boolean',
        'created_by'            => 'integer',
        'updated_by'            => 'integer',
    ];

    public function getAtHandle(): string
    {
        return '@' . $this->handle;
    }

    public function getActor(): ?Actor
    {
        if ($this->actor_id === 0) {
            throw new RuntimeException('Podcast must have an actor_id before getting actor.');
        }

        if (! $this->actor instanceof Actor) {
            $this->actor = model(ActorModel::class, false)
                ->getActorById($this->actor_id);
        }

        return $this->actor;
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
                'file_key' => 'podcasts/' . $this->attributes['handle'] . '/cover.' . $file->getExtension(),
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
        if (! $this->cover instanceof Image) {
            $cover = new MediaModel('image')
                ->getMediaById($this->cover_id);

            if (! $cover instanceof Image) {
                throw new Exception('Could not retrieve podcast cover.');
            }

            $this->cover = $cover;
        }

        return $this->cover;
    }

    public function setBanner(UploadedFile | File|null $file = null): self
    {
        if (! $file instanceof File || ($file instanceof UploadedFile && ! $file->isValid())) {
            return $this;
        }

        if (array_key_exists('banner_id', $this->attributes) && $this->attributes['banner_id'] !== null) {
            $this->getBanner()
                ->setFile($file);
            $this->getBanner()
                ->updated_by = $this->attributes['updated_by'];
            new MediaModel('image')
                ->updateMedia($this->getBanner());
        } else {
            $banner = new Image([
                'file_key' => 'podcasts/' . $this->attributes['handle'] . '/banner.' . $file->getExtension(),
                'sizes'    => config('Images')
                    ->podcastBannerSizes,
                'uploaded_by' => $this->attributes['updated_by'],
                'updated_by'  => $this->attributes['updated_by'],
            ]);
            $banner->setFile($file);

            $this->attributes['banner_id'] = new MediaModel('image')->saveMedia($banner);
        }

        return $this;
    }

    public function getBanner(): ?Image
    {
        if ($this->banner_id === null) {
            return null;
        }

        if (! $this->banner instanceof Image) {
            $this->banner = new MediaModel('image')
                ->getMediaById($this->banner_id);
        }

        return $this->banner;
    }

    public function getLink(): string
    {
        return url_to('podcast-activity', $this->attributes['handle']);
    }

    public function getFeedUrl(): string
    {
        return url_to('podcast-rss-feed', $this->attributes['handle']);
    }

    /**
     * Returns the podcast's episodes
     *
     * @return Episode[]
     */
    public function getEpisodes(): array
    {
        if ($this->episodes === null) {
            $this->episodes = new EpisodeModel()
                ->getPodcastEpisodes($this->id, $this->type);
        }

        return $this->episodes;
    }

    /**
     * Returns the podcast's episodes count
     */
    public function getEpisodesCount(): int|string
    {
        return new EpisodeModel()
            ->getPodcastEpisodesCount($this->id);
    }

    /**
     * Returns the podcast's persons
     *
     * @return Person[]
     */
    public function getPersons(): array
    {
        if ($this->persons === null) {
            $this->persons = new PersonModel()
                ->getPodcastPersons($this->id);
        }

        return $this->persons;
    }

    /**
     * Returns the podcast category entity
     */
    public function getCategory(): ?Category
    {
        if (! $this->category instanceof Category) {
            $this->category = new CategoryModel()
                ->getCategoryById($this->category_id);
        }

        return $this->category;
    }

    /**
     * Returns all podcast subscriptions
     *
     * @return Subscription[]
     */
    public function getSubscriptions(): array
    {
        if ($this->subscriptions === null) {
            $this->subscriptions = new SubscriptionModel()
                ->getPodcastSubscriptions($this->id);
        }

        return $this->subscriptions;
    }

    /**
     * Returns all podcast contributors
     *
     * @return User[]
     */
    public function getContributors(): array
    {
        if ($this->contributors === null) {
            $this->contributors = new UserModel()
                ->getPodcastContributors($this->id);
        }

        return $this->contributors;
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
            } elseif ($this->published_at->isBefore(Time::now())) {
                $this->publication_status = 'published';
            } else {
                $this->publication_status = 'scheduled';
            }
        }

        return $this->publication_status;
    }

    /**
     * Returns the podcast's podcasting platform links
     *
     * @return Platform[]
     */
    public function getPodcastingPlatforms(): array
    {
        if ($this->podcasting_platforms === null) {
            $this->podcasting_platforms = new PlatformModel()
                ->getPlatforms($this->id, 'podcasting');
        }

        return $this->podcasting_platforms;
    }

    /**
     * Returns the podcast's social platform links
     *
     * @return Platform[]
     */
    public function getSocialPlatforms(): array
    {
        if ($this->social_platforms === null) {
            $this->social_platforms = new PlatformModel()
                ->getPlatforms($this->id, 'social');
        }

        return $this->social_platforms;
    }

    /**
     * Returns the podcast's funding platform links
     *
     * @return Platform[]
     */
    public function getFundingPlatforms(): array
    {
        if ($this->funding_platforms === null) {
            $this->funding_platforms = new PlatformModel()
                ->getPlatforms($this->id, 'funding');
        }

        return $this->funding_platforms;
    }

    /**
     * @return Category[]
     */
    public function getOtherCategories(): array
    {
        if ($this->other_categories === null) {
            $this->other_categories = new CategoryModel()
                ->getPodcastCategories($this->id);
        }

        return $this->other_categories;
    }

    /**
     * @return int[]
     */
    public function getOtherCategoriesIds(): array
    {
        if ($this->other_categories_ids === []) {
            $this->other_categories_ids = array_column($this->getOtherCategories(), 'id');
        }

        return $this->other_categories_ids;
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

    public function getIsPremium(): bool
    {
        // podcast is premium if at least one of its episodes is set as premium
        return new EpisodeModel()
            ->doesPodcastHavePremiumEpisodes($this->id);
    }
}
