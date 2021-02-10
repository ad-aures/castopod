<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;

class Podcast extends BaseController
{
    /**
     * @var \App\Entities\Podcast|null
     */
    protected $podcast;

    public function _remap($method, ...$params)
    {
        if (count($params) > 0) {
            if (
                !($this->podcast = (new PodcastModel())->getPodcastByName(
                    $params[0]
                ))
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
        }

        return $this->$method();
    }

    public function index()
    {
        self::triggerWebpageHit($this->podcast->id);

        $yearQuery = $this->request->getGet('year');
        $seasonQuery = $this->request->getGet('season');

        if (!$yearQuery and !$seasonQuery) {
            $defaultQuery = (new EpisodeModel())->getDefaultQuery(
                $this->podcast->id
            );
            if ($defaultQuery['type'] == 'season') {
                $seasonQuery = $defaultQuery['data']['season_number'];
            } elseif ($defaultQuery['type'] == 'year') {
                $yearQuery = $defaultQuery['data']['year'];
            }
        }

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "podcast{$this->podcast->id}",
                $yearQuery,
                $seasonQuery ? 'season' . $seasonQuery : null,
                service('request')->getLocale(),
            ])
        );

        if (!($found = cache($cacheName))) {
            // Build navigation array
            $episodeModel = new EpisodeModel();
            $years = $episodeModel->getYears($this->podcast->id);
            $seasons = $episodeModel->getSeasons($this->podcast->id);

            $episodesNavigation = [];
            $activeQuery = null;
            foreach ($years as $year) {
                $isActive = $yearQuery == $year['year'];
                if ($isActive) {
                    $activeQuery = ['type' => 'year', 'value' => $year['year']];
                }

                array_push($episodesNavigation, [
                    'label' => $year['year'],
                    'number_of_episodes' => $year['number_of_episodes'],
                    'route' =>
                        route_to('podcast', $this->podcast->name) .
                        '?year=' .
                        $year['year'],
                    'is_active' => $isActive,
                ]);
            }

            foreach ($seasons as $season) {
                $isActive = $seasonQuery == $season['season_number'];
                if ($isActive) {
                    $activeQuery = [
                        'type' => 'season',
                        'value' => $season['season_number'],
                    ];
                }

                array_push($episodesNavigation, [
                    'label' => lang('Podcast.season', [
                        'seasonNumber' => $season['season_number'],
                    ]),
                    'number_of_episodes' => $season['number_of_episodes'],
                    'route' =>
                        route_to('podcast', $this->podcast->name) .
                        '?season=' .
                        $season['season_number'],
                    'is_active' => $isActive,
                ]);
            }

            $persons = [];
            foreach ($this->podcast->podcast_persons as $podcastPerson) {
                if (array_key_exists($podcastPerson->person->id, $persons)) {
                    $persons[$podcastPerson->person->id]['roles'] .=
                        empty($podcastPerson->person_group) ||
                        empty($podcastPerson->person_role)
                            ? ''
                            : (empty(
                                    $persons[$podcastPerson->person->id][
                                        'roles'
                                    ]
                                )
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
                        'information_url' =>
                            $podcastPerson->person->information_url,
                        'thumbnail_url' =>
                            $podcastPerson->person->image->thumbnail_url,
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

            $data = [
                'podcast' => $this->podcast,
                'episodesNav' => $episodesNavigation,
                'activeQuery' => $activeQuery,
                'episodes' => $episodeModel->getPodcastEpisodes(
                    $this->podcast->id,
                    $this->podcast->type,
                    $yearQuery,
                    $seasonQuery
                ),
                'personArray' => $persons,
            ];

            $secondsToNextUnpublishedEpisode = $episodeModel->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id
            );

            return view('podcast', $data, [
                'cache' => $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $found;
    }
}
