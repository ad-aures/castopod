<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class EpisodePersonModel extends Model
{
    protected $table = 'episodes_persons';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'podcast_id',
        'episode_id',
        'person_id',
        'person_group',
        'person_role',
    ];

    protected $returnType = \App\Entities\EpisodePerson::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    protected $validationRules = [
        'episode_id' => 'required',
        'person_id' => 'required',
    ];
    protected $validationMessages = [];

    protected $afterInsert = ['clearCache'];
    protected $beforeDelete = ['clearCache'];

    public function getEpisodePersons($episodeId)
    {
        $cacheName = "podcast_episode#{$episodeId}_persons";
        if (!($found = cache($cacheName))) {
            $found = $this->select('episodes_persons.*')
                ->where('episode_id', $episodeId)
                ->join('persons', 'person_id=persons.id')
                ->orderby('full_name')
                ->findAll();

            cache()->save($cacheName, $found, DECADE);
        }
        return $found;
    }

    /**
     * Add persons to episode
     *
     * @param int podcastId
     * @param int $episodeId
     * @param array $persons
     * @param array $groups_roles
     *
     * @return integer|false Number of rows inserted or FALSE on failure
     */
    public function addEpisodePersons(
        $podcastId,
        $episodeId,
        $persons,
        $groups_roles
    ) {
        if (!empty($persons)) {
            $this->clearCache([
                'episode_id' => $episodeId,
            ]);

            $data = [];
            foreach ($persons as $person) {
                if ($groups_roles) {
                    foreach ($groups_roles as $group_role) {
                        $group_role = explode(',', $group_role);
                        $data[] = [
                            'podcast_id' => $podcastId,
                            'episode_id' => $episodeId,
                            'person_id' => $person,
                            'person_group' => $group_role[0],
                            'person_role' => $group_role[1],
                        ];
                    }
                } else {
                    $data[] = [
                        'podcast_id' => $podcastId,
                        'episode_id' => $episodeId,
                        'person_id' => $person,
                    ];
                }
            }
            return $this->insertBatch($data);
        }
        return 0;
    }

    public function removeEpisodePersons(
        $podcastId,
        $episodeId,
        $episodePersonId
    ) {
        return $this->delete([
            'podcast_id' => $podcastId,
            'episode_id' => $episodeId,
            'id' => $episodePersonId,
        ]);
    }

    protected function clearCache(array $data)
    {
        $episodeId = null;
        if (isset($data['episode_id'])) {
            $episodeId = $data['episode_id'];
        } else {
            $person = (new EpisodePersonModel())->find(
                is_array($data['id']) ? $data['id']['id'] : $data['id'],
            );
            $episodeId = $person->episode_id;
        }

        cache()->delete("podcast_episode#{$episodeId}_persons");
        (new EpisodeModel())->clearCache(['id' => $episodeId]);

        return $data;
    }
}
