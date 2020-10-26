<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\PodcastModel;
use CodeIgniter\Entity;
use CodeIgniter\I18n\Time;
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
    protected $link;

    /**
     * @var \App\Entities\Image
     */
    protected $image;

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
     * @var string
     */
    protected $enclosure_web_url;

    /**
     * @var string
     */
    protected $description_html;

    /**
     * @var boolean
     */
    protected $is_published;

    protected $dates = [
        'published_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $casts = [
        'guid' => 'string',
        'slug' => 'string',
        'title' => 'string',
        'enclosure_uri' => 'string',
        'enclosure_duration' => 'integer',
        'enclosure_mimetype' => 'string',
        'enclosure_filesize' => 'integer',
        'enclosure_headersize' => 'integer',
        'description' => 'string',
        'image_uri' => '?string',
        'parental_advisory' => '?string',
        'number' => '?integer',
        'season_number' => '?integer',
        'type' => 'string',
        'block' => 'boolean',
        'created_by' => 'integer',
        'updated_by' => 'integer',
    ];

    /**
     * Saves an episode image
     *
     * @param \CodeIgniter\HTTP\Files\UploadedFile|\CodeIgniter\Files\File $image
     *
     */
    public function setImage($image)
    {
        if (
            !empty($image) &&
            (!($image instanceof \CodeIgniter\HTTP\Files\UploadedFile) ||
                $image->isValid())
        ) {
            helper('media');

            // check whether the user has inputted an image and store it
            $this->attributes['image_uri'] = save_podcast_media(
                $image,
                $this->getPodcast()->name,
                $this->attributes['slug']
            );

            $this->image = new \App\Entities\Image(
                $this->attributes['image_uri']
            );
            $this->image->saveSizes();
        }

        return $this;
    }

    public function getImage(): \App\Entities\Image
    {
        if ($image_uri = $this->attributes['image_uri']) {
            return new \App\Entities\Image($image_uri);
        }
        return $this->getPodcast()->image;
    }

    /**
     * Saves an enclosure
     *
     * @param \CodeIgniter\HTTP\Files\UploadedFile|\CodeIgniter\Files\File $enclosure
     *
     */
    public function setEnclosure($enclosure = null)
    {
        if (
            !empty($enclosure) &&
            (!($enclosure instanceof \CodeIgniter\HTTP\Files\UploadedFile) ||
                $enclosure->isValid())
        ) {
            helper(['media', 'id3']);

            $enclosure_metadata = get_file_tags($enclosure);

            $this->attributes['enclosure_uri'] = save_podcast_media(
                $enclosure,
                $this->getPodcast()->name,
                $this->attributes['slug']
            );
            $this->attributes['enclosure_duration'] = round(
                $enclosure_metadata['playtime_seconds']
            );
            $this->attributes['enclosure_mimetype'] =
                $enclosure_metadata['mime_type'];
            $this->attributes['enclosure_filesize'] =
                $enclosure_metadata['filesize'];
            $this->attributes['enclosure_headersize'] =
                $enclosure_metadata['avdataoffset'];

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
                // bytes_threshold: number of bytes that must be downloaded for an episode to be counted in download analytics
                // - if file is shorter than 60sec, then it's enclosure_filesize
                // - if file is longer than 60 seconds then it's enclosure_headersize + 60 seconds
                $this->attributes['enclosure_duration'] <= 60
                    ? $this->attributes['enclosure_filesize']
                    : $this->attributes['enclosure_headersize'] +
                        floor(
                            (($this->attributes['enclosure_filesize'] -
                                $this->attributes['enclosure_headersize']) /
                                $this->attributes['enclosure_duration']) *
                                60
                        ),
                $this->attributes['enclosure_filesize'],
                $this->attributes['enclosure_uri']
            )
        );
    }

    public function getEnclosureWebUrl()
    {
        return $this->getEnclosureUrl() . '?_from=-+Website+-';
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

    public function setGuid(string $guid)
    {
        return $this->attributes['guid'] = empty($guid)
            ? $this->getLink()
            : $guid;
    }

    public function getPodcast()
    {
        return (new PodcastModel())->getPodcastById(
            $this->attributes['podcast_id']
        );
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

    public function getIsPublished()
    {
        if ($this->is_published) {
            return $this->is_published;
        }

        helper('date');

        $this->is_published = $this->published_at->isBefore(Time::now());

        return $this->is_published;
    }
}
