<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

use App\Entities\Person;
use App\Entities\EpisodePerson;
use App\Entities\PodcastPerson;

if (!function_exists('construct_person_array')) {
    /**
     * Fetches persons from an episode
     *
     * @param Person[]|PodcastPerson[]|EpisodePerson[] $persons
     */
    function construct_person_array(array $persons, array &$personsArray): void
    {
        foreach ($persons as $person) {
            if (array_key_exists($person->id, $personsArray)) {
                $personsArray[$person->id]['roles'] .=
                    empty($person->person_group) || empty($person->person_role)
                        ? ''
                        : (empty($personsArray[$person->id]['roles'])
                                ? ''
                                : ', ') .
                            lang(
                                'PersonsTaxonomy.persons.' .
                                    $person->person_group .
                                    '.roles.' .
                                    $person->person_role .
                                    '.label',
                            );
            } else {
                $personsArray[$person->person->id] = [
                    'full_name' => $person->person->full_name,
                    'information_url' => $person->person->information_url,
                    'thumbnail_url' => $person->person->image->thumbnail_url,
                    'roles' =>
                        empty($person->person_group) ||
                        empty($person->person_role)
                            ? ''
                            : lang(
                                'PersonsTaxonomy.persons.' .
                                    $person->person_group .
                                    '.roles.' .
                                    $person->person_role .
                                    '.label',
                            ),
                ];
            }
        }
    }
}
