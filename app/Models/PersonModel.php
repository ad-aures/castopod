<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Person;
use CodeIgniter\Database\Query;
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
        'avatar_id',
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
            'required|regex_match[/^[a-z0-9\-]{1,32}$/]|is_unique[persons.unique_name,id,{id}]',
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
        if (! ($found = cache($cacheName))) {
            $found = $this->find($personId);

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getPerson(string $fullName): ?Person
    {
        return $this->where('full_name', $fullName)
            ->first();
    }

    /**
     * @return object[]
     */
    public function getPersonRoles(int $personId, int $podcastId, ?int $episodeId): array
    {
        if ($episodeId !== null) {
            $cacheName = "podcast#{$podcastId}_episode#{$episodeId}_person#{$personId}_roles";

            if (! ($found = cache($cacheName))) {
                $found = $this
                    ->select('episodes_persons.person_group as group, episodes_persons.person_role as role')
                    ->join('episodes_persons', 'persons.id = episodes_persons.person_id')
                    ->where('persons.id', $personId)
                    ->where('episodes_persons.episode_id', $episodeId)
                    ->get()
                    ->getResultObject();
            }
        } else {
            $cacheName = "podcast#{$podcastId}_person#{$personId}_roles";

            if (! ($found = cache($cacheName))) {
                $found = $this
                    ->select('podcasts_persons.person_group as group, podcasts_persons.person_role as role')
                    ->join('podcasts_persons', 'persons.id = podcasts_persons.person_id')
                    ->where('persons.id', $personId)
                    ->where('podcasts_persons.podcast_id', $podcastId)
                    ->get()
                    ->getResultObject();
            }
        }

        return $found;
    }

    /**
     * @return array<string, string>
     */
    public function getPersonOptions(): array
    {
        $options = [];

        if (! ($options = cache('person_options'))) {
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
            cache()
                ->save('person_options', $options, DECADE);
        }

        return $options;
    }

    /**
     * @return array<string, string>
     */
    public function getTaxonomyOptions(): array
    {
        $options = [];
        $locale = service('request')
            ->getLocale();
        $cacheName = "taxonomy_options_{$locale}";

        /** @var array<string, mixed> $personsTaxonomy */
        $personsTaxonomy = lang('PersonsTaxonomy.persons');

        if (! ($options = cache($cacheName))) {
            foreach ($personsTaxonomy as $group_key => $group) {
                foreach ($group['roles'] as $role_key => $role) {
                    $options[
                        "{$group_key},{$role_key}"
                    ] = "{$group['label']}  ›  {$role['label']}";
                }
            }

            cache()
                ->save($cacheName, $options, DECADE);
        }

        return $options;
    }

    public function addPerson(string $fullName, ?string $informationUrl, string $image): int | bool
    {
        $person = new Person([
            'full_name' => $fullName,
            'unique_name' => slugify($fullName),
            'information_url' => $informationUrl,
            'image' => download_file($image),
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
        if (! ($found = cache($cacheName))) {
            $found = $this
                ->select(
                    'persons.*, episodes_persons.podcast_id as podcast_id, episodes_persons.episode_id as episode_id'
                )
                ->distinct()
                ->join('episodes_persons', 'persons.id = episodes_persons.person_id')
                ->where('episodes_persons.episode_id', $episodeId)
                ->orderby('persons.full_name')
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    /**
     * @return Person[]
     */
    public function getPodcastPersons(int $podcastId): array
    {
        $cacheName = "podcast#{$podcastId}_persons";
        if (! ($found = cache($cacheName))) {
            $found = $this
                ->select('persons.*, podcasts_persons.podcast_id as podcast_id')
                ->distinct()
                ->join('podcasts_persons', 'persons.id=podcasts_persons.person_id')
                ->where('podcasts_persons.podcast_id', $podcastId)
                ->orderby('persons.full_name')
                ->findAll();

            cache()
                ->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function addEpisodePerson(
        int $podcastId,
        int $episodeId,
        int $personId,
        string $groupSlug,
        string $roleSlug
    ): bool | Query {
        return $this->db->table('episodes_persons')
            ->insert([
                'podcast_id' => $podcastId,
                'episode_id' => $episodeId,
                'person_id' => $personId,
                'person_group' => $groupSlug,
                'person_role' => $roleSlug,
            ]);
    }

    public function addPodcastPerson(
        int $podcastId,
        int $personId,
        string $groupSlug,
        string $roleSlug
    ): bool | Query {
        return $this->db->table('podcasts_persons')
            ->insert([
                'podcast_id' => $podcastId,
                'person_id' => $personId,
                'person_group' => $groupSlug,
                'person_role' => $roleSlug,
            ]);
    }

    /**
     * Add persons to podcast
     *
     * @param array<string> $personIds
     * @param array<string, string> $roles
     *
     * @return bool|int Number of rows inserted or FALSE on failure
     */
    public function addPodcastPersons(int $podcastId, array $personIds = [], array $roles = []): int | bool
    {
        if ($personIds === []) {
            return 0;
        }

        cache()
            ->delete("podcast#{$podcastId}_persons");
        (new PodcastModel())->clearCache([
            'id' => $podcastId,
        ]);

        $data = [];
        foreach ($personIds as $personId) {
            if ($roles === []) {
                $data[] = [
                    'podcast_id' => $podcastId,
                    'person_id' => $personId,
                ];
            }

            foreach ($roles as $role) {
                $groupRole = explode(',', $role);
                $data[] = [
                    'podcast_id' => $podcastId,
                    'person_id' => $personId,
                    'person_group' => $groupRole[0],
                    'person_role' => $groupRole[1],
                ];
            }
        }

        return $this->db->table('podcasts_persons')
            ->ignore(true)
            ->insertBatch($data);
    }

    /**
     * Add persons to episode
     *
     * @return string|bool Number of rows inserted or FALSE on failure
     */
    public function removePersonFromPodcast(int $podcastId, int $personId): string | bool
    {
        cache()->deleteMatching("podcast#{$podcastId}_person#{$personId}*");
        cache()
            ->delete("podcast#{$podcastId}_persons");
        (new PodcastModel())->clearCache([
            'id' => $podcastId,
        ]);

        return $this->db->table('podcasts_persons')
            ->delete([
                'podcast_id' => $podcastId,
                'person_id' => $personId,
            ]);
    }

    /**
     * Add persons to episode
     *
     * @param int[] $personIds
     * @param string[] $groupsRoles
     *
     * @return bool|int Number of rows inserted or FALSE on failure
     */
    public function addEpisodePersons(
        int $podcastId,
        int $episodeId,
        array $personIds,
        array $groupsRoles
    ): bool | int {
        if ($personIds !== []) {
            cache()
                ->delete("podcast#{$podcastId}_episode#{$episodeId}_persons");
            (new EpisodeModel())->clearCache([
                'id' => $episodeId,
            ]);

            $data = [];
            foreach ($personIds as $personId) {
                if ($groupsRoles !== []) {
                    foreach ($groupsRoles as $groupRole) {
                        $groupRole = explode(',', $groupRole);
                        $data[] = [
                            'podcast_id' => $podcastId,
                            'episode_id' => $episodeId,
                            'person_id' => $personId,
                            'person_group' => $groupRole[0],
                            'person_role' => $groupRole[1],
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
            return $this->db->table('episodes_persons')
                ->ignore(true)
                ->insertBatch($data);
        }
        return 0;
    }

    public function removePersonFromEpisode(int $podcastId, int $episodeId, int $personId): bool | string
    {
        cache()->deleteMatching("podcast#{$podcastId}_episode#{$episodeId}_person#{$personId}*");
        cache()
            ->delete("podcast#{$podcastId}_episode#{$episodeId}_persons");
        (new EpisodeModel())->clearCache([
            'id' => $episodeId,
        ]);

        return $this->db->table('episodes_persons')
            ->delete([
                'podcast_id' => $podcastId,
                'episode_id' => $episodeId,
                'person_id' => $personId,
            ]);
    }

    /**
     * @param mixed[] $data
     *
     * @return array<string, array<string|int, mixed>>
     */
    protected function clearCache(array $data): array
    {
        $personId = is_array($data['id']) ? $data['id'][0] : $data['id'];

        cache()
            ->delete('person_options');
        cache()
            ->delete("person#{$personId}");

        // clear cache for every credits page
        cache()
            ->deleteMatching('page_credits*');

        return $data;
    }
}
