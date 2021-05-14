<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Analytics\Controllers;

use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\Controller;

class AnalyticsController extends Controller
{
    /**
     * @var string
     */
    protected $className;

    /**
     * @var string
     */
    protected $methodName;

    public function _remap(string $method, string ...$params): mixed
    {
        if (!isset($params[1])) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->className = model('Analytics' . $params[1] . 'Model');
        $this->methodName = 'getData' . (empty($params[2]) ? '' : $params[2]);

        return $this->$method(
            $params[0],
            isset($params[3]) ? $params[3] : null,
        );
    }

    public function getData(int $podcastId, int $episodeId): ResponseInterface
    {
        $analytics_model = new $this->className();
        $methodName = $this->methodName;
        if ($episodeId !== 0) {
            return $this->response->setJSON(
                $analytics_model->$methodName($podcastId, $episodeId),
            );
        }

        return $this->response->setJSON(
            $analytics_model->$methodName($podcastId),
        );
    }
}
