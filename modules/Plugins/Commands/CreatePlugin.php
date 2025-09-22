<?php

declare(strict_types=1);

namespace Modules\Plugins\Commands;

use CodeIgniter\CLI\CLI;
use Exception;
use Modules\Plugins\Config\Plugins as PluginsConfig;
use Modules\Plugins\Core\Plugins;
use Modules\Plugins\Manifest\Manifest;
use Override;

class CreatePlugin extends BaseCommand
{
    protected const HOOKS_IMPORTS = [
        'rssBeforeChannel' => ['use App\Entities\Podcast;'],
        'rssAfterChannel'  => ['use App\Entities\Podcast;', 'use App\Libraries\RssFeed;'],
        'rssBeforeItem'    => ['use App\Entities\Episode;'],
        'rssAfterItem'     => ['use App\Entities\Episode;', 'use App\Libraries\RssFeed;'],
        'siteHead'         => ['use use App\Libraries\HtmlHead'],
    ];

    protected const HOOKS_METHODS = [
        'rssBeforeChannel' => '    public function rssBeforeChannel(Podcast $podcast): void
    {
        // YOUR CODE HERE
    }',
        'rssAfterChannel' => '    public function rssAfterChannel(Podcast $podcast, RssFeed $channel): void
    {
        // YOUR CODE HERE
    }',
        'rssBeforeItem' => '    public function rssBeforeItem(Episode $episode): void
    {
        // YOUR CODE HERE
    }',
        'rssAfterItem' => '    public function rssAfterItem(Episode $episode, RssFeed $item): void
    {
        // YOUR CODE HERE
    }',
        'siteHead' => '    public function siteHead(HtmlHead $head): void
    {
        // YOUR CODE HERE
    }',
    ];

    /**
     * @var string
     */
    protected $name = 'plugins:create';

    /**
     * @var string
     */
    protected $description = 'Generates a new plugin folder based on a template.';

    /**
     * Actually execute a command.
     *
     * @param list<string> $params
     */
    #[Override]
    public function run(array $params): void
    {
        $pluginName = CLI::prompt(
            'Plugin name (<vendor>/<name>)',
            'acme/hello-world',
            Manifest::$validation_rules['name'],
        );
        CLI::newLine();
        $description = CLI::prompt('Description', '', Manifest::$validation_rules['description']);
        CLI::newLine();
        $license = CLI::prompt('License', 'UNLICENSED', Manifest::$validation_rules['license']);
        CLI::newLine();
        $hooks = CLI::promptByMultipleKeys('Which hooks do you want to implement?', Plugins::HOOKS);

        $nameParts = explode('/', $pluginName);
        $vendor = $nameParts[0];
        $name = $nameParts[1];

        /** @var PluginsConfig $pluginsConfig */
        $pluginsConfig = config('Plugins');

        // 1. create plugin directory if not existent
        $pluginDirectory = $pluginsConfig->folder . $vendor . DIRECTORY_SEPARATOR . $name;
        if (! file_exists($pluginDirectory)) {
            mkdir($pluginDirectory, 0755, true);
        }

        // 2. get contents of templates
        $manifestTemplate = file_get_contents(__DIR__ . '/plugin-template/manifest.tpl.json');

        if (! $manifestTemplate) {
            throw new Exception('Failed to get manifest template.');
        }

        $pluginClassTemplate = file_get_contents(__DIR__ . '/plugin-template/Plugin.tpl.php');

        if (! $pluginClassTemplate) {
            throw new Exception('Failed to get Plugin class template.');
        }

        // 3. edit templates' contents
        $manifestContents = str_replace('"name": ""', '"name": "' . $pluginName . '"', $manifestTemplate);
        $manifestContents = str_replace(
            '"description": ""',
            '"description": "' . $description . '"',
            $manifestContents,
        );
        $manifestContents = str_replace('"license": ""', '"license": "' . $license . '"', $manifestContents);
        $manifestContents = str_replace(
            '"hooks": []',
            '"hooks": ["' . implode('", "', $hooks) . '"]',
            $manifestContents,
        );

        $pluginClassName = str_replace(
            ' ',
            '',
            ucwords(str_replace(['-', '_', '.'], ' ', $vendor . ' ' . $name)) . 'Plugin',
        );
        $pluginClassContents = str_replace('class Plugin', 'class ' . $pluginClassName, $pluginClassTemplate);

        $allImports = [];
        $allMethods = [];
        foreach ($hooks as $hook) {
            $allImports = [...$allImports, ...self::HOOKS_IMPORTS[$hook]];
            $allMethods = [...$allMethods, self::HOOKS_METHODS[$hook]];
        }

        $imports = implode(PHP_EOL, array_unique($allImports));
        $methods = implode(PHP_EOL . PHP_EOL, $allMethods);
        $pluginClassContents = str_replace('// IMPORTS_HERE', $imports, $pluginClassContents);
        $pluginClassContents = str_replace('    // HOOKS_HERE', $methods, $pluginClassContents);

        $manifest = $pluginDirectory . '/manifest.json';
        $pluginClass = $pluginDirectory . '/Plugin.php';

        if (! file_put_contents($manifest, $manifestContents)) {
            throw new Exception('Failed to create manifest.json file.');
        }

        if (! file_put_contents($pluginClass, $pluginClassContents)) {
            throw new Exception('Failed to create Plugin class file.');
        }

        CLI::newLine(1);
        CLI::write(
            sprintf('Plugin %s created in %s', CLI::color($pluginName, 'white'), CLI::color($pluginDirectory, 'white')),
            'green',
        );
    }
}
