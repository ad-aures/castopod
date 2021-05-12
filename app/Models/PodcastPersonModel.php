<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Database\BaseResult;
use App\Entities\PodcastPerson;
use CodeIgniter\Model;

class PodcastPersonModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'podcasts_persons';
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
        'person_id',
        'person_group',
        'person_role',
    ];

    /**
     * @var string
     */
    protected $returnType = PodcastPerson::class;
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
        'podcast_id' => 'required',
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

    /**
     * @return PodcastPerson[]
     */
    public function getPodcastPersons(int $podcastId): array
    {
        $cacheName = "podcast#{$podcastId}_persons";
        if (!($found = cache($cacheName))) {
            $found = $this->select('podcasts_persons.*')
                ->where('podcast_id', $podcastId)
                ->join('persons', 'person_id=persons.id')
                ->orderby('full_name')
                ->findAll();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * Add persons to podcast
     *
     * @param array<string> $persons
     * @param array<string, string> $groupsRoles
     *
     * @return bool|int Number of rows inserted or FALSE on failure
     */
    public function addPodcastPersons(
        int $podcastId,
        array $persons = [],
        array $groupsRoles = []
    ) {
        if ($persons === []) {
            return 0;
        }

        $this->clearCache(['podcast_id' => $podcastId]);
        $data = [];
        foreach ($persons as $person) {
            if ($groupsRoles === []) {
                $data[] = [
                    'podcast_id' => $podcastId,
                    'person_id' => $person,
                ];
            }

            foreach ($groupsRoles as $group_role) {
                $group_role = explode(',', $group_role);
                $data[] = [
                    'podcast_id' => $podcastId,
                    'person_id' => $person,
                    'person_group' => $group_role[0],
                    'person_role' => $group_role[1],
                ];
            }
        }

        return $this->insertBatch($data);
    }

    /**
     * @return bool|BaseResult
     */
    public function removePodcastPersons($podcastId, $podcastPersonId)
    {
        return $this->delete([
            'podcast_id' => $podcastId,
            'id' => $podcastPersonId,
        ]);
    }

    /**
     * @return array<string, array<string|int, mixed>>
     */
    protected function clearCache(array $data): array
    {
        if (isset($data['podcast_id'])) {
            $podcastId = $data['podcast_id'];
        } else {
            $person = (new PodcastPersonModel())->find(
                is_array($data['id']) ? $data['id']['id'] : $data['id'],
            );
            $podcastId = $person->podcast_id;
        }

        cache()->delete("podcast#{$podcastId}_persons");
        (new PodcastModel())->clearCache(['id' => $podcastId]);

        return $data;
    }
}
