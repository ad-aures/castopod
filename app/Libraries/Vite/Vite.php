<?php

declare(strict_types=1);

namespace Vite;

use ErrorException;

class Vite
{
    /**
     * @var array<string, mixed>|null
     */
    protected ?array $manifestData = null;

    /**
     * @var array<string, mixed>|null
     */
    protected ?array $manifestCSSData = null;

    public function asset(string $path, string $type): string
    {
        if (config('Vite')->environment !== 'production') {
            return $this->loadDev($path, $type);
        }

        return $this->loadProd($path, $type);
    }

    private function loadDev(string $path, string $type): string
    {
        return $this->getHtmlTag(config('Vite')->baseUrl . config('Vite')->assetsRoot . "/{$path}", $type);
    }

    private function loadProd(string $path, string $type): string
    {
        if ($this->manifestData === null) {
            $cacheName = 'vite-manifest';
            if (! ($cachedManifest = cache($cacheName))) {
                $manifestPath = config('Vite')
                    ->assetsRoot . '/' . config('Vite')
                    ->manifestFile;
                try {
                    if (($manifestContents = file_get_contents($manifestPath)) !== false) {
                        $cachedManifest = json_decode($manifestContents, true);
                        cache()
                            ->save($cacheName, $cachedManifest, DECADE);
                    }
                } catch (ErrorException) {
                    // ERROR when retrieving the manifest file
                    die("Could not load manifest: <strong>{$manifestPath}</strong> file not found!");
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
                    $html .= $this->getHtmlTag('/' . config('Vite')->assetsRoot . '/' . $cssFile, 'css');
                }
            }

            // import dependencies first for faster js loading
            if (array_key_exists('imports', $manifestElement)) {
                foreach ($manifestElement['imports'] as $importPath) {
                    if (array_key_exists($importPath, $this->manifestData)) {
                        
                        // import css dependencies if any
                        if (array_key_exists('css', $this->manifestData[$importPath])) {
                            foreach ($this->manifestData[$importPath]['css'] as $cssFile) {
                                $html .= $this->getHtmlTag('/' . config('Vite')->assetsRoot . '/' . $cssFile, 'css');
                            }
                        }

                        $html .= $this->getHtmlTag(
                            '/' . config('Vite')->assetsRoot . '/' . $this->manifestData[$importPath]['file'],
                            'js'
                        );
                    }
                }
            }

            $html .= $this->getHtmlTag('/' . config('Vite')->assetsRoot . '/' . $manifestElement['file'], $type);
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
