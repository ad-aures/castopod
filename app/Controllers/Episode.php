<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use App\Models\EpisodeModel;
use App\Models\PodcastModel;

class Episode extends BaseController
{
    /**
     * @var \App\Entities\Podcast
     */
    protected $podcast;

    /**
     * @var \App\Entities\Episode|null
     */
    protected $episode;

    public function _remap($method, ...$params)
    {
        $this->podcast = (new PodcastModel())->getPodcastByName($params[0]);

        if (
            count($params) > 1 &&
            !($this->episode = (new EpisodeModel())->getEpisodeBySlug(
                $this->podcast->id,
                $params[1]
            ))
        ) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
        }

        return $this->$method();
    }

    public function index()
    {
        self::triggerWebpageHit($this->episode->podcast_id);

        $locale = service('request')->getLocale();
        $cacheName = "page_podcast{$this->episode->podcast_id}_episode{$this->episode->id}_{$locale}";

        if (!($cachedView = cache($cacheName))) {
            $episodeModel = new EpisodeModel();
            $previousNextEpisodes = $episodeModel->getPreviousNextEpisodes(
                $this->episode,
                $this->podcast->type
            );

            $persons = [];
            foreach ($this->episode->episode_persons as $episodePerson) {
                if (array_key_exists($episodePerson->person->id, $persons)) {
                    $persons[$episodePerson->person->id]['roles'] .=
                        empty($episodePerson->person_group) ||
                        empty($episodePerson->person_role)
                            ? ''
                            : (empty(
                                    $persons[$episodePerson->person->id][
                                        'roles'
                                    ]
                                )
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
                        'information_url' =>
                            $episodePerson->person->information_url,
                        'thumbnail_url' =>
                            $episodePerson->person->image->thumbnail_url,
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

            $data = [
                'previousEpisode' => $previousNextEpisodes['previous'],
                'nextEpisode' => $previousNextEpisodes['next'],
                'podcast' => $this->podcast,
                'episode' => $this->episode,
                'persons' => $persons,
            ];

            $secondsToNextUnpublishedEpisode = $episodeModel->getSecondsToNextUnpublishedEpisode(
                $this->podcast->id
            );

            // The page cache is set to a decade so it is deleted manually upon podcast update
            return view('episode', $data, [
                'cache' => $secondsToNextUnpublishedEpisode
                    ? $secondsToNextUnpublishedEpisode
                    : DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }
}
