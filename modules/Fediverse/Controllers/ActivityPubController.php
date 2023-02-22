<?php

declare(strict_types=1);

/**
 * @copyright  2021 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\Response;

class ActivityPubController extends Controller
{
    public function preflight(): Response
    {
        return $this->response->setHeader('Access-Control-Allow-Origin', '*') // for allowing any domain, insecure
            ->setHeader('Access-Control-Allow-Headers', '*') // for allowing any headers, insecure
            ->setHeader('Access-Control-Allow-Methods', 'GET, OPTIONS') // allows GET and OPTIONS methods only
            ->setHeader('Access-Control-Max-Age', '86400')
            ->setHeader('Cache-Control', 'public, max-age=86400')
            ->setStatusCode(200);
    }
}
