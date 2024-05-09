<?php

declare(strict_types=1);

namespace Modules\Plugins\Controllers;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use Modules\Admin\Controllers\BaseController;
use Modules\Plugins\Core\Plugins;

class PluginController extends BaseController
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

    public function vendor(string $vendor): string
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $vendorPlugins = $plugins->getVendorPlugins($vendor);
        replace_breadcrumb_params([
            $vendor => $vendor,
        ]);
        return view('plugins/installed', [
            'total'       => count($vendorPlugins),
            'plugins'     => $vendorPlugins,
            'pager_links' => '',
        ]);
    }

    public function view(string $vendor, string $package): string
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        replace_breadcrumb_params([
            $vendor  => $vendor,
            $package => $package,
        ]);
        return view('plugins/view', [
            'plugin' => $plugin,
        ]);
    }

    public function generalSettings(string $vendor, string $package): string
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        helper('form');
        replace_breadcrumb_params([
            $vendor  => $vendor,
            $package => $package,
        ]);
        return view('plugins/settings_general', [
            'plugin' => $plugin,
        ]);
    }

    public function generalSettingsAction(string $vendor, string $package): RedirectResponse
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        foreach ($plugin->getSettingsFields('general') as $field) {
            $optionValue = $this->request->getPost($field->key);
            $plugins->setOption($plugin, $field->key, $optionValue);
        }

        return redirect()->back()
            ->with('message', lang('Plugins.messages.saveSettingsSuccess', [
                'pluginName' => $plugin->getName(),
            ]));
    }

    public function podcastSettings(string $podcastId, string $vendor, string $package): string
    {
        $podcast = (new PodcastModel())->getPodcastById((int) $podcastId);

        if (! $podcast instanceof Podcast) {
            throw PageNotFoundException::forPageNotFound();
        }

        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        helper('form');
        replace_breadcrumb_params([
            0        => $podcast->handle,
            $vendor  => $vendor,
            $package => $package,
        ]);
        return view('plugins/settings_podcast', [
            'podcast' => $podcast,
            'plugin'  => $plugin,
        ]);
    }

    public function podcastSettingsAction(string $podcastId, string $vendor, string $package): RedirectResponse
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        foreach ($plugin->getSettingsFields('podcast') as $field) {
            $settingValue = $this->request->getPost($field->key);
            $plugins->setOption($plugin, $field->key, $settingValue, ['podcast', (int) $podcastId]);
        }

        return redirect()->back()
            ->with('message', lang('Plugins.messages.saveSettingsSuccess', [
                'pluginName' => $plugin->getName(),
            ]));
    }

    public function episodeSettings(string $podcastId, string $episodeId, string $vendor, string $package): string
    {
        $episode = (new EpisodeModel())->getEpisodeById((int) $episodeId);

        if (! $episode instanceof Episode) {
            throw PageNotFoundException::forPageNotFound();
        }

        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        helper('form');
        replace_breadcrumb_params([
            0        => $episode->podcast->handle,
            1        => $episode->title,
            $vendor  => $vendor,
            $package => $package,
        ]);
        return view('plugins/settings_episode', [
            'podcast' => $episode->podcast,
            'episode' => $episode,
            'plugin'  => $plugin,
        ]);
    }

    public function episodeSettingsAction(
        string $podcastId,
        string $episodeId,
        string $vendor,
        string $package
    ): RedirectResponse {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        foreach ($plugin->getSettingsFields('episode') as $field) {
            $settingValue = $this->request->getPost($field->key);
            $plugins->setOption($plugin, $field->key, $settingValue, ['episode', (int) $episodeId]);
        }

        return redirect()->back()
            ->with('message', lang('Plugins.messages.saveSettingsSuccess', [
                'pluginName' => $plugin->getName(),
            ]));
    }

    public function activate(string $vendor, string $package): RedirectResponse
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $plugins->activate($plugin);

        return redirect()->back();
    }

    public function deactivate(string $vendor, string $package): RedirectResponse
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $plugins->deactivate($plugin);

        return redirect()->back();
    }

    public function uninstall(string $vendor, string $package): RedirectResponse
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $plugins->uninstall($plugin);

        return redirect()->back();
    }
}
