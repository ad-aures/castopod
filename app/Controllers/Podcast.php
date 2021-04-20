<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use App\Models\NoteModel;

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
                    $params[0],
                ))
            ) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            }
            unset($params[0]);
        }

        return $this->$method(...$params);
    }

    public function activity()
    {
        self::triggerWebpageHit($this->podcast->id);

        helper('persons');
        $persons = [];
        construct_person_array($this->podcast->persons, $persons);

        $data = [
            'podcast' => $this->podcast,
            'notes' => (new NoteModel())->getActorNotes(
                $this->podcast->actor_id,
            ),
            'persons' => $persons,
        ];

        // if user is logged in then send to the authenticated activity view
        if (can_user_interact()) {
            helper('form');
            return view('podcast/activity_authenticated', $data);
        } else {
            return view('podcast/activity', $data);
        }
    }

    public function episodes()
    {
        self::triggerWebpageHit($this->podcast->id);

        $yearQuery = $this->request->getGet('year');
        $seasonQuery = $this->request->getGet('season');

        if (!$yearQuery and !$seasonQuery) {
            $defaultQuery = (new PodcastModel())->getDefaultQuery(
                $this->podcast->id,
            );
            if ($defaultQuery) {
                if ($defaultQuery['type'] == 'season') {
                    $seasonQuery = $defaultQuery['data']['season_number'];
                } elseif ($defaultQuery['type'] == 'year') {
                    $yearQuery = $defaultQuery['data']['year'];
                }
            }
        }

        $cacheName = implode(
            '_',
            array_filter([
                'page',
                "podcast#{$this->podcast->id}",
                $yearQuery ? 'year' . $yearQuery : null,
                $seasonQuery ? 'season' . $seasonQuery : null,
                service('request')->getLocale(),
                can_user_interact() ? '_interact' : '',
            ]),
        );

        if (!($found = cache($cacheName))) {
            // Build navigation array
            $podcastModel = new PodcastModel();
            $years = $podcastModel->getYears($this->podcast->id);
            $seasons = $podcastModel->getSeasons($this->podcast->id);

            $episodesNavigation = [];
            $activeQuery = null;
            foreach ($years as $year) {
                $isActive = $yearQuery == $year['year'];
                if ($isActive) {
                    $activeQuery = [
                        'type' => 'year',
                        'value' => $year['year'],
                        'label' => $year['year'],
                        'number_of_episodes' => $year['number_of_episodes'],
                    ];
                }

                array_push($episodesNavigation, [
                    'label' => $year['year'],
                    'number_of_episodes' => $year['number_of_episodes'],
                    'route' =>
                        route_to('podcast-episodes', $this->podcast->name) .
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
                        'label' => lang('Podcast.season', [
                            'seasonNumber' => $season['season_number'],
                        ]),
                        'number_of_episodes' => $season['number_of_episodes'],
                    ];
                }

                array_push($episodesNavigation, [
                    'label' => lang('Podcast.season', [
                        'seasonNumber' => $season['season_number'],
                    ]),
                    'number_of_episodes' => $season['number_of_episodes'],
                    'route' =>
                        route_to('podcast-episodes', $this->podcast->name) .
                        '?season=' .
                        $season['season_number'],
                    'is_active' => $isActive,
                ]);
            }

            helper('persons');
            $persons = [];
            construct_person_array($this->podcast->persons, $persons);

            $data = [
                'podcast' => $this->podcast,
                'episodesNav' => $episodesNavigation,
                'activeQuery' => $activeQuery,
                'episodes' => (new EpisodeModel())->getPodcastEpisodes(
                    $this->podcast->id,
                    $this->podcast->type,
                    $yearQuery,
                    $seasonQuery,
                ),
                'persons' => $persons,
            ];

            $secondsToNextUnpublishedEpisode = (new EpisodeModel())->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id,
            );

            // if user is logged in then send to the authenticated episodes view
            if (can_user_interact()) {
                $found = view('podcast/episodes_authenticated', $data, [
                    'cache' => $secondsToNextUnpublishedEpisode
                        ? $secondsToNextUnpublishedEpisode
                        : DECADE,
                    'cache_name' => $cacheName,
                ]);
            } else {
                $found = view('podcast/episodes', $data, [
                    'cache' => $secondsToNextUnpublishedEpisode
                        ? $secondsToNextUnpublishedEpisode
                        : DECADE,
                    'cache_name' => $cacheName,
                ]);
            }
        }

        return $found;
    }
}
