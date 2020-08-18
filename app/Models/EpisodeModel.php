<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class EpisodeModel extends Model
{
    protected $table = 'episodes';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'podcast_id',
        'title',
        'slug',
        'enclosure_uri',
        'description',
        'image_uri',
        'explicit',
        'number',
        'season_number',
        'type',
        'block',
        'published_at',
        'created_by',
        'updated_by',
    ];

    protected $returnType = \App\Entities\Episode::class;

    protected $useSoftDeletes = true;
    protected $useTimestamps = true;

    protected $validationRules = [
        'podcast_id' => 'required',
        'title' => 'required',
        'slug' => 'required|regex_match[/^[a-zA-Z0-9\-]{1,191}$/]',
        'enclosure_uri' => 'required',
        'description' => 'required',
        'image_uri' => 'required',
        'number' => 'required|is_natural_no_zero',
        'season_number' => 'required|is_natural_no_zero',
        'type' => 'required',
        'published_at' => 'valid_date|permit_empty',
        'created_by' => 'required',
        'updated_by' => 'required',
    ];
    protected $validationMessages = [];

    protected $afterInsert = ['writeEnclosureMetadata'];
    // clear cache beforeUpdate because if slug changes, so will the episode link
    protected $beforeUpdate = ['clearCache'];
    protected $afterUpdate = ['writeEnclosureMetadata'];
    protected $beforeDelete = ['clearCache'];

    protected function writeEnclosureMetadata(array $data)
    {
        helper('id3');

        $episode = (new EpisodeModel())->find(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        write_enclosure_tags($episode);

        return $data;
    }

    protected function clearCache(array $data)
    {
        $episode = (new EpisodeModel())->find(
            is_array($data['id']) ? $data['id'][0] : $data['id']
        );

        // delete cache for rss feed, podcast and episode pages
        cache()->delete(md5($episode->podcast->feed_url));
        cache()->delete(md5($episode->podcast->link));
        cache()->delete(md5($episode->link));

        // delete model requests cache
        cache()->delete("{$episode->podcast_id}_episodes");

        return $data;
    }

    /**
     * Gets all episodes for a podcast
     *
     * @param int $podcastId
     *
     * @return \App\Entities\Episode[]
     */
    public function getPodcastEpisodes(int $podcastId): array
    {
        if (!($found = cache("{$podcastId}_episodes"))) {
            $found = $this->where('podcast_id', $podcastId)->findAll();

            cache()->save("{$podcastId}_episodes", $found, 300);
        }

        return $found;
    }
}
