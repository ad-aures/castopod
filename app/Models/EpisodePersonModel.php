<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Database\BaseResult;
use App\Entities\EpisodePerson;
use CodeIgniter\Model;

class EpisodePersonModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'episodes_persons';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'id',
        'podcast_id',
        'episode_id',
        'person_id',
        'person_group',
        'person_role',
    ];

    /**
     * @var string
     */
    protected $returnType = EpisodePerson::class;
    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = false;

    /**
     * @var array<string, string>
     */
    protected $validationRules = [
        'episode_id' => 'required',
        'person_id' => 'required',
    ];

    /**
     * @var string[]
     */
    protected $afterInsert = ['clearCache'];
    /**
     * @var string[]
     */
    protected $beforeDelete = ['clearCache'];

    public function getEpisodePersons($podcastId, $episodeId)
    {
        $cacheName = "podcast#{$podcastId}_episode#{$episodeId}_persons";
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
     *
     * @return bool|int Number of rows inserted or FALSE on failure
     */
    public function addEpisodePersons(
        $podcastId,
        int $episodeId,
        array $persons,
        array $groups_roles
    ) {
        if (!empty($persons)) {
            $this->clearCache([
                'episode_id' => $episodeId,
            ]);

            $data = [];
            foreach ($persons as $person) {
                if ($groups_roles !== []) {
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

    /**
     * @return bool|BaseResult
     */
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

    /**
     * @return array<string, array<string|int, mixed>>
     */
    protected function clearCache(array $data): array
    {
        if (isset($data['episode_id'])) {
            $episodeId = $data['episode_id'];
        } else {
            $person = (new EpisodePersonModel())->find(
                is_array($data['id']) ? $data['id']['id'] : $data['id'],
            );
            $episodeId = $person->episode_id;
        }

        (new EpisodeModel())->clearCache(['id' => $episodeId]);

        return $data;
    }
}
