<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use App\Entities\Person;
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
     * @var list<string>
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
     * @var class-string<Person>
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
        'full_name'   => 'required',
        'unique_name' => 'required|regex_match[/^[a-z0-9\-]{1,32}$/]|is_unique[persons.unique_name,id,{id}]',
        'created_by'  => 'required',
        'updated_by'  => 'required',
    ];

    /**
     * @var list<string>
     */
    protected $afterInsert = ['clearCache'];

    /**
     * clear cache before update if by any chance, the person name changes, so will the person link
     *
     * @var list<string>
     */
    protected $beforeUpdate = ['clearCache'];

    /**
     * @var list<string>
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
                $found = $this->builder()
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
                $found = $this->builder()
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
                static function (array $result, Person $person): array {
                    $result[] = [
                        'value' => $person->id,
                        'label' => $person->full_name,
                    ];
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
                    $options[] = [
                        'value' => sprintf('%s,%s', $group_key, $role_key),
                        'label' => sprintf('%s › %s', $group['label'], $role['label']),
                    ];
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
            'created_by'      => user_id(),
            'updated_by'      => user_id(),
            'full_name'       => $fullName,
            'unique_name'     => slugify($fullName),
            'information_url' => $informationUrl,
            'image'           => download_file($image),

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
            $this->builder()
                ->select(
                    'persons.*, episodes_persons.podcast_id as podcast_id, episodes_persons.episode_id as episode_id',
                )
                ->distinct()
                ->join('episodes_persons', 'persons.id = episodes_persons.person_id')
                ->where('episodes_persons.episode_id', $episodeId)
                ->orderby('persons.full_name');
            $found = $this->findAll();

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
            $this->builder()
                ->select('persons.*, podcasts_persons.podcast_id as podcast_id')
                ->distinct()
                ->join('podcasts_persons', 'persons.id=podcasts_persons.person_id')
                ->where('podcasts_persons.podcast_id', $podcastId)
                ->orderby('persons.full_name');
            $found = $this->findAll();

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
        string $roleSlug,
    ): bool {
        return $this->db->table('episodes_persons')
            ->insert([
                'podcast_id'   => $podcastId,
                'episode_id'   => $episodeId,
                'person_id'    => $personId,
                'person_group' => $groupSlug,
                'person_role'  => $roleSlug,
            ]);
    }

    public function addPodcastPerson(int $podcastId, int $personId, string $groupSlug, string $roleSlug): bool
    {
        return $this->db->table('podcasts_persons')
            ->ignore(true)
            ->insert([
                'podcast_id'   => $podcastId,
                'person_id'    => $personId,
                'person_group' => $groupSlug,
                'person_role'  => $roleSlug,
            ]);
    }

    /**
     * Add persons to podcast
     *
     * @param int[] $personIds
     * @param string[] $roles
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
        new PodcastModel()
            ->clearCache([
                'id' => $podcastId,
            ]);

        $data = [];
        foreach ($personIds as $personId) {
            if ($roles === []) {
                // add to default group (cast) and role (host), see https://podcastindex.org/namespace/1.0#person
                $data[] = [
                    'podcast_id'   => $podcastId,
                    'person_id'    => $personId,
                    'person_group' => 'cast',
                    'person_role'  => 'host',
                ];
            }

            foreach ($roles as $role) {
                $groupRole = explode(',', $role);
                $data[] = [
                    'podcast_id'   => $podcastId,
                    'person_id'    => $personId,
                    'person_group' => $groupRole[0],
                    'person_role'  => $groupRole[1],
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
        new PodcastModel()
            ->clearCache([
                'id' => $podcastId,
            ]);

        return $this->db->table('podcasts_persons')
            ->delete([
                'podcast_id' => $podcastId,
                'person_id'  => $personId,
            ]);
    }

    /**
     * Add persons to episode
     *
     * @param int[] $personIds
     * @param string[] $roles
     *
     * @return bool|int Number of rows inserted or FALSE on failure
     */
    public function addEpisodePersons(int $podcastId, int $episodeId, array $personIds, array $roles): bool | int
    {
        if ($personIds !== []) {
            cache()
                ->delete("podcast#{$podcastId}_episode#{$episodeId}_persons");
            new EpisodeModel()
                ->clearCache([
                    'id' => $episodeId,
                ]);

            $data = [];
            foreach ($personIds as $personId) {
                if ($roles === []) {
                    $data[] = [
                        'podcast_id'   => $podcastId,
                        'episode_id'   => $episodeId,
                        'person_id'    => $personId,
                        'person_group' => 'cast',
                        'person_role'  => 'host',
                    ];
                }

                foreach ($roles as $role) {
                    $groupRole = explode(',', $role);
                    $data[] = [
                        'podcast_id'   => $podcastId,
                        'episode_id'   => $episodeId,
                        'person_id'    => $personId,
                        'person_group' => $groupRole[0],
                        'person_role'  => $groupRole[1],
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
        new EpisodeModel()
            ->clearCache([
                'id' => $episodeId,
            ]);

        return $this->db->table('episodes_persons')
            ->delete([
                'podcast_id' => $podcastId,
                'episode_id' => $episodeId,
                'person_id'  => $personId,
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
