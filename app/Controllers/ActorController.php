<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace App\Controllers;

use Modules\Analytics\AnalyticsTrait;
use Modules\Fediverse\Controllers\ActorController as FediverseActorController;

class ActorController extends FediverseActorController
{
    use AnalyticsTrait;

    /**
     * @var string[]
     */
    protected $helpers = ['auth', 'svg', 'components', 'misc'];

    public function follow(): string
    {
        // Prevent analytics hit when authenticated
        if (! can_user_interact()) {
            // @phpstan-ignore-next-line
            $this->registerPodcastWebpageHit($this->actor->podcast->id);
        }

        $cacheName = "page_podcast-{$this->actor->username}_follow";
        if (! ($cachedView = cache($cacheName))) {
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
