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
use Modules\Plugins\Plugins;

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

    public function generalSettings(string $pluginKey): string
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($pluginKey);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        helper('form');
        return view('plugins/settings_general', [
            'plugin' => $plugin,
        ]);
    }

    public function generalSettingsAction(string $pluginKey): RedirectResponse
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($pluginKey);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        foreach ($plugin->settings['general'] as $option) {
            $optionKey = $option['key'];
            $optionValue = $this->request->getPost($optionKey);
            $plugins->setOption($pluginKey, $optionKey, $optionValue);
        }

        return redirect()->back()
            ->with('message', lang('Plugins.messages.saveSettingsSuccess', [
                'pluginName' => $plugin->getName(),
            ]));
    }

    public function podcastSettings(string $podcastId, string $pluginKey): string
    {
        $podcast = (new PodcastModel())->getPodcastById((int) $podcastId);

        if (! $podcast instanceof Podcast) {
            throw PageNotFoundException::forPageNotFound();
        }

        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($pluginKey);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        helper('form');
        replace_breadcrumb_params([
            0 => $podcast->handle,
        ]);
        return view('plugins/settings_podcast', [
            'podcast' => $podcast,
            'plugin'  => $plugin,
        ]);
    }

    public function podcastSettingsAction(string $podcastId, string $pluginKey): RedirectResponse
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($pluginKey);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        foreach ($plugin->settings['podcast'] as $setting) {
            $settingKey = $setting['key'];
            $settingValue = $this->request->getPost($settingKey);
            $plugins->setOption($pluginKey, $settingKey, $settingValue, ['podcast', (int) $podcastId]);
        }

        return redirect()->back()
            ->with('message', lang('Plugins.messages.saveSettingsSuccess', [
                'pluginName' => $plugin->getName(),
            ]));
    }

    public function episodeSettings(string $podcastId, string $episodeId, string $pluginKey): string
    {
        $episode = (new EpisodeModel())->getEpisodeById((int) $episodeId);

        if (! $episode instanceof Episode) {
            throw PageNotFoundException::forPageNotFound();
        }

        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($pluginKey);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        helper('form');
        replace_breadcrumb_params([
            0 => $episode->podcast->handle,
            1 => $episode->title,
        ]);
        return view('plugins/settings_episode', [
            'podcast' => $episode->podcast,
            'episode' => $episode,
            'plugin'  => $plugin,
        ]);
    }

    public function episodeSettingsAction(string $podcastId, string $episodeId, string $pluginKey): RedirectResponse
    {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($pluginKey);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        foreach ($plugin->settings['episode'] as $setting) {
            $settingKey = $setting['key'];
            $settingValue = $this->request->getPost($settingKey);
            $plugins->setOption($pluginKey, $settingKey, $settingValue, ['episode', (int) $episodeId]);
        }

        return redirect()->back()
            ->with('message', lang('Plugins.messages.saveSettingsSuccess', [
                'pluginName' => $plugin->getName(),
            ]));
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
