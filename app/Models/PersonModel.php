<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Image;
use App\Entities\Person;
use CodeIgniter\Database\BaseResult;
use CodeIgniter\Model;

class PersonModel extends Model
{
    /**
     * @var string
     */
    protected $table = 'persons';
    /**
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * @var string[]
     */
    protected $allowedFields = [
        'id',
        'full_name',
        'unique_name',
        'information_url',
        'image_path',
        'image_mimetype',
        'created_by',
        'updated_by',
    ];

    /**
     * @var string
     */
    protected $returnType = Person::class;
    /**
     * @var bool
     */
    protected $useSoftDeletes = false;

    /**
     * @var bool
     */
    protected $useTimestamps = true;

    /**
     * @var array<string, string>
     */
    protected $validationRules = [
        'full_name' => 'required',
        'unique_name' =>
            'required|regex_match[/^[a-z0-9\-]{1,191}$/]|is_unique[persons.unique_name,id,{id}]',
        'image_path' => 'required',
        'created_by' => 'required',
        'updated_by' => 'required',
    ];

    /**
     * @var string[]
     */
    protected $afterInsert = ['clearCache'];

    /**
     * clear cache before update if by any chance, the person name changes, so will the person link
     *
     * @var string[]
     */
    protected $beforeUpdate = ['clearCache'];

    /**
     * @var string[]
     */
    protected $beforeDelete = ['clearCache'];

    public function getPersonById(int $personId): ?Person
    {
        $cacheName = "person#{$personId}";
        if (!($found = cache($cacheName))) {
            $found = $this->find($personId);

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getPerson(string $fullName): ?Person
    {
        return $this->where('full_name', $fullName)->first();
    }

    public function addPerson(
        string $fullName,
        ?string $informationUrl,
        string $image
    ): int|bool {
        $person = new Person([
            'full_name' => $fullName,
            'unique_name' => slugify($fullName),
            'information_url' => $informationUrl,
            'image' => new Image(download_file($image)),
            'created_by' => user_id(),
            'updated_by' => user_id(),
        ]);

        return $this->insert($person);
    }

    /**
     * @return Person[]
     */
    public function getEpisodePersons(int $podcastId, int $episodeId): array
    {
        $cacheName = "podcast#{$podcastId}_episode#{$episodeId}_persons";
        if (!($found = cache($cacheName))) {
            $found = $this->db
                ->table('episodes_persons')
                ->select('episodes_persons.*')
                ->where('episode_id', $episodeId)
                ->join('persons', 'person_id=persons.id')
                ->orderby('full_name')
                ->findAll();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * @return Person[]
     */
    public function getPodcastPersons(int $podcastId): array
    {
        $cacheName = "podcast#{$podcastId}_persons";
        if (!($found = cache($cacheName))) {
            $found = $this->db
                ->table('podcasts_persons')
                ->select('podcasts_persons.*')
                ->where('podcast_id', $podcastId)
                ->join('persons', 'person_id=persons.id')
                ->orderby('full_name')
                ->findAll();

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function addEpisodePerson(
        int $podcastId,
        int $episodeId,
        int $personId,
        string $group,
        string $role
    ): int|bool {
        return $this->db->table('episodes_persons')->insert([
            'podcast_id' => $podcastId,
            'episode_id' => $episodeId,
            'person_id' => $personId,
            'person_group' => $group,
            'person_role' => $role,
        ]);
    }

    public function addPodcastPerson(
        int $podcastId,
        int $personId,
        string $group,
        string $role
    ): int|bool {
        return $this->db->table('podcasts_persons')->insert([
            'podcast_id' => $podcastId,
            'person_id' => $personId,
            'person_group' => $group,
            'person_role' => $role,
        ]);
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
    ): int|bool {
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
     * Add persons to episode
     *
     * @return BaseResult|bool Number of rows inserted or FALSE on failure
     */
    public function removePodcastPersons(int $podcastId, int $personId): BaseResult|bool
    {
        return $this->delete([
            'id' => $personId,
            'podcast_id' => $podcastId,
        ]);
    }

    /**
     * Add persons to episode
     *
     * @param int[] $personIds
     * @param string[] $groups_roles
     * 
     * @return bool|int Number of rows inserted or FALSE on failure
     */
    public function addEpisodePersons(
        int $podcastId,
        int $episodeId,
        array $personIds,
        array $groups_roles
    ): bool|int {
        if (!empty($personIds)) {
            $this->clearCache([
                'episode_id' => $episodeId,
            ]);

            $data = [];
            foreach ($personIds as $personId) {
                if ($groups_roles !== []) {
                    foreach ($groups_roles as $group_role) {
                        $group_role = explode(',', $group_role);
                        $data[] = [
                            'podcast_id' => $podcastId,
                            'episode_id' => $episodeId,
                            'person_id' => $personId,
                            'person_group' => $group_role[0],
                            'person_role' => $group_role[1],
                        ];
                    }
                } else {
                    $data[] = [
                        'podcast_id' => $podcastId,
                        'episode_id' => $episodeId,
                        'person_id' => $personId,
                    ];
                }
            }
            return $this->insertBatch($data);
        }
        return 0;
    }

    /**
     * @return BaseResult|bool
     */
    public function removeEpisodePersons(
        int $podcastId,
        int $episodeId,
        int $personId
    ): BaseResult|bool {
        return $this->delete([
            'podcast_id' => $podcastId,
            'episode_id' => $episodeId,
            'id' => $personId,
        ]);
    }

    /**
     * @return array<string, string> 
     */
    public function getPersonOptions(): array
    {
        $options = [];

        if (!($options = cache('person_options'))) {
            $options = array_reduce(
                $this->select('`id`, `full_name`')
                    ->orderBy('`full_name`', 'ASC')
                    ->findAll(),
                function ($result, $person) {
                    $result[$person->id] = $person->full_name;
                    return $result;
                },
                [],
            );
            cache()->save('person_options', $options, DECADE);
        }

        return $options;
    }

    /**
     * @return array<string, string> 
     */
    public function getTaxonomyOptions(): array
    {
        $options = [];
        $locale = service('request')->getLocale();
        $cacheName = "taxonomy_options_{$locale}";

        /** @var array<string, array> */
        $personsTaxonomy = lang('PersonsTaxonomy.persons');

        if (!($options = cache($cacheName))) {
            foreach ($personsTaxonomy as $group_key => $group) {
                foreach ($group['roles'] as $role_key => $role) {
                    $options[
                        "{$group_key},{$role_key}"
                    ] = "{$group['label']}  ▸  {$role['label']}";
                }
            }

            cache()->save($cacheName, $options, DECADE);
        }

        return $options;
    }

    /**
     * @param mixed[] $data
     * 
     * @return array<string, array<string|int, mixed>>
     */
    protected function clearCache(array $data): array
    {
        $person = (new PersonModel())->find(
            is_array($data['id']) ? $data['id'][0] : $data['id'],
        );

        cache()->delete('person_options');
        cache()->delete("person#{$person->id}");

        // clear cache for every credits page
        cache()->deleteMatching('page_credits_*');

        return $data;
    }
}
