<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\PodcastModel;
use CodeIgniter\Entity;

class Episode extends Entity
{
    protected $link;
    protected $image_media_path;
    protected $image_url;
    protected $enclosure_media_path;
    protected $enclosure_url;
    protected $guid;
    protected $podcast;

    protected $casts = [
        'slug' => 'string',
        'title' => 'string',
        'enclosure_uri' => 'string',
        'enclosure_length' => 'integer',
        'enclosure_type' => 'string',
        'pub_date' => 'datetime',
        'description' => 'string',
        'duration' => 'integer',
        'image_uri' => 'string',
        'author_name' => '?string',
        'author_email' => '?string',
        'explicit' => 'boolean',
        'number' => 'integer',
        'season_number' => '?integer',
        'type' => 'string',
        'block' => 'boolean',
    ];

    public function getImageMediaPath()
    {
        return media_path($this->attributes['image_uri']);
    }

    public function getImageUrl()
    {
        return media_url($this->attributes['image_uri']);
    }

    public function getEnclosureMediaPath()
    {
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

    public function getLink()
    {
        return base_url(
            route_to(
                'episode_view',
                $this->getPodcast()->name,
                $this->attributes['slug']
            )
        );
    }

    public function getGuid()
    {
        return $this->getLink();
    }

    public function getPodcast()
    {
        $podcast_model = new PodcastModel();

        return $podcast_model->find($this->attributes['podcast_id']);
    }
}
