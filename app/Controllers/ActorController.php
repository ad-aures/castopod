<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
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
     * @var list<string>
     */
    protected $helpers = ['svg', 'components', 'misc', 'seo'];

    public function followView(): string
    {
        // @phpstan-ignore-next-line
        $this->registerPodcastWebpageHit($this->actor->podcast->id);

        helper(['form', 'components', 'svg']);
        // @phpstan-ignore-next-line
        set_follow_metatags($this->actor);
        $data = [
            'actor' => $this->actor,
        ];

        return view('podcast/follow', $data);
    }
}
