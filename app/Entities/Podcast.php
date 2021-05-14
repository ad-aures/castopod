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
 * @property string $description Holds text only description, striped of any markdown or html special characters
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
 * @property Location $location
 * @property string|null $location_name
 * @property string|null $location_geo
 * @property string|null $location_osm_id
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
    protected ?Actor $actor;
    protected Image $image;
    protected string $description;
    protected ?Category $category;

    /**
     * @var Category[]
     */
    protected $other_categories = [];

    /**
     * @var string[]
     */
    protected $other_categories_ids = [];

    /**
     * @var Episode[]
     */
    protected $episodes = [];

    /**
     * @var Person[]
     */
    protected $persons = [];

    /**
     * @var User[]
     */
    protected $contributors = [];

    /**
     * @var Platform[]
     */
    protected $podcasting_platforms = [];

    /**
     * @var Platform[]
     */
    protected $social_platforms = [];

    /**
     * @var Platform[]
     */
    protected $funding_platforms = [];

    protected ?Location $location;
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
        'location_osm_id' => '?string',
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
        if (empty($this->id)) {
            throw new RuntimeException(
                'Podcast must be created before getting episodes.',
            );
        }

        if (empty($this->episodes)) {
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
        if (empty($this->id)) {
            throw new RuntimeException(
                'Podcast must be created before getting persons.',
            );
        }

        if (empty($this->persons)) {
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
        if (empty($this->id)) {
            throw new RuntimeException(
                'Podcasts must be created before getting contributors.',
            );
        }

        if (empty($this->contributors)) {
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
        if ($this->description !== '') {
            return $this->description;
        }

        return trim(
            preg_replace(
                '~\s+~',
                ' ',
                strip_tags($this->attributes['description_html']),
            ),
        );
    }

    /**
     * Returns the podcast's podcasting platform links
     *
     * @return Platform[]
     */
    public function getPodcastingPlatforms(): array
    {
        if (empty($this->id)) {
            throw new RuntimeException(
                'Podcast must be created before getting podcasting platform links.',
            );
        }

        if (empty($this->podcasting_platforms)) {
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
        if (empty($this->id)) {
            throw new RuntimeException(
                'Podcast must be created before getting social platform links.',
            );
        }

        if (empty($this->social_platforms)) {
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
        if (empty($this->id)) {
            throw new RuntimeException(
                'Podcast must be created before getting funding platform links.',
            );
        }

        if (empty($this->funding_platforms)) {
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
        if (empty($this->id)) {
            throw new RuntimeException(
                'Podcast must be created before getting other categories.',
            );
        }

        if (empty($this->other_categories)) {
            $this->other_categories = (new CategoryModel())->getPodcastCategories(
                $this->id,
            );
        }

        return $this->other_categories;
    }

    /**
     * @return array<int>
     */
    public function getOtherCategoriesIds(): array
    {
        if (empty($this->other_categories_ids)) {
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
    public function setLocation(?string $newLocationName = null): static
    {
        if ($newLocationName === null) {
            $this->attributes['location_name'] = null;
            $this->attributes['location_geo'] = null;
            $this->attributes['location_osm_id'] = null;
        }

        helper('location');

        $oldLocationName = $this->attributes['location_name'];

        if (
            $oldLocationName === null ||
            $oldLocationName !== $newLocationName
        ) {
            $this->attributes['location_name'] = $newLocationName;

            if ($location = fetch_osm_location($newLocationName)) {
                $this->attributes['location_geo'] = $location['geo'];
                $this->attributes['location_osm_id'] = $location['osm_id'];
            }
        }

        return $this;
    }

    public function getLocation(): ?Location
    {
        if ($this->location_name === null) {
            return null;
        }

        if ($this->location === null) {
            $this->location = new Location([
                'name' => $this->location_name,
                'geo' => $this->location_geo,
                'osm_id' => $this->location_osm_id,
            ]);
        }

        return $this->location;
    }

    /**
     * Get custom rss tag as XML String
     */
    function getCustomRssString(): string
    {
        if (empty($this->attributes['custom_rss'])) {
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
        if (empty($customRssString)) {
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
