<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\PodcastModel;
use CodeIgniter\Entity;
use League\CommonMark\CommonMarkConverter;

class Episode extends Entity
{
    /**
     * @var \App\Entities\Podcast
     */
    protected $podcast;

    /**
     * @var string
     */
    protected $GUID;

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
     * @var \CodeIgniter\Files\File
     */
    protected $enclosure;

    /**
     * @var string
     */
    protected $enclosure_media_path;

    /**
     * @var string
     */
    protected $enclosure_url;

    /**
     * @var array
     */
    protected $enclosure_metadata;

    /**
     * @var string
     */
    protected $description_html;

    protected $casts = [
        'slug' => 'string',
        'title' => 'string',
        'enclosure_uri' => 'string',
        'pub_date' => 'datetime',
        'description' => 'string',
        'image_uri' => '?string',
        'author_name' => '?string',
        'author_email' => '?string',
        'explicit' => 'boolean',
        'number' => 'integer',
        'season_number' => '?integer',
        'type' => 'string',
        'block' => 'boolean',
    ];

    public function setImage(?\CodeIgniter\HTTP\Files\UploadedFile $image)
    {
        if (!empty($image) && $image->isValid()) {
            // check whether the user has inputted an image and store it
            $this->attributes['image_uri'] = save_podcast_media(
                $image,
                $this->getPodcast()->name,
                $this->attributes['slug']
            );
        } elseif (
            $APICdata = $this->getEnclosureMetadata()['attached_picture']
        ) {
            // if the user didn't input an image,
            // check if the uploaded audio file has an attached cover and store it
            $cover_image = new \CodeIgniter\Files\File('episode_cover');
            file_put_contents($cover_image, $APICdata);

            $this->attributes['image_uri'] = save_podcast_media(
                $cover_image,
                $this->getPodcast()->name,
                $this->attributes['slug']
            );
        }

        return $this;
    }

    public function getImage(): \CodeIgniter\Files\File
    {
        return new \CodeIgniter\Files\File($this->getImageMediaPath());
    }

    public function getImageMediaPath(): string
    {
        return media_path($this->attributes['image_uri']);
    }

    public function getImageUrl(): string
    {
        if ($image_uri = $this->attributes['image_uri']) {
            return media_url($image_uri);
        }
        return $this->getPodcast()->image_url;
    }

    public function setEnclosure(
        \CodeIgniter\HTTP\Files\UploadedFile $enclosure = null
    ) {
        if (!empty($enclosure) && $enclosure->isValid()) {
            helper('media');

            $this->attributes['enclosure_uri'] = save_podcast_media(
                $enclosure,
                $this->getPodcast()->name,
                $this->attributes['slug']
            );

            return $this;
        }
    }

    public function getEnclosure()
    {
        return new \CodeIgniter\Files\File($this->getEnclosureMediaPath());
    }

    public function getEnclosureMediaPath()
    {
        helper('media');

        return media_path($this->attributes['enclosure_uri']);
    }

    public function getEnclosureUrl()
    {
        return base_url(
            route_to(
                'analytics_hit',
                $this->attributes['podcast_id'],
                $this->attributes['id'],
                $this->attributes['enclosure_uri']
            )
        );
    }

    public function getEnclosureMetadata()
    {
        helper('id3');

        return get_file_tags($this->getEnclosure());
    }

    public function getLink()
    {
        return base_url(
            route_to(
                'episode',
                $this->getPodcast()->name,
                $this->attributes['slug']
            )
        );
    }

    public function getGUID()
    {
        return $this->getLink();
    }

    public function getPodcast()
    {
        return (new PodcastModel())->find($this->attributes['podcast_id']);
    }

    public function getDescriptionHtml()
    {
        $converter = new CommonMarkConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        if (
            $descriptionFooter = $this->getPodcast()->episode_description_footer
        ) {
            return $converter->convertToHtml($this->attributes['description']) .
                '<footer>' .
                $converter->convertToHtml($descriptionFooter) .
                '</footer>';
        }

        return $converter->convertToHtml($this->attributes['description']);
    }
}
