<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers\Admin;

use App\Models\PodcastModel;
use App\Models\EpisodeModel;

class AnalyticsData extends BaseController
{
    /**
     * @var \App\Entities\Podcast|null
     */
    protected $podcast;
    protected $className;
    protected $methodName;
    protected $episode;

    public function _remap($method, ...$params)
    {
        if (count($params) > 2) {
            if (!($this->podcast = (new PodcastModel())->find($params[0]))) {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                    'Podcast not found: ' . $params[0]
                );
            }
            $this->className = '\App\Models\Analytics' . $params[1] . 'Model';
            $this->methodName = 'getData' . $params[2];
            if (count($params) > 3) {
                if (
                    !($this->episode = (new EpisodeModel())
                        ->where([
                            'podcast_id' => $this->podcast->id,
                            'id' => $params[3],
                        ])
                        ->first())
                ) {
                    throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound(
                        'Episode not found: ' . $params[3]
                    );
                }
            }
        }

        return $this->$method();
    }
    public function getData()
    {
        $analytics_model = new $this->className();
        $methodName = $this->methodName;
        if ($this->episode) {
            return $this->response->setJSON(
                $analytics_model->$methodName(
                    $this->podcast->id,
                    $this->episode->id
                )
            );
        } else {
            return $this->response->setJSON(
                $analytics_model->$methodName($this->podcast->id)
            );
        }
    }
}
