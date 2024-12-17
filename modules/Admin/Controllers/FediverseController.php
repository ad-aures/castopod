<?php

declare(strict_types=1);

/**
 * @copyright  2020 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class FediverseController extends BaseController
{
    public function dashboard(): RedirectResponse
    {
        return redirect()->route('fediverse-blocked-actors');
    }

    public function blockedActors(): string
    {
        helper(['form']);

        $blockedActors = model('ActorModel', false)
            ->getBlockedActors();

        $this->setHtmlHead(lang('Fediverse.blocked_actors'));
        return view('fediverse/blocked_actors', [
            'blockedActors' => $blockedActors,
        ]);
    }

    public function blockedDomains(): string
    {
        helper(['form']);

        $blockedDomains = model('BlockedDomainModel', false)
            ->getBlockedDomains();

        $this->setHtmlHead(lang('Fediverse.blocked_domains'));
        return view('fediverse/blocked_domains', [
            'blockedDomains' => $blockedDomains,
        ]);
    }
}
