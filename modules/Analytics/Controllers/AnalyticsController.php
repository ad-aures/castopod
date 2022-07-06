<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Analytics\Controllers;

use CodeIgniter\API\ResponseTrait;
use CodeIgniter\Controller;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\Model;

class AnalyticsController extends Controller
{
    use ResponseTrait;

    protected Model $analyticsModel;

    protected string $methodName = '';

    public function _remap(string $method, string ...$params): mixed
    {
        if (count($params) < 2) {
            throw PageNotFoundException::forPageNotFound();
        }

        if (! is_numeric($params[0])) {
            $this->analyticsModel = model('Analytics' . $params[0] . 'Model');
            $this->methodName = 'getData' . $params[1];
            return $this->{$method}();
        }

        $this->analyticsModel = model('Analytics' . $params[1] . 'Model');
        $this->methodName = 'getData' . (count($params) >= 3 ? $params[2] : '');

        return $this->{$method}(
            (int) $params[0],
            count($params) >= 4 ? (int) $params[3] : null,
        );
    }

    public function getData(?int $podcastId = null, ?int $episodeId = null): ResponseInterface
    {
        $methodName = $this->methodName;

        if ($podcastId === null) {
            return $this->respond($this->analyticsModel->{$methodName}());
        }

        if ($episodeId === null) {
            return $this->respond($this->analyticsModel->{$methodName}($podcastId));
        }

        return $this->respond($this->analyticsModel->{$methodName}($podcastId, $episodeId));
    }
}
