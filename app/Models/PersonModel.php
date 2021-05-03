<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Models;

use CodeIgniter\Model;

class PersonModel extends Model
{
    protected $table = 'persons';
    protected $primaryKey = 'id';

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

    protected $returnType = \App\Entities\Person::class;
    protected $useSoftDeletes = false;

    protected $useTimestamps = true;

    protected $validationRules = [
        'full_name' => 'required',
        'unique_name' =>
            'required|regex_match[/^[a-z0-9\-]{1,191}$/]|is_unique[persons.unique_name,id,{id}]',
        'image_path' => 'required',
        'created_by' => 'required',
        'updated_by' => 'required',
    ];
    protected $validationMessages = [];

    // clear cache before update if by any chance, the person name changes, so will the person link
    protected $afterInsert = ['clearCache'];
    protected $beforeUpdate = ['clearCache'];
    protected $beforeDelete = ['clearCache'];

    public function getPersonById($personId)
    {
        $cacheName = "person#{$personId}";
        if (!($found = cache($cacheName))) {
            $found = $this->find($personId);

            cache()->save($cacheName, $found, DECADE);
        }

        return $found;
    }

    public function getPerson($fullName)
    {
        return $this->where('full_name', $fullName)->first();
    }

    public function createPerson($fullName, $informationUrl, $image)
    {
        $person = new \App\Entities\Person([
            'full_name' => $fullName,
            'unique_name' => slugify($fullName),
            'information_url' => $informationUrl,
            'image' => download_file($image),
            'created_by' => user()->id,
            'updated_by' => user()->id,
        ]);
        return $this->insert($person);
    }

    public function getPersonOptions()
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

    public function getTaxonomyOptions()
    {
        $options = [];
        $locale = service('request')->getLocale();
        $cacheName = "taxonomy_options_{$locale}";
        if (!($options = cache($cacheName))) {
            foreach (lang('PersonsTaxonomy.persons') as $group_key => $group) {
                foreach ($group['roles'] as $role_key => $role) {
                    $options[
                        "$group_key,$role_key"
                    ] = "{$group['label']}  ▸  {$role['label']}";
                }
            }

            cache()->save($cacheName, $options, DECADE);
        }

        return $options;
    }

    protected function clearCache(array $data)
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
