<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Libraries\Image;
use App\Libraries\SimpleRSSElement;
use App\Models\CategoryModel;
use App\Models\EpisodeModel;
use App\Models\PlatformModel;
use App\Models\PodcastPersonModel;
use CodeIgniter\Entity\Entity;
use App\Models\UserModel;
use CodeIgniter\Files\File;
use CodeIgniter\HTTP\Files\UploadedFile;
use League\CommonMark\CommonMarkConverter;
use RuntimeException;

class Podcast extends Entity
{
    /**
     * @var string
     */
    protected $link;

    /**
     * @var Actor
     */
    protected $actor;

    /**
     * @var Image
     */
    protected $image;

    /**
     * @var Episode[]
     */
    protected $episodes;

    /**
     * @var PodcastPerson[]
     */
    protected $persons;

    /**
     * @var Category
     */
    protected $category;

    /**
     * @var Category[]
     */
    protected $other_categories;

    /**
     * @var integer[]
     */
    protected $other_categories_ids;

    /**
     * @var User[]
     */
    protected $contributors;

    /**
     * @var Platform
     */
    protected $podcastingPlatforms;

    /**
     * @var Platform
     */
    protected $socialPlatforms;

    /**
     * @var Platform
     */
    protected $fundingPlatforms;

    /**
     * Holds text only description, striped of any markdown or html special characters
     *
     * @var string
     */
    protected $description;

    /**
     * Return custom rss as string
     *
     * @var string
     */
    protected $custom_rss_string;

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
        'location_osmid' => '?string',
        'payment_pointer' => '?string',
        'custom_rss' => '?json-array',
        'partner_id' => '?string',
        'partner_link_url' => '?string',
        'partner_image_url' => '?string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    /**
     * Returns the podcast actor
     *
     * @return Actor
     */
    public function getActor(): Actor
    {
        if (!$this->attributes['actor_id']) {
            throw new RuntimeException(
                'Podcast must have an actor_id before getting actor.',
            );
        }

        if (empty($this->actor)) {
            $this->actor = model('ActorModel')->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    /**
     * Saves a cover image to the corresponding podcast folder in `public/media/podcast_name/`
     *
     * @param UploadedFile|File $image
     */
    public function setImage($image = null): self
    {
        if ($image) {
            helper('media');

            $this->attributes['image_mimetype'] = $image->getMimeType();
            $this->attributes['image_path'] = save_media(
                $image,
                'podcasts/' . $this->attributes['name'],
                'cover',
            );

            $this->image = new Image(
                $this->attributes['image_path'],
                $this->attributes['image_mimetype'],
            );
            $this->image->saveSizes();
        }

        return $this;
    }

    public function getImage(): Image
    {
        return new Image(
            $this->attributes['image_path'],
            $this->attributes['image_mimetype'],
        );
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
     * @return PodcastPerson[]
     */
    public function getPersons(): array
    {
        if (empty($this->id)) {
            throw new RuntimeException(
                'Podcast must be created before getting persons.',
            );
        }

        if (empty($this->persons)) {
            $this->persons = (new PodcastPersonModel())->getPodcastPersons(
                $this->id,
            );
        }

        return $this->persons;
    }

    /**
     * Returns the podcast category entity
     *
     * @return Category
     */
    public function getCategory(): Category
    {
        if (empty($this->id)) {
            throw new RuntimeException(
                'Podcast must be created before getting category.',
            );
        }

        if (empty($this->category)) {
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

    public function setDescriptionMarkdown(string $descriptionMarkdown): self
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
    ): self {
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
        if ($this->description) {
            return $this->description;
        }

        return trim(
            preg_replace(
                '/\s+/',
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

        if (empty($this->podcastingPlatforms)) {
            $this->podcastingPlatforms = (new PlatformModel())->getPodcastPlatforms(
                $this->id,
                'podcasting',
            );
        }

        return $this->podcastingPlatforms;
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

        if (empty($this->socialPlatforms)) {
            $this->socialPlatforms = (new PlatformModel())->getPodcastPlatforms(
                $this->id,
                'social',
            );
        }

        return $this->socialPlatforms;
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

        if (empty($this->fundingPlatforms)) {
            $this->fundingPlatforms = (new PlatformModel())->getPodcastPlatforms(
                $this->id,
                'funding',
            );
        }

        return $this->fundingPlatforms;
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
    public function setLocation(?string $locationName = null): self
    {
        helper('location');

        if (
            $locationName &&
            (empty($this->attributes['location_name']) ||
                $this->attributes['location_name'] != $locationName)
        ) {
            $this->attributes['location_name'] = $locationName;
            if ($location = fetch_osm_location($locationName)) {
                $this->attributes['location_geo'] = $location['geo'];
                $this->attributes['location_osmid'] = $location['osmid'];
            }
        } elseif (empty($locationName)) {
            $this->attributes['location_name'] = null;
            $this->attributes['location_geo'] = null;
            $this->attributes['location_osmid'] = null;
        }

        return $this;
    }

    /**
     * Get custom rss tag as XML String
     *
     * @return string
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
     *
     * @param string $customRssString
     */
    function setCustomRssString($customRssString): self
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
