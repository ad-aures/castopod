<?php

declare(strict_types=1);

/**
 * @copyright  2021 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Fediverse\Controllers;

use CodeIgniter\Controller;
use CodeIgniter\HTTP\ResponseInterface;

class NodeInfo2Controller extends Controller
{
    public function index(): ResponseInterface
    {
        $totalUsers = model('ActorModel', false)
            ->getTotalLocalActors();
        $totalPosts = model('PostModel', false)
            ->getTotalLocalPosts();
        $activeMonth = model('ActorModel', false)
            ->getActiveLocalActors(1);
        $activeHalfyear = model('ActorModel', false)
            ->getActiveLocalActors(6);

        $nodeInfo2 = [
            'version' => '1.0',
            'server' => [
                'baseUrl' => base_url(),
                'name' => service('settings')
                    ->get('App.siteName'),
                'software' => 'Castopod',
                'version' => CP_VERSION,
            ],
            'protocols' => ['activitypub'],
            'openRegistrations' => config('Auth')
                ->allowRegistration,
            'usage' => [
                'users' => [
                    'total' => $totalUsers,
                    'activeMonth' => $activeMonth,
                    'activeHalfyear' => $activeHalfyear,
                ],
                'localPosts' => $totalPosts,
            ],
        ];

        return $this->response->setJSON($nodeInfo2);
    }
}
