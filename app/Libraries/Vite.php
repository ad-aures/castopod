<?php

declare(strict_types=1);

namespace App\Libraries;

class Vite
{
    protected string $manifestPath = 'assets/manifest.json';

    protected string $manifestCSSPath = 'assets/manifest-css.json';

    /**
     * @var array<string, mixed>
     */
    protected ?array $manifestData = null;

    /**
     * @var array<string, mixed>
     */
    protected ?array $manifestCSSData = null;

    public function asset(string $path, string $type): string
    {
        if (ENVIRONMENT !== 'production') {
            return $this->loadDev($path, $type);
        }

        // @phpstan-ignore-next-line
        return $this->loadProd($path, $type);
    }

    private function loadDev(string $path, string $type): string
    {
        return $this->getHtmlTag("http://localhost:3000/assets/{$path}", $type);
    }

    private function loadProd(string $path, string $type): string
    {
        if ($type === 'css') {
            if ($this->manifestCSSData === null) {
                $cacheName = 'vite-manifest-css';
                if (! ($cachedManifestCSS = cache($cacheName))) {
                    if (($manifestCSSContent = file_get_contents($this->manifestCSSPath)) !== false) {
                        $cachedManifestCSS = json_decode($manifestCSSContent, true);
                        cache()
                            ->save($cacheName, $cachedManifestCSS, DECADE);
                    } else {
                        // ERROR when getting the manifest-css file
                        $manifestCSSPath = $this->manifestCSSPath;
                        die("Could not load Vite's <pre>{$manifestCSSPath}</pre> file.");
                    }
                }
                $this->manifestCSSData = $cachedManifestCSS;
            }

            if (array_key_exists($path, $this->manifestCSSData)) {
                return $this->getHtmlTag('/assets/' . $this->manifestCSSData[$path]['file'], 'css');
            }
        }

        if ($this->manifestData === null) {
            $cacheName = 'vite-manifest';
            if (! ($cachedManifest = cache($cacheName))) {
                if (($manifestContents = file_get_contents($this->manifestPath)) !== false) {
                    $cachedManifest = json_decode($manifestContents, true);
                    cache()
                        ->save($cacheName, $cachedManifest, DECADE);
                } else {
                    // ERROR when retrieving the manifest file
                    $manifestPath = $this->manifestPath;
                    die("Could not load Vite's <pre>{$manifestPath}</pre> file.");
                }
            }
            $this->manifestData = $cachedManifest;
        }

        $html = '';
        if (array_key_exists($path, $this->manifestData)) {
            $manifestElement = $this->manifestData[$path];

            // import css dependencies if any
            if (array_key_exists('css', $manifestElement)) {
                foreach ($manifestElement['css'] as $cssFile) {
                    $html .= $this->getHtmlTag('/assets/' . $cssFile, 'css');
                }
            }

            // import dependencies first for faster js loading
            if (array_key_exists('imports', $manifestElement)) {
                foreach ($manifestElement['imports'] as $importPath) {
                    if (array_key_exists($importPath, $this->manifestData)) {
                        $html .= $this->getHtmlTag('/assets/' . $this->manifestData[$importPath]['file'], 'js');
                    }
                }
            }

            $html .= $this->getHtmlTag('/assets/' . $manifestElement['file'], $type);
        }

        return $html;
    }

    private function getHtmlTag(string $assetUrl, string $type): string
    {
        return match ($type) {
            'css' => <<<CODE_SAMPLE
                <link rel="stylesheet" href="{$assetUrl}"/>
            CODE_SAMPLE
,
            'js' => <<<CODE_SAMPLE
                    <script type="module" src="{$assetUrl}"></script>
                CODE_SAMPLE
,
            default => '',
        };
    }
}
