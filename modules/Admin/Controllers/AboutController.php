<?php

declare(strict_types=1);

/**
 * @copyright  2022 Ad Aures
 * @license    https://www.gnu.org/licenses/agpl-3.0.en.html AGPL3
 * @link       https://castopod.org/
 */

namespace Modules\Admin\Controllers;

use CodeIgniter\HTTP\RedirectResponse;

class AboutController extends BaseController
{
    public function index(): string
    {
        $instanceInfo = [
            'host_name'   => current_domain(),
            'version'     => CP_VERSION,
            'php_version' => PHP_VERSION,
            'os'          => PHP_OS,
            'languages'   => implode(', ', config('App')->supportedLocales),
        ];

        return view('settings/about', [
            'info' => $instanceInfo,
        ]);
    }

    public function updateAction(): RedirectResponse
    {
        if ($this->request->getPost('action') === 'database') {
            return $this->migrateDatabase();
        }

        return redirect()->back()
            ->with('error', lang('Security.disallowedAction'));
    }

    public function migrateDatabase(): RedirectResponse
    {
        $migrate = service('migrations');

        $migrate->setNamespace(null)
            ->latest();

        return redirect()->back()
            ->with('message', lang('AboutCastopod.messages.databaseUpdateSuccess'));
    }
}
