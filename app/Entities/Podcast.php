<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\CategoryModel;
use App\Models\EpisodeModel;
use App\Models\PlatformModel;
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
     * @var \CodeIgniter\Files\File
     */
    protected $image;

    /**
     * @var string
     */
    protected $image_media_path;

    /**
     * @var string
     */
    protected $image_url;

    /**
     * @var \App\Entities\Episode[]
     */
    protected $episodes;

    /**
     * @var \App\Entities\Category
     */
    protected $category;

    /**
     * @var \App\Entities\User[]
     */
    protected $contributors;

    /**
     * @var string
     */
    protected $description_html;

    /**
     * @var \App\Entities\Platform
     */
    protected $platforms;

    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'name' => 'string',
        'description' => 'string',
        'image_uri' => 'string',
        'language' => 'string',
        'category_id' => 'integer',
        'explicit' => 'boolean',
        'author' => '?string',
        'owner_name' => '?string',
        'owner_email' => '?string',
        'type' => 'string',
        'copyright' => '?string',
        'block' => 'boolean',
        'complete' => 'boolean',
        'episode_description_footer' => '?string',
        'custom_html_head' => '?string',
        'created_by' => 'integer',
        'updated_by' => 'integer',
        'imported_feed_url' => '?string',
    ];

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

            $this->attributes['image_uri'] = save_podcast_media(
                $image,
                $this->attributes['name'],
                'cover'
            );

            return $this;
        }
    }

    public function getImage()
    {
        return new \CodeIgniter\Files\File($this->getImageMediaPath());
    }

    public function getImageMediaPath()
    {
        return media_path($this->attributes['image_uri']);
    }

    public function getImageUrl()
    {
        return media_url($this->attributes['image_uri']);
    }

    public function getLink()
    {
        return base_url(route_to('podcast', $this->attributes['name']));
    }

    public function getFeedUrl()
    {
        return base_url(route_to('podcast_feed', $this->attributes['name']));
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
                'Podcast must be created before getting episodes.'
            );
        }

        if (empty($this->episodes)) {
            $this->episodes = (new EpisodeModel())->getPodcastEpisodes(
                $this->id,
                $this->type
            );
        }

        return $this->episodes;
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
                'Podcast must be created before getting category.'
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
                'Podcasts must be created before getting contributors.'
            );
        }

        if (empty($this->contributors)) {
            $this->contributors = (new UserModel())->getPodcastContributors(
                $this->id
            );
        }

        return $this->contributors;
    }

    public function getDescriptionHtml()
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return $converter->convertToHtml($this->attributes['description']);
    }

    public function setCreatedBy(\App\Entities\User $user)
    {
        $this->attributes['created_by'] = $user->id;

        return $this;
    }

    public function setUpdatedBy(\App\Entities\User $user)
    {
        $this->attributes['updated_by'] = $user->id;

        return $this;
    }

    /**
     * Returns the podcast's platform links
     *
     * @return \App\Entities\Platform[]
     */
    public function getPlatforms()
    {
        if (empty($this->id)) {
            throw new \RuntimeException(
                'Podcast must be created before getting platform links.'
            );
        }

        if (empty($this->platforms)) {
            $this->platforms = (new PlatformModel())->getPodcastPlatformLinks(
                $this->id
            );
        }

        return $this->platforms;
    }
}
