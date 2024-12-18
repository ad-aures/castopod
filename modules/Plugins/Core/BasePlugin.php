<?php

declare(strict_types=1);

namespace Modules\Plugins\Core;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\HtmlHead;
use App\Libraries\RssFeed;
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
use Override;

/**
 * @property string $key
 * @property string $iconSrc
 */
abstract class BasePlugin implements PluginInterface
{
    protected string $key;

    protected string $iconSrc;

    protected PluginStatus $status;

    protected Manifest $manifest;

    protected ?string $readmeHTML;

    protected ?string $licenseHTML;

    public function __construct(
        protected string $vendor,
        protected string $package,
        protected string $directory
    ) {
        $this->key = sprintf('%s/%s', $vendor, $package);

        // TODO: cache manifest data
        $manifestPath = $directory . '/manifest.json';

        $this->manifest = new Manifest($this->key);
        $this->manifest->loadFromFile($manifestPath);

        // check compatibility with Castopod version
        if ($this->manifest->minCastopodVersion !== null && version_compare(
            CP_VERSION,
            $this->manifest->minCastopodVersion,
            '<'
        )) {
            $this->status = PluginStatus::INCOMPATIBLE;
        } else {
            $this->status = get_plugin_setting($this->key, 'active') ? PluginStatus::ACTIVE : PluginStatus::INACTIVE;
        }

        $this->iconSrc = $this->loadIcon($directory . '/icon.svg');

        $this->readmeHTML = $this->loadMarkdownAsHTML($directory . '/README.md');

        $this->licenseHTML = $this->loadMarkdownAsHTML($directory . '/LICENSE.md');
    }

    /**
     * @param list<string>|string $value
     */
    public function __set(string $name, array|string $value): void
    {
        $this->{$name} = $value;
    }

    #[Override]
    public function rssBeforeChannel(Podcast $podcast): void
    {
    }

    #[Override]
    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
    }

    #[Override]
    public function rssBeforeItem(Episode $episode): void
    {
    }

    #[Override]
    public function rssAfterItem(Episode $episode, RssFeed $item): void
    {
    }

    #[Override]
    public function siteHead(HtmlHead $head): void
    {
    }

    final public function getGeneralSetting(string $key): mixed
    {
        return get_plugin_setting($this->key, $key);
    }

    final public function getPodcastSetting(int $podcastId, string $key): mixed
    {
        return get_plugin_setting($this->key, $key, ['podcast', $podcastId]);
    }

    final public function getEpisodeSetting(int $episodeId, string $key): mixed
    {
        return get_plugin_setting($this->key, $key, ['episode', $episodeId]);
    }

    final public function clearCache(): void
    {
        foreach ($this->getHooks() as $hook) {
            foreach (Plugins::CACHE_MAP[$hook] ?? [] as $cacheGlob) {
                cache()->deleteMatching($cacheGlob);
            }
        }
    }

    /**
     * @return bool true on success, false on failure
     */
    final public function activate(): bool
    {
        if ($this->status === PluginStatus::ACTIVE) {
            return false;
        }

        $this->setStatus(PluginStatus::ACTIVE);

        if ($this->status === PluginStatus::INACTIVE) {
            return false;
        }

        set_plugin_setting($this->key, 'active', true);
        return true;
    }

    final public function deactivate(): bool
    {
        if ($this->status !== PluginStatus::ACTIVE) {
            return false;
        }

        $this->setStatus(PluginStatus::INACTIVE);
        set_plugin_setting($this->key, 'active', false);

        return true;
    }

    final public function getStatus(): PluginStatus
    {
        return $this->status;
    }

    final public function getDirectory(): string
    {
        return $this->directory;
    }

    /**
     * @return array<string,string>
     */
    final public function getManifestErrors(): array
    {
        return Manifest::getPluginErrors($this->key);
    }

    final public function isHookDeclared(string $name): bool
    {
        return in_array($name, $this->manifest->hooks, true);
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

    /**
     * @return Field[]
     */
    final public function getSettingsFields(string $type): array
    {
        $settings = $this->manifest->settings;
        if (! $settings instanceof Settings) {
            return [];
        }

        return $settings->{$type};
    }

    final public function getMinCastopodVersion(): string
    {
        return $this->manifest->minCastopodVersion ?? '';
    }

    /**
     * @return list<string>
     */
    final public function getHooks(): array
    {
        return $this->manifest->hooks;
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

    final public function getTitle(): string
    {
        $key = sprintf('Plugin.%s.title', $this->key);
        /** @var string $title */
        $title = lang($key);

        if ($title === $key) {
            return $this->manifest->name;
        }

        return $title;
    }

    final public function getDescription(): string
    {
        $key = sprintf('Plugin.%s.description', $this->key);

        /** @var string $description */
        $description = lang($key);

        if ($description === $key) {
            return esc($this->manifest->description);
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

    final public function getLicenseHTML(): ?string
    {
        return $this->licenseHTML;
    }

    /**
     * @param PluginStatus::ACTIVE|PluginStatus::INACTIVE $value
     */
    final protected function setStatus(PluginStatus $value): self
    {
        if ($this->getManifestErrors() !== []) {
            $this->status = PluginStatus::INVALID;

            return $this;
        }

        $this->status = $value;

        return $this;
    }

    final protected function getOption(string $option): mixed
    {
        return get_plugin_setting($this->key, $option);
    }

    final protected function setOption(string $option, mixed $value = null): void
    {
        set_plugin_setting($this->key, $option, $value);
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

    private function loadMarkdownAsHTML(string $path): ?string
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
