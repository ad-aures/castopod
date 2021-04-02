<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * Fetches persons from an episode
 *
 * @param array  $persons
 * @param array    &$personsArray
 */
function construct_person_array($persons, &$personsArray)
{
    foreach ($persons as $person) {
        if (array_key_exists($person->person->id, $personsArray)) {
            $personsArray[$person->person->id]['roles'] .=
                empty($person->person_group) || empty($person->person_role)
                    ? ''
                    : (empty($personsArray[$person->person->id]['roles'])
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
                    empty($person->person_group) || empty($person->person_role)
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
