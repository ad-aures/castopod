<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Libraries\SimpleRSSElement;
use App\Models\CategoryModel;
use App\Models\EpisodeModel;
use App\Models\PersonModel;
use App\Models\PlatformModel;
use CodeIgniter\Entity\Entity;
use App\Models\UserModel;
use CodeIgniter\I18n\Time;
use League\CommonMark\CommonMarkConverter;
use RuntimeException;

/**
 * @property int $id
 * @property int $actor_id
 * @property Actor|null $actor
 * @property string $name
 * @property string $link
 * @property string $feed_url
 * @property string $title
 * @property string|null $description Holds text only description, striped of any markdown or html special characters
 * @property string $description_markdown
 * @property  string $description_html
 * @property Image $image
 * @property string $image_path
 * @property string $image_mimetype
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
 * @property string|null $episode_description_footer_markdown
 * @property string|null $episode_description_footer_html
 * @property bool $is_blocked
 * @property bool $is_completed
 * @property bool $is_locked
 * @property string|null $imported_feed_url
 * @property string|null $new_feed_url
 * @property Location|null $location
 * @property string|null $location_name
 * @property string|null $location_geo
 * @property string|null $location_osm
 * @property string|null $payment_pointer
 * @property array|null $custom_rss
 * @property string $custom_rss_string
 * @property string|null $partner_id
 * @property string|null $partner_link_url
 * @property string|null $partner_image_url
 * @property int $created_by
 * @property int $updated_by
 * @property Time $created_at;
 * @property Time $updated_at;
 * @property Time|null $deleted_at;
 *
 * @property Episode[] $episodes
 * @property Person[] $persons
 * @property User[] $contributors
 * @property Platform[] $podcasting_platforms
 * @property Platform[] $social_platforms
 * @property Platform[] $funding_platforms
 *
 */
class Podcast extends Entity
{
    protected string $link;
    protected ?Actor $actor = null;
    protected Image $image;
    protected ?string $description = null;
    protected ?Category $category = null;

    /**
     * @var Category[]|null
     */
    protected ?array $other_categories = null;

    /**
     * @var string[]|null
     */
    protected ?array $other_categories_ids = null;

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
    protected string $custom_rss_string;

    /**
     * @var array<string, string>
     */
    protected $casts = [
        'id' => 'integer',
        'actor_id' => 'integer',
        'name' => 'string',
        'title' => 'string',
        'description_markdown' => 'string',
        'description_html' => 'string',
        'image_path' => 'string',
        'image_mimetype' => 'string',
        'language_code' => 'string',
        'category_id' => 'integer',
        'parental_advisory' => '?string',
        'publisher' => '?string',
        'owner_name' => 'string',
        'owner_email' => 'string',
        'type' => 'string',
        'copyright' => '?string',
        'episode_description_footer_markdown' => '?string',
        'episode_description_footer_html' => '?string',
        'is_blocked' => 'boolean',
        'is_completed' => 'boolean',
        'is_locked' => 'boolean',
        'imported_feed_url' => '?string',
        'new_feed_url' => '?string',
        'location_name' => '?string',
        'location_geo' => '?string',
        'location_osm' => '?string',
        'payment_pointer' => '?string',
        'custom_rss' => '?json-array',
        'partner_id' => '?string',
        'partner_link_url' => '?string',
        'partner_image_url' => '?string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    public function getActor(): Actor
    {
        if ($this->actor_id === 0) {
            throw new RuntimeException(
                'Podcast must have an actor_id before getting actor.',
            );
        }

        if ($this->actor === null) {
            $this->actor = model('ActorModel')->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    /**
     * Saves a cover image to the corresponding podcast folder in `public/media/podcast_name/`
     */
    public function setImage(Image $image): static
    {
        // Save image
        $image->saveImage('podcasts/' . $this->attributes['name'], 'cover');

        $this->attributes['image_mimetype'] = $image->mimetype;
        $this->attributes['image_path'] = $image->path;

        return $this;
    }

    public function getImage(): Image
    {
        return new Image(null, $this->image_path, $this->image_mimetype);
    }

    public function getLink(): string
    {
        return url_to('podcast-activity', $this->attributes['name']);
    }

    public function getFeedUrl(): string
    {
        return url_to('podcast_feed', $this->attributes['name']);
    }

    /**
     * Returns the podcast's episodes
     *
     * @return Episode[]
     */
    public function getEpisodes(): array
    {
        if ($this->id === null) {
            throw new RuntimeException(
                'Podcast must be created before getting episodes.',
            );
        }

        if ($this->episodes === null) {
            $this->episodes = (new EpisodeModel())->getPodcastEpisodes(
                $this->id,
                $this->type,
            );
        }

        return $this->episodes;
    }

    /**
     * Returns the podcast's persons
     *
     * @return Person[]
     */
    public function getPersons(): array
    {
        if ($this->id === null) {
            throw new RuntimeException(
                'Podcast must be created before getting persons.',
            );
        }

        if ($this->persons === null) {
            $this->persons = (new PersonModel())->getPodcastPersons($this->id);
        }

        return $this->persons;
    }

    /**
     * Returns the podcast category entity
     */
    public function getCategory(): ?Category
    {
        if ($this->id === null) {
            throw new RuntimeException(
                'Podcast must be created before getting category.',
            );
        }

        if ($this->category === null) {
            $this->category = (new CategoryModel())->getCategoryById(
                $this->category_id,
            );
        }

        return $this->category;
    }

    /**
     * Returns all podcast contributors
     *
     * @return User[]
     */
    public function getContributors(): array
    {
        if ($this->id === null) {
            throw new RuntimeException(
                'Podcasts must be created before getting contributors.',
            );
        }

        if ($this->contributors === null) {
            $this->contributors = (new UserModel())->getPodcastContributors(
                $this->id,
            );
        }

        return $this->contributors;
    }

    public function setDescriptionMarkdown(string $descriptionMarkdown): static
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        $this->attributes['description_markdown'] = $descriptionMarkdown;
        $this->attributes['description_html'] = $converter->convertToHtml(
            $descriptionMarkdown,
        );

        return $this;
    }

    public function setEpisodeDescriptionFooterMarkdown(
        ?string $episodeDescriptionFooterMarkdown = null
    ): static {
        if ($episodeDescriptionFooterMarkdown) {
            $converter = new CommonMarkConverter([
                'html_input' => 'strip',
                'allow_unsafe_links' => false,
            ]);

            $this->attributes[
                'episode_description_footer_markdown'
            ] = $episodeDescriptionFooterMarkdown;
            $this->attributes[
                'episode_description_footer_html'
            ] = $converter->convertToHtml($episodeDescriptionFooterMarkdown);
        }

        return $this;
    }

    public function getDescription(): string
    {
        if ($this->description === null) {
            $this->description = trim(
                (string) preg_replace(
                    '~\s+~',
                    ' ',
                    strip_tags($this->attributes['description_html']),
                ),
            );
        }

        return $this->description;
    }

    /**
     * Returns the podcast's podcasting platform links
     *
     * @return Platform[]
     */
    public function getPodcastingPlatforms(): array
    {
        if ($this->id === null) {
            throw new RuntimeException(
                'Podcast must be created before getting podcasting platform links.',
            );
        }

        if ($this->podcasting_platforms === null) {
            $this->podcasting_platforms = (new PlatformModel())->getPodcastPlatforms(
                $this->id,
                'podcasting',
            );
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
        if ($this->id === null) {
            throw new RuntimeException(
                'Podcast must be created before getting social platform links.',
            );
        }

        if ($this->social_platforms === null) {
            $this->social_platforms = (new PlatformModel())->getPodcastPlatforms(
                $this->id,
                'social',
            );
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
        if ($this->id === null) {
            throw new RuntimeException(
                'Podcast must be created before getting funding platform links.',
            );
        }

        if ($this->funding_platforms === null) {
            $this->funding_platforms = (new PlatformModel())->getPodcastPlatforms(
                $this->id,
                'funding',
            );
        }

        return $this->funding_platforms;
    }

    /**
     * @return Category[]
     */
    public function getOtherCategories(): array
    {
        if ($this->id === null) {
            throw new RuntimeException(
                'Podcast must be created before getting other categories.',
            );
        }

        if ($this->other_categories === null) {
            $this->other_categories = (new CategoryModel())->getPodcastCategories(
                $this->id,
            );
        }

        return $this->other_categories;
    }

    /**
     * @return int[]
     */
    public function getOtherCategoriesIds(): array
    {
        if ($this->other_categories_ids === null) {
            $this->other_categories_ids = array_column(
                $this->getOtherCategories(),
                'id',
            );
        }

        return $this->other_categories_ids;
    }

    /**
     * Saves the location name and fetches OpenStreetMap info
     */
    public function setLocation(?Location $location = null): static
    {
        if ($location === null) {
            $this->attributes['location_name'] = null;
            $this->attributes['location_geo'] = null;
            $this->attributes['location_osm'] = null;

            return $this;
        }

        if (
            !isset($this->attributes['location_name']) ||
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

        if ($this->location === null) {
            $this->location = new Location(
                $this->location_name,
                $this->location_geo,
                $this->location_osm,
            );
        }

        return $this->location;
    }

    /**
     * Get custom rss tag as XML String
     */
    function getCustomRssString(): string
    {
        if ($this->attributes['custom_rss'] === null) {
            return '';
        }

        helper('rss');

        $xmlNode = (new SimpleRSSElement(
            '<?xml version="1.0" encoding="utf-8"?><rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:podcast="https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md" xmlns:content="http://purl.org/rss/1.0/modules/content/" version="2.0"/>',
        ))->addChild('channel');
        array_to_rss(
            [
                'elements' => $this->custom_rss,
            ],
            $xmlNode,
        );

        return str_replace(['<channel>', '</channel>'], '', $xmlNode->asXML());
    }

    /**
     * Saves custom rss tag into json
     */
    function setCustomRssString(string $customRssString): static
    {
        if ($customRssString === '') {
            return $this;
        }

        helper('rss');
        $customRssArray = rss_to_array(
            simplexml_load_string(
                '<?xml version="1.0" encoding="utf-8"?><rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:podcast="https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md" xmlns:content="http://purl.org/rss/1.0/modules/content/" version="2.0"><channel>' .
                    $customRssString .
                    '</channel></rss>',
            ),
        )['elements'][0];

        if (array_key_exists('elements', $customRssArray)) {
            $this->attributes['custom_rss'] = json_encode(
                $customRssArray['elements'],
            );
        } else {
            $this->attributes['custom_rss'] = null;
        }

        return $this;
    }
}
