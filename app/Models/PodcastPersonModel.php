<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class PodcastPersonModel extends Model
{
    protected $table = 'podcasts_persons';
    protected $primaryKey = 'id';

    protected $allowedFields = [
        'id',
        'podcast_id',
        'person_id',
        'person_group',
        'person_role',
    ];

    protected $returnType = \App\Entities\PodcastPerson::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = false;

    protected $validationRules = [
        'podcast_id' => 'required',
        'person_id' => 'required',
    ];
    protected $validationMessages = [];

    protected $afterInsert = ['clearCache'];
    protected $beforeDelete = ['clearCache'];

    public function getPersonsByPodcastId($podcastId)
    {
        if (!($found = cache("podcast{$podcastId}_persons"))) {
            $found = $this->select('podcasts_persons.*')
                ->where('podcast_id', $podcastId)
                ->join(
                    'persons',
                    'person_id=persons.id'
                )
                ->orderby('full_name')
                ->findAll();

            cache()->save("podcast{$podcastId}_persons", $found, DECADE);
        }
        return $found;
    }

    /**
     * Add persons to podcast
     *
     * @param int $podcastId
     * @param array $persons
     * @param array $groups_roles
     *
     * @return integer Number of rows inserted or FALSE on failure
     */
    public function addPodcastPersons($podcastId, $persons, $groups_roles)
    {
        if (!empty($persons)) {
            $this->clearCache(['id' => ['podcast_id' => $podcastId]]);
            $data = [];
            foreach ($persons as $person) {
                if ($groups_roles) {
                    foreach ($groups_roles as $group_role) {
                        $group_role = explode(',', $group_role);
                        $data[] = [
                            'podcast_id' => $podcastId,
                            'person_id' => $person,
                            'person_group' => $group_role[0],
                            'person_role' => $group_role[1],
                        ];
                    }
                } else {
                    $data[] = [
                        'podcast_id' => $podcastId,
                        'person_id' => $person,
                    ];
                }
            }
            return $this->insertBatch($data);
        }
        return 0;
    }

    public function removePodcastPersons($podcastId, $podcastPersonId)
    {
        return $this->delete([
            'podcast_id' => $podcastId,
            'id' => $podcastPersonId,
        ]);
    }

    protected function clearCache(array $data)
    {
        $podcastId = null;
        if (isset($data['id']['podcast_id'])) {
            $podcastId = $data['id']['podcast_id'];
        } else {
            $person = (new PodcastPersonModel())->find(
                is_array($data['id']) ? $data['id']['id'] : $data['id']
            );
            $podcastId = $person->podcast_id;
        }

        cache()->delete("podcast{$podcastId}_persons");
        (new PodcastModel())->clearCache(['id' => $podcastId]);

        return $data;
    }
}
