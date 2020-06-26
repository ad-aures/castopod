<?php
/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Entities;

use App\Models\EpisodeModel;
use CodeIgniter\Entity;

class Podcast extends Entity
{
    protected $link;
    protected $image_url;
    protected $episodes;

    protected $casts = [
        'id' => 'integer',
        'title' => 'string',
        'name' => 'string',
        'description' => 'string',
        'image_uri' => 'string',
        'language' => 'string',
        'category' => 'string',
        'explicit' => 'boolean',
        'author_name' => '?string',
        'author_email' => '?string',
        'owner_name' => '?string',
        'owner_email' => '?string',
        'type' => 'string',
        'copyright' => '?string',
        'block' => 'boolean',
        'complete' => 'boolean',
        'episode_description_footer' => '?string',
        'custom_html_head' => '?string',
    ];

    public function getImageUrl()
    {
        return media_url($this->attributes['image_uri']);
    }

    public function getLink()
    {
        return base_url(route_to('podcast_view', $this->attributes['name']));
    }

    public function getFeedUrl()
    {
        return base_url(route_to('podcast_feed', $this->attributes['name']));
    }

    public function getEpisodes()
    {
        $episode_model = new EpisodeModel();

        return $episode_model
            ->where('podcast_id', $this->attributes['id'])
            ->findAll();
    }
}
