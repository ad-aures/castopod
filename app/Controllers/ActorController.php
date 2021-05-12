<?php

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use ActivityPub\Controllers\ActorController as ActivityPubActorController;
use Analytics\AnalyticsTrait;

class ActorController extends ActivityPubActorController
{
    use AnalyticsTrait;

    protected $helpers = ['auth', 'svg', 'components', 'misc'];

    public function follow()
    {
        // Prevent analytics hit when authenticated
        if (!can_user_interact()) {
            $this->registerPodcastWebpageHit($this->actor->podcast->id);
        }

        $cacheName = "page_podcast-{$this->actor->username}_follow";
        if (!($cachedView = cache($cacheName))) {
            helper(['form', 'components', 'svg']);
            $data = [
                'actor' => $this->actor,
            ];

            return view('podcast/follow', $data, [
                'cache' => DECADE,
                'cache_name' => $cacheName,
            ]);
        }

        return $cachedView;
    }
}
