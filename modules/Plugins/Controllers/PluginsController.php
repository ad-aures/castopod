<?php

declare(strict_types=1);

namespace Modules\Plugins\Controllers;

use CodeIgniter\HTTP\RedirectResponse;
use Modules\Admin\Controllers\BaseController;
use Modules\Plugins\Plugins;

class PluginsController extends BaseController
{
    public function installed(): string
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $pager = service('pager');

        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $total = $plugins->getInstalledCount();

        $pager_links = $pager->makeLinks($page, $perPage, $total);

        return view('plugins/installed', [
            'total'       => $total,
            'plugins'     => $plugins->getPlugins($page, $perPage),
            'pager_links' => $pager_links,
        ]);
    }

    public function activate(string $pluginKey): RedirectResponse
    {
        service('plugins')->activate($pluginKey);

        return redirect()->back();
    }

    public function deactivate(string $pluginKey): RedirectResponse
    {
        service('plugins')->deactivate($pluginKey);

        return redirect()->back();
    }
}
