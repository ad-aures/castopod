<?php

declare(strict_types=1);

namespace App\Libraries;

use CodeIgniter\Debug\Toolbar\Collectors\Views;
use CodeIgniter\Filters\DebugToolbar;
use CodeIgniter\View\Exceptions\ViewException;
use CodeIgniter\View\View as CodeIgniterView;
use Config\Toolbar;

class View extends CodeIgniterView
{
    /**
     * Builds the output based upon a file name and any
     * data that has already been set.
     *
     * Valid $options:
     *  - cache      Number of seconds to cache for
     *  - cache_name Name to use for cache
     *
     * @param string     $view     File name of the view source
     * @param array<string, mixed>|null $options  Reserved for 3rd-party uses since
     *                             it might be needed to pass additional info
     *                             to other template engines.
     * @param bool|null  $saveData If true, saves data for subsequent calls,
     *                             if false, cleans the data after displaying,
     *                             if null, uses the config setting.
     */
    public function render(string $view, ?array $options = null, ?bool $saveData = null): string
    {
        $this->renderVars['start'] = microtime(true);

        // Store the results here so even if
        // multiple views are called in a view, it won't
        // clean it unless we mean it to.
        $saveData = $saveData ?? $this->saveData;
        $fileExt = pathinfo($view, PATHINFO_EXTENSION);
        $realPath = $fileExt === '' ? $view . '.php' : $view; // allow Views as .html, .tpl, etc (from CI3)
        $this->renderVars['view'] = $realPath;
        $this->renderVars['options'] = $options ?? [];

        // Was it cached?
        if (isset($this->renderVars['options']['cache'])) {
            $cacheName = $this->renderVars['options']['cache_name'] ?? str_replace(
                '.php',
                '',
                $this->renderVars['view']
            );
            $cacheName = str_replace(['\\', '/'], '', $cacheName);

            $this->renderVars['cacheName'] = $cacheName;

            if ($output = cache($this->renderVars['cacheName'])) {
                $this->logPerformance($this->renderVars['start'], microtime(true), $this->renderVars['view']);

                return $output;
            }
        }

        $this->renderVars['file'] = $this->viewPath . $this->renderVars['view'];

        if (! is_file($this->renderVars['file'])) {
            $this->renderVars['file'] = $this->loader->locateFile(
                $this->renderVars['view'],
                'Views',
                $fileExt === '' ? 'php' : $fileExt
            );
        }

        // locateFile will return an empty string if the file cannot be found.
        if ($this->renderVars['file'] === '') {
            throw ViewException::forInvalidFile($this->renderVars['view']);
        }

        // Make our view data available to the view.
        $this->tempData = $this->tempData ?? $this->data;

        if ($saveData) {
            $this->data = $this->tempData;
        }

        // Save current vars
        $renderVars = $this->renderVars;

        $output = (function (): string {
            /** @phpstan-ignore-next-line */
            extract($this->tempData);
            ob_start();
            include $this->renderVars['file'];

            return ob_get_clean() ?: '';
        })();

        // Get back current vars
        $this->renderVars = $renderVars;

        // When using layouts, the data has already been stored
        // in $this->sections, and no other valid output
        // is allowed in $output so we'll overwrite it.
        if ($this->layout !== null && $this->sectionStack === []) {
            $layoutView = $this->layout;
            $this->layout = null;
            // Save current vars
            $renderVars = $this->renderVars;
            $output = $this->render($layoutView, $options, $saveData);
            // Get back current vars
            $this->renderVars = $renderVars;
        }

        $output = service('components')
            ->setCurrentView($this->renderVars['file'])
            ->render($output);

        $this->logPerformance($this->renderVars['start'], microtime(true), $this->renderVars['view']);

        if (($this->debug && (! isset($options['debug']) || $options['debug'] === true))
            && in_array(DebugToolbar::class, service('filters')->getFiltersClass()['after'], true)
        ) {
            $toolbarCollectors = config(Toolbar::class)->collectors;

            if (in_array(Views::class, $toolbarCollectors, true)) {
                // Clean up our path names to make them a little cleaner
                $this->renderVars['file'] = clean_path($this->renderVars['file']);
                $this->renderVars['file'] = ++$this->viewsCount . ' ' . $this->renderVars['file'];

                $output = '<!-- DEBUG-VIEW START ' . $this->renderVars['file'] . ' -->' . PHP_EOL
                    . $output . PHP_EOL
                    . '<!-- DEBUG-VIEW ENDED ' . $this->renderVars['file'] . ' -->' . PHP_EOL;
            }
        }

        // Should we cache?
        if (isset($this->renderVars['options']['cache'])) {
            cache()->save($this->renderVars['cacheName'], $output, (int) $this->renderVars['options']['cache']);
        }

        $this->tempData = null;

        return $output;
    }
}
