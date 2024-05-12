<?php

declare(strict_types=1);

namespace Modules\Plugins\Core;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;
use CodeIgniter\HTTP\URI;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Event\DocumentParsedEvent;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\GithubFlavoredMarkdownExtension;
use League\CommonMark\Extension\SmartPunct\SmartPunctExtension;
use League\CommonMark\MarkdownConverter;
use Modules\Plugins\ExternalImageProcessor;
use Modules\Plugins\ExternalLinkProcessor;
use Modules\Plugins\Manifest\Field;
use Modules\Plugins\Manifest\Manifest;
use Modules\Plugins\Manifest\Person;
use Modules\Plugins\Manifest\Repository;
use Modules\Plugins\Manifest\Settings;
use RuntimeException;

/**
 * @property string $key
 * @property string $iconSrc
 */
abstract class BasePlugin implements PluginInterface
{
    protected string $key;

    protected string $iconSrc;

    protected bool $active;

    protected Manifest $manifest;

    protected ?string $readmeHTML;

    public function __construct(
        protected string $vendor,
        protected string $package,
        protected string $directory
    ) {
        $this->key = sprintf('%s/%s', $vendor, $package);

        // TODO: cache manifest data
        $manifestPath = $directory . '/manifest.json';
        $manifestContents = file_get_contents($manifestPath);

        if (! $manifestContents) {
            throw new RuntimeException(sprintf('Plugin manifest "%s" is missing!', $manifestPath));
        }

        /** @var array<mixed>|null $manifestData */
        $manifestData = json_decode($manifestContents, true);

        if ($manifestData === null) {
            throw new RuntimeException(sprintf('Plugin manifest "%s" is not a valid JSON', $manifestPath), 1);
        }

        $this->manifest = new Manifest($manifestData);

        // check that plugin is active
        $this->active = get_plugin_option($this->key, 'active') ?? false;

        $this->iconSrc = $this->loadIcon($directory . '/icon.svg');

        $this->readmeHTML = $this->loadReadme($directory . '/README.md');
    }

    /**
     * @param list<string>|string $value
     */
    public function __set(string $name, array|string $value): void
    {
        $this->{$name} = $value;
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
        return in_array($name, $this->manifest->hooks, true);
    }

    final public function getSettings(): ?Settings
    {
        return $this->manifest->settings;
    }

    final public function getVersion(): string
    {
        return $this->manifest->version;
    }

    final public function getHomepage(): ?URI
    {
        return $this->manifest->homepage;
    }

    final public function getRepository(): ?Repository
    {
        return $this->manifest->repository;
    }

    /**
     * @return list<string>
     */
    final public function getKeywords(): array
    {
        return $this->manifest->keywords;
    }

    /**
     * @return Person[]
     */
    final public function getAuthors(): array
    {
        return $this->manifest->authors;
    }

    final public function getIconSrc(): string
    {
        return $this->iconSrc;
    }

    final public function doesManifestHaveErrors(): bool
    {
        return $this->getManifestErrors() !== [];
    }

    /**
     * @return array<string,string>
     */
    final public function getManifestErrors(): array
    {
        return $this->manifest::$errors;
    }

    /**
     * @return Field[]
     */
    final public function getSettingsFields(string $type): array
    {
        $settings = $this->getSettings();
        if (! $settings instanceof Settings) {
            return [];
        }

        return $settings->{$type};
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
            return $this->manifest->name;
        }

        return $name;
    }

    final public function getDescription(): ?string
    {
        $key = sprintf('Plugin.%s.description', $this->key);

        /** @var string $description */
        $description = lang($key);

        if ($description === $key) {
            return $this->manifest->description;
        }

        return $description;
    }

    final public function getReadmeHTML(): ?string
    {
        return $this->readmeHTML;
    }

    final public function getLicense(): string
    {
        return $this->manifest->license ?? 'UNLICENSED';
    }

    final protected function getOption(string $option): mixed
    {
        return get_plugin_option($this->key, $option);
    }

    final protected function setOption(string $option, mixed $value = null): void
    {
        set_plugin_option($this->key, $option, $value);
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

    private function loadReadme(string $path): ?string
    {
        // TODO: cache readme
        $readmeMD = @file_get_contents($path);

        if (! $readmeMD) {
            return null;
        }

        $environment = new Environment([
            'html_input'         => 'escape',
            'allow_unsafe_links' => false,
            'host'               => (new URI(base_url()))->getHost(),
        ]);
        $environment->addExtension(new CommonMarkCoreExtension());

        $environment->addExtension(new GithubFlavoredMarkdownExtension());
        $environment->addExtension(new SmartPunctExtension());

        $environment->addEventListener(
            DocumentParsedEvent::class,
            static function (DocumentParsedEvent $event): void {
                (new ExternalLinkProcessor())->onDocumentParsed($event);
            }
        );
        $environment->addEventListener(
            DocumentParsedEvent::class,
            static function (DocumentParsedEvent $event): void {
                (new ExternalImageProcessor())->onDocumentParsed($event);
            }
        );

        $converter = new MarkdownConverter($environment);

        return $converter->convert($readmeMD)
            ->getContent();
    }
}
