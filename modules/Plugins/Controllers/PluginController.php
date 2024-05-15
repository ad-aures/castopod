<?php

declare(strict_types=1);

namespace Modules\Plugins\Controllers;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Models\EpisodeModel;
use App\Models\PodcastModel;
use CodeIgniter\Exceptions\PageNotFoundException;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\URI;
use CodeIgniter\I18n\Time;
use Modules\Admin\Controllers\BaseController;
use Modules\Plugins\Core\Markdown;
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

    public function settings(
        string $vendor,
        string $package,
        string $podcastId = null,
        string $episodeId = null
    ): string {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $type = 'general';
        $context = null;
        $breadcrumbReplacements = [
            $vendor  => $vendor,
            $package => $package,
        ];
        $data = [
            'plugin' => $plugin,
        ];

        if ($podcastId !== null) {
            $podcast = (new PodcastModel())->getPodcastById((int) $podcastId);

            if (! $podcast instanceof Podcast) {
                throw PageNotFoundException::forPageNotFound();
            }

            $type = 'podcast';
            $context = ['podcast', (int) $podcastId];
            $breadcrumbReplacements[0] = $podcast->handle;
            $data['podcast'] = $podcast;
        }

        if ($episodeId !== null) {
            $episode = (new EpisodeModel())->getEpisodeById((int) $episodeId);

            if (! $episode instanceof Episode) {
                throw PageNotFoundException::forPageNotFound();
            }

            $type = 'episode';
            $context = ['episode', (int) $episodeId];
            $breadcrumbReplacements[1] = $episode->title;
            $data['episode'] = $episode;
        }

        $fields = $plugin->getSettingsFields($type);

        if ($fields === []) {
            throw PageNotFoundException::forPageNotFound();
        }

        $data['type'] = $type;
        $data['context'] = $context;
        $data['fields'] = $fields;

        helper('form');
        replace_breadcrumb_params($breadcrumbReplacements);
        return view('plugins/settings', $data);
    }

    public function settingsAction(
        string $vendor,
        string $package,
        string $podcastId = null,
        string $episodeId = null
    ): RedirectResponse {
        /** @var Plugins $plugins */
        $plugins = service('plugins');

        $plugin = $plugins->getPlugin($vendor, $package);

        if ($plugin === null) {
            throw PageNotFoundException::forPageNotFound();
        }

        $type = 'general';
        $context = null;
        if ($podcastId !== null) {
            $type = 'podcast';
            $context = ['podcast', (int) $podcastId];
        }

        if ($episodeId !== null) {
            $type = 'episode';
            $context = ['episode', (int) $episodeId];
        }

        // construct validation rules first
        $rules = [];
        foreach ($plugin->getSettingsFields($type) as $field) {
            $typeRules = $plugins::FIELDS_VALIDATIONS[$field->type];
            if (! in_array('permit_empty', $typeRules, true)) {
                $typeRules[] = $field->optional ? 'permit_empty' : 'required';
            }

            $rules[$field->key] = $typeRules;
        }

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validatedData = $this->validator->getValidated();

        foreach ($plugin->getSettingsFields('general') as $field) {
            $value = $validatedData[$field->key] ?? null;
            $fieldValue = $value === '' ? null : match ($plugins::FIELDS_CASTS[$field->type] ?? 'text') {
                'bool'     => $value === 'yes',
                'int'      => (int) $value,
                'uri'      => new URI($value),
                'datetime' => Time::createFromFormat(
                    'Y-m-d H:i',
                    $value,
                    $this->request->getPost('client_timezone')
                )->setTimezone(app_timezone()),
                'markdown' => new Markdown($value),
                default    => $value,
            };
            $plugins->setOption($plugin, $field->key, $fieldValue, $context);
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
