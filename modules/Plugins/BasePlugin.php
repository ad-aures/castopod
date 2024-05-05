<?php

declare(strict_types=1);

namespace Modules\Plugins;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;
use CodeIgniter\I18n\Time;
use RuntimeException;

/**
 * @property string $key
 * @property string $name
 * @property string $description
 * @property string $version
 * @property string $website
 * @property Time $releaseDate
 * @property string $author
 * @property string $license
 * @property string $compatible
 * @property string[] $keywords
 * @property string[] $hooks
 * @property string $iconSrc
 * @property array{general:array{key:string,name:string,description:string}[],podcast:array{key:string,name:string,description:string}[],episode:array{key:string,name:string,description:string}[]} $settings
 */
abstract class BasePlugin implements PluginInterface
{
    protected bool $active;

    public function __construct(
        protected string $vendor,
        protected string $package,
        protected string $directory
    ) {
        $this->key = sprintf('%s/%s', $vendor, $package);

        $manifest = $this->loadManifest($directory . '/manifest.json');

        foreach ($manifest as $key => $value) {
            $this->{$key} = $value;
        }

        // check that plugin is active
        $this->active = get_plugin_option($this->key, 'active') ?? false;

        $this->iconSrc = $this->loadIcon($directory . '/icon.svg');
    }

    /**
     * @param list<string>|string $value
     */
    public function __set(string $name, array|string $value): void
    {
        $this->{$name} = $name === 'releaseDate' ? Time::createFromFormat('Y-m-d', $value) : $value;
    }

    public function init(): void
    {
        // add to admin navigation

        // TODO: setup navigation and views?
    }

    public function channelTag(Podcast $podcast, SimpleRSSElement $channel): void
    {
    }

    public function itemTag(Episode $episode, SimpleRSSElement $item): void
    {
    }

    public function siteHead(): void
    {
    }

    final public function isActive(): bool
    {
        return $this->active;
    }

    final public function isHookDeclared(string $name): bool
    {
        return in_array($name, $this->hooks, true);
    }

    final public function getKey(): string
    {
        return $this->key;
    }

    final public function getVendor(): string
    {
        return $this->vendor;
    }

    final public function getPackage(): string
    {
        return $this->package;
    }

    final public function getName(): string
    {
        $key = sprintf('Plugin.%s.name', $this->key);
        /** @var string $name */
        $name = lang($key);

        if ($name === $key) {
            return $this->name;
        }

        return $name;
    }

    final public function getDescription(): string
    {
        $key = sprintf('Plugin.%s.description', $this->key);

        /** @var string $description */
        $description = lang($key);

        if ($description === $key) {
            return $this->description;
        }

        return $description;
    }

    final protected function getOption(string $option): mixed
    {
        return get_plugin_option($this->key, $option);
    }

    final protected function setOption(string $option, mixed $value = null): void
    {
        set_plugin_option($this->key, $option, $value);
    }

    /**
     * @return array<string, string|list<string>>
     */
    private function loadManifest(string $path): array
    {
        // TODO: cache manifest data

        $manifestContents = file_get_contents($path);

        if (! $manifestContents) {
            throw new RuntimeException('manifest file not found!');
        }

        /** @var array<mixed>|null $manifest */
        $manifest = json_decode($manifestContents, true);

        if ($manifest === null) {
            throw new RuntimeException('manifest.json is not a valid JSON', 1);
        }

        $validation = service('validation');

        if (array_key_exists('settings', $manifest)) {
            $fieldRules = [
                'key'         => 'required|alpha_numeric',
                'name'        => 'required|max_length[32]',
                'description' => 'permit_empty|max_length[128]',
            ];
            $defaultField = [
                'key'         => '',
                'name'        => '',
                'description' => '',
            ];
            $validation->setRules($fieldRules);
            foreach ($manifest['settings'] as $key => $settings) {
                foreach ($settings as $key2 => $fields) {
                    $manifest['settings'][$key][$key2] = array_merge($defaultField, $fields);

                    if (! $validation->run($manifest['settings'][$key][$key2])) {
                        dd($this->key, $manifest['settings'][$key][$key2], $validation->getErrors());
                    }
                }
            }
        }

        $rules = [
            'name'         => 'required|max_length[32]',
            'version'      => 'required|regex_match[/^(0|[1-9]\d*)\.(0|[1-9]\d*)\.(0|[1-9]\d*)(?:-((?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*)(?:\.(?:0|[1-9]\d*|\d*[a-zA-Z-][0-9a-zA-Z-]*))*))?(?:\+([0-9a-zA-Z-]+(?:\.[0-9a-zA-Z-]+)*))?$/]',
            'compatible'   => 'required|in_list[1.0]',
            'description'  => 'max_length[128]',
            'releaseDate'  => 'valid_date[Y-m-d]',
            'license'      => 'in_list[MIT]',
            'author.name'  => 'permit_empty|max_length[32]',
            'author.email' => 'permit_empty|valid_email',
            'author.url'   => 'permit_empty|valid_url_strict',
            'website'      => 'valid_url_strict',
            'keywords.*'   => 'permit_empty|in_list[seo,podcasting20,analytics]',
            'hooks.*'      => 'permit_empty|in_list[' . implode(',', Plugins::HOOKS) . ']',
            'settings'     => 'permit_empty',
        ];

        $validation->setRules($rules);

        if (! $validation->run($manifest)) {
            dd($this->key, $manifest, $validation->getErrors());
        }

        $defaultAttributes = [
            'description' => '',
            'releaseDate' => '',
            'license'     => '',
            'author'      => [],
            'website'     => '',
            'hooks'       => [],
            'keywords'    => [],
            'settings'    => [
                'general' => [],
                'podcast' => [],
                'episode' => [],
            ],
        ];

        $validated = $validation->getValidated();

        return array_merge_recursive_distinct($defaultAttributes, $validated);
    }

    private function loadIcon(string $path): string
    {
        // TODO: cache icon
        $svgIcon = @file_get_contents($path);

        if (! $svgIcon) {
            return "data:image/svg+xml;utf8,%3Csvg xmlns='http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg' viewBox='0 0 64 64'%3E%3Cpath fill='%2300564A' d='M0 0h64v64H0z'%2F%3E%3Cpath fill='%23E7F9E4' d='M25.3 18.7a5 5 0 1 1 9.7 1.6h7c1 0 1.7.8 1.7 1.7v7a5 5 0 1 1 0 9.4v7c0 .9-.8 1.6-1.7 1.6H18.7c-1 0-1.7-.7-1.7-1.7V22c0-1 .7-1.7 1.7-1.7h7a5 5 0 0 1-.4-1.6Z'%2F%3E%3C%2Fsvg%3E";
        }

        $encodedIcon = rawurlencode(str_replace(["\r", "\n"], ' ', $svgIcon));
        return 'data:image/svg+xml;utf8,' . str_replace(
            ['%20', '%22', '%27', '%3D'],
            [' ', "'", "'", '='],
            $encodedIcon
        );
    }
}
