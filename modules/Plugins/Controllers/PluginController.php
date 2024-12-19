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
use Modules\Plugins\Core\BasePlugin;
use Modules\Plugins\Core\Markdown;
use Modules\Plugins\Core\Plugins;
use Modules\Plugins\Core\RSS;
use Modules\Plugins\Manifest\Field;

class PluginController extends BaseController
{
    protected Plugins $plugins;

    public function __construct()
    {
        $this->plugins = service('plugins');
    }

    public function installed(): string
    {
        $pager = service('pager');

        $page = (int) ($this->request->getGet('page') ?? 1);
        $perPage = 10;
        $total = $this->plugins->getInstalledCount();

        $pager_links = $pager->makeLinks($page, $perPage, $total);

        $this->setHtmlHead(lang('Plugins.installed'));
        return view('plugins/installed', [
            'total'       => $total,
            'plugins'     => $this->plugins->getPlugins($page, $perPage),
            'pager_links' => $pager_links,
        ]);
    }

    public function vendor(string $vendor): string
    {
        $vendorPlugins = $this->plugins->getVendorPlugins($vendor);

        $this->setHtmlHead(lang('Plugins.installed'));
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

        $plugin = $this->plugins->getPlugin($vendor, $package);

        if (! $plugin instanceof BasePlugin) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->setHtmlHead($plugin->getTitle());
        replace_breadcrumb_params([
            $vendor  => $vendor,
            $package => $package,
        ]);
        return view('plugins/view', [
            'plugin' => $plugin,
        ]);
    }

    public function settingsView(
        string $vendor,
        string $package,
        string $podcastId = null,
        string $episodeId = null
    ): string {

        $plugin = $this->plugins->getPlugin($vendor, $package);

        if (! $plugin instanceof BasePlugin) {
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
        $this->setHtmlHead(lang('Plugins.settingsTitle', [
            'pluginTitle' => $plugin->getTitle(),
            'type'        => $type,
        ]));
        replace_breadcrumb_params($breadcrumbReplacements);
        return view('plugins/settings', $data);
    }

    public function settingsAction(
        string $vendor,
        string $package,
        string $podcastId = null,
        string $episodeId = null
    ): RedirectResponse {

        $plugin = $this->plugins->getPlugin($vendor, $package);

        if (! $plugin instanceof BasePlugin) {
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
            $typeRules = $this->plugins::FIELDS_VALIDATIONS[$field->type];
            if (! in_array('permit_empty', $typeRules, true)) {
                $typeRules[] = $field->optional ? 'permit_empty' : 'required';
            }

            if ($field->multiple) {
                if ($field->type === 'group') {
                    foreach ($field->fields as $subField) {
                        $typeRules = $this->plugins::FIELDS_VALIDATIONS[$subField->type];
                        if (! in_array('permit_empty', $typeRules, true)) {
                            $typeRules[] = $subField->optional ? 'permit_empty' : 'required';
                        }

                        $rules[sprintf('%s.*.%s', $field->key, $subField->key)] = $typeRules;
                    }
                } else {
                    $rules[$field->key . '.*'] = $typeRules;
                }
            } elseif ($field->type === 'group') {
                foreach ($field->fields as $subField) {
                    $typeRules = $this->plugins::FIELDS_VALIDATIONS[$subField->type];
                    if (! in_array('permit_empty', $typeRules, true)) {
                        $typeRules[] = $subField->optional ? 'permit_empty' : 'required';
                    }

                    $rules[sprintf('%s.%s', $field->key, $subField->key)] = $typeRules;
                }
            } else {
                $rules[$field->key] = $typeRules;
            }
        }

        if (! $this->validate($rules)) {
            return redirect()
                ->back()
                ->withInput()
                ->with('errors', $this->validator->getErrors());
        }

        $validatedData = $this->validator->getValidated();

        foreach ($plugin->getSettingsFields($type) as $field) {
            $fieldValue = $validatedData[$field->key] ?? null;

            $this->plugins->setOption($plugin, $field->key, $this->castFieldValue($field, $fieldValue), $context);
        }

        // clear cache after setting options
        $plugin->clearCache();

        return redirect()->back()
            ->with('message', lang('Plugins.messages.saveSettingsSuccess', [
                'pluginTitle' => $plugin->getTitle(),
            ]));
    }

    public function activate(string $vendor, string $package): RedirectResponse
    {

        $plugin = $this->plugins->getPlugin($vendor, $package);

        if (! $plugin instanceof BasePlugin) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->plugins->activate($plugin);

        return redirect()->back();
    }

    public function deactivate(string $vendor, string $package): RedirectResponse
    {

        $plugin = $this->plugins->getPlugin($vendor, $package);

        if (! $plugin instanceof BasePlugin) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->plugins->deactivate($plugin);

        return redirect()->back();
    }

    public function uninstall(string $vendor, string $package): RedirectResponse
    {

        $plugin = $this->plugins->getPlugin($vendor, $package);

        if (! $plugin instanceof BasePlugin) {
            throw PageNotFoundException::forPageNotFound();
        }

        $this->plugins->uninstall($plugin);

        return redirect()->back();
    }

    private function castFieldValue(Field $field, mixed $fieldValue): mixed
    {
        if ($fieldValue === '' || $fieldValue === null) {
            return null;
        }

        $value = null;
        if ($field->multiple) {
            $value = [];
            foreach ($fieldValue as $key => $val) {
                if ($val === '') {
                    continue;
                }

                if ($field->type === 'group') {
                    foreach ($val as $subKey => $subVal) {
                        /** @var Field|false $subField */
                        $subField = array_column($field->fields, null, 'key')[$subKey] ?? false;
                        if (! $subField) {
                            continue;
                        }

                        $v = $this->castValue($subVal, $subField->type);
                        if ($v) {
                            $value[$key][$subKey] = $v;
                        }
                    }
                } else {
                    $value[$key] = $this->castValue($val, $field->type);
                }
            }
        } elseif ($field->type === 'group') {
            foreach ($fieldValue as $subKey => $subVal) {
                /** @var Field|false $subField */
                $subField = array_column($field->fields, null, 'key')[$subKey] ?? false;
                if (! $subField) {
                    continue;
                }

                $v = $this->castValue($subVal, $subField->type);
                if ($v) {
                    $value[$subKey] = $v;
                }
            }
        } else {
            $value = $this->castValue($fieldValue, $field->type);
        }

        return $value === [] ? null : $value;
    }

    private function castValue(mixed $value, string $type): mixed
    {
        if ($value === '' || $value === null) {
            return null;
        }

        return match ($this->plugins::FIELDS_CASTS[$type] ?? 'text') {
            'bool'     => $value === 'yes',
            'int'      => (int) $value,
            'uri'      => new URI($value),
            'datetime' => Time::createFromFormat(
                'Y-m-d H:i',
                $value,
                $this->request->getPost('client_timezone')
            )->setTimezone(app_timezone()),
            'markdown'               => new Markdown($value),
            'rss'                    => new RSS($value),
            'comma-separated-string' => implode(',', $value),
            default                  => $value,
        };
    }
}
