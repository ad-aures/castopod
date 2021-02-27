<?php

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

/**
 * Fetches persons from an episode
 *
 * @param array  $podcast_persons
 * @param array    &$persons
 */
function constructs_podcast_person_array($podcast_persons, &$persons)
{
    foreach ($podcast_persons as $podcastPerson) {
        if (array_key_exists($podcastPerson->person->id, $persons)) {
            $persons[$podcastPerson->person->id]['roles'] .=
                empty($podcastPerson->person_group) ||
                empty($podcastPerson->person_role)
                    ? ''
                    : (empty($persons[$podcastPerson->person->id]['roles'])
                            ? ''
                            : ', ') .
                        lang(
                            'PersonsTaxonomy.persons.' .
                                $podcastPerson->person_group .
                                '.roles.' .
                                $podcastPerson->person_role .
                                '.label'
                        );
        } else {
            $persons[$podcastPerson->person->id] = [
                'full_name' => $podcastPerson->person->full_name,
                'information_url' => $podcastPerson->person->information_url,
                'thumbnail_url' => $podcastPerson->person->image->thumbnail_url,
                'roles' =>
                    empty($podcastPerson->person_group) ||
                    empty($podcastPerson->person_role)
                        ? ''
                        : lang(
                            'PersonsTaxonomy.persons.' .
                                $podcastPerson->person_group .
                                '.roles.' .
                                $podcastPerson->person_role .
                                '.label'
                        ),
            ];
        }
    }
}

/**
 * Fetches persons from an episode
 *
 * @param array  $episode_persons
 * @param array  &$persons
 */
function construct_episode_person_array($episode_persons, &$persons)
{
    foreach ($episode_persons as $episodePerson) {
        if (array_key_exists($episodePerson->person->id, $persons)) {
            $persons[$episodePerson->person->id]['roles'] .=
                empty($episodePerson->person_group) ||
                empty($episodePerson->person_role)
                    ? ''
                    : (empty($persons[$episodePerson->person->id]['roles'])
                            ? ''
                            : ', ') .
                        lang(
                            'PersonsTaxonomy.persons.' .
                                $episodePerson->person_group .
                                '.roles.' .
                                $episodePerson->person_role .
                                '.label'
                        );
        } else {
            $persons[$episodePerson->person->id] = [
                'full_name' => $episodePerson->person->full_name,
                'information_url' => $episodePerson->person->information_url,
                'thumbnail_url' => $episodePerson->person->image->thumbnail_url,
                'roles' =>
                    empty($episodePerson->person_group) ||
                    empty($episodePerson->person_role)
                        ? ''
                        : lang(
                            'PersonsTaxonomy.persons.' .
                                $episodePerson->person_group .
                                '.roles.' .
                                $episodePerson->person_role .
                                '.label'
                        ),
            ];
        }
    }
}
