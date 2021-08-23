<?php

declare(strict_types=1);

/**
 * @copyright  2020 Podlibre
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

class FediverseController extends BaseController
{
    public function dashboard(): string
    {
        return view('Modules\Admin\Views\fediverse\dashboard');
    }

    public function blockedActors(): string
    {
        helper(['form']);

        $blockedActors = model('ActorModel')
            ->getBlockedActors();

        return view('Modules\Admin\Views\fediverse\blocked_actors', [
            'blockedActors' => $blockedActors,
        ]);
    }

    public function blockedDomains(): string
    {
        helper(['form']);

        $blockedDomains = model('BlockedDomainModel')
            ->getBlockedDomains();

        return view('Modules\Admin\Views\fediverse\blocked_domains', [
            'blockedDomains' => $blockedDomains,
        ]);
    }
}
