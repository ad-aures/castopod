<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use ActivityPub\Models\ActorModel;
use App\Models\CategoryModel;
use App\Models\EpisodeModel;
use App\Models\PlatformModel;
use App\Models\PodcastPersonModel;
use CodeIgniter\Entity;
use App\Models\UserModel;
use League\CommonMark\CommonMarkConverter;

class Podcast extends Entity
{
    /**
     * @var string
     */
    protected $link;

    /**
     * @var \ActivityPub\Entities\Actor
     */
    protected $actor;

    /**
     * @var \App\Libraries\Image
     */
    protected $image;

    /**
     * @var \App\Entities\Episode[]
     */
    protected $episodes;

    /**
     * @var \App\Entities\PodcastPerson[]
     */
    protected $persons;

    /**
     * @var \App\Entities\Category
     */
    protected $category;

    /**
     * @var \App\Entities\Category[]
     */
    protected $other_categories;

    /**
     * @var integer[]
     */
    protected $other_categories_ids;

    /**
     * @var \App\Entities\User[]
     */
    protected $contributors;

    /**
     * @var \App\Entities\Platform
     */
    protected $podcastingPlatforms;

    /**
     * @var \App\Entities\Platform
     */
    protected $socialPlatforms;

    /**
     * @var \App\Entities\Platform
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
        'image_uri' => 'string',
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
     * @return \App\Entities\Actor
     */
    public function getActor()
    {
        if (!$this->attributes['actor_id']) {
            throw new \RuntimeException(
                'Podcast must have an actor_id before getting actor.',
            );
        }

        if (empty($this->actor)) {
            $this->actor = (new ActorModel())->getActorById($this->actor_id);
        }

        return $this->actor;
    }

    /**
     * Saves a cover image to the corresponding podcast folder in `public/media/podcast_name/`
     *
     * @param \CodeIgniter\HTTP\Files\UploadedFile|\CodeIgniter\Files\File $image
     *
     */
    public function setImage($image = null)
    {
        if ($image) {
            helper('media');

            $this->attributes['image_mimetype'] = $image->getMimeType();
            $this->attributes['image_uri'] = save_media(
                $image,
                'podcasts/' . $this->attributes['name'],
                'cover',
            );

            $this->image = new \App\Libraries\Image(
                $this->attributes['image_uri'],
                $this->attributes['image_mimetype'],
            );
            $this->image->saveSizes();
        }

        return $this;
    }

    public function getImage()
    {
        return new \App\Libraries\Image(
            $this->attributes['image_uri'],
            $this->attributes['image_mimetype'],
        );
    }

    public function getLink()
    {
        return url_to('podcast-activity', $this->attributes['name']);
    }

    public function getFeedUrl()
    {
        return url_to('podcast_feed', $this->attributes['name']);
    }

    /**
     * Returns the podcast's episodes
     *
     * @return \App\Entities\Episode[]
     */
    public function getEpisodes()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
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
     * @return \App\Entities\PodcastPerson[]
     */
    public function getPersons()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
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
     * @return \App\Entities\Category
     */
    public function getCategory()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Podcast must be created before getting category.',
            );
        }

        if (empty($this->category)) {
            $this->category = (new CategoryModel())->find($this->category_id);
        }

        return $this->category;
    }

    /**
     * Returns all podcast contributors
     *
     * @return \App\Entities\User[]
     */
    public function getContributors()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
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

    public function setDescriptionMarkdown(string $descriptionMarkdown)
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
        string $episodeDescriptionFooterMarkdown = null
    ) {
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

    public function getDescription()
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
     * @return \App\Entities\Platform[]
     */
    public function getPodcastingPlatforms()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
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
     * Returns true if the podcast has podcasting platform links
     */
    public function getHasPodcastingPlatforms()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Podcast must be created before getting podcasting platform.',
            );
        }
        foreach ($this->getPodcastingPlatforms() as $podcastingPlatform) {
            if ($podcastingPlatform->is_on_embeddable_player) {
                return true;
            }
        }
        return false;
    }

    /**
     * Returns the podcast's social platform links
     *
     * @return \App\Entities\Platform[]
     */
    public function getSocialPlatforms()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
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
     * Returns true if the podcast has social platform links
     */
    public function getHasSocialPlatforms()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Podcast must be created before getting social platform.',
            );
        }
        foreach ($this->getSocialPlatforms() as $socialPlatform) {
            if ($socialPlatform->is_on_embeddable_player) {
                return true;
            }
        }
        return false;
    }

    /**
     * Returns the podcast's funding platform links
     *
     * @return \App\Entities\Platform[]
     */
    public function getFundingPlatforms()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
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
     * Returns true if the podcast has social platform links
     */
    public function getHasFundingPlatforms()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Podcast must be created before getting Funding platform.',
            );
        }
        foreach ($this->getFundingPlatforms() as $fundingPlatform) {
            if ($fundingPlatform->is_on_embeddable_player) {
                return true;
            }
        }
        return false;
    }

    public function getOtherCategories()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
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

    public function getOtherCategoriesIds()
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
     *
     * @param string $locationName
     *
     */
    public function setLocation($locationName = null)
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
     *
     */
    function getCustomRssString()
    {
        helper('rss');
        if (empty($this->attributes['custom_rss'])) {
            return '';
        } else {
            $xmlNode = (new \App\Libraries\SimpleRSSElement(
                '<?xml version="1.0" encoding="utf-8"?><rss xmlns:itunes="http://www.itunes.com/dtds/podcast-1.0.dtd" xmlns:podcast="https://github.com/Podcastindex-org/podcast-namespace/blob/main/docs/1.0.md" xmlns:content="http://purl.org/rss/1.0/modules/content/" version="2.0"/>',
            ))->addChild('channel');
            array_to_rss(
                [
                    'elements' => $this->custom_rss,
                ],
                $xmlNode,
            );
            return str_replace(
                ['<channel>', '</channel>'],
                '',
                $xmlNode->asXML(),
            );
        }
    }

    /**
     * Saves custom rss tag into json
     *
     * @param string $customRssString
     *
     */
    function setCustomRssString($customRssString)
    {
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
    }
}
