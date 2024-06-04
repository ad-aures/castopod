<?php

declare(strict_types=1);

namespace Tests\Modules\Plugins;

use App\Entities\Episode;
use App\Entities\Podcast;
use App\Libraries\SimpleRSSElement;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Modules\Plugins\Config\Plugins as PluginsConfig;
use Modules\Plugins\Core\Plugins;
use Modules\Plugins\Core\PluginStatus;
use Override;

/**
 * @internal
 */
final class PluginsTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    protected $migrate = true;

    protected $migrateOnce = false;

    protected $refresh = true;

    /**
     * @var string|null
     */
    protected $namespace;

    protected static Plugins $plugins;

    #[Override]
    public static function setUpBeforeClass(): void
    {
        $pluginsConfig = new PluginsConfig();
        $pluginsConfig->folder = __DIR__ . '/mocks/plugins' . DIRECTORY_SEPARATOR;

        self::$plugins = new Plugins($pluginsConfig);
    }

    public function testRegister(): void
    {
        $this->assertCount(7, self::$plugins->getAllPlugins());
        $this->assertEquals(7, self::$plugins->getInstalledCount());
        $this->assertEquals(0, self::$plugins->getActiveCount());
    }

    public function testActivateDeactivate(): void
    {
        $this->assertEquals(0, self::$plugins->getActiveCount());

        $plugin = self::$plugins->getAllPlugins()[0];

        // get first plugin and activate it
        self::$plugins->activate($plugin);

        $this->assertEquals(1, self::$plugins->getActiveCount());
        $this->assertEquals(PluginStatus::ACTIVE, $plugin->getStatus());
        $this->seeInDatabase('settings', [
            'class'   => PluginsConfig::class,
            'key'     => 'active',
            'value'   => '1',
            'type'    => 'boolean',
            'context' => 'plugin:' . $plugin->getKey(),
        ]);

        // get first plugin and deactivate it
        self::$plugins->deactivate($plugin);

        $this->assertEquals(0, self::$plugins->getActiveCount());
        $this->assertEquals(PluginStatus::INACTIVE, $plugin->getStatus());
        $this->seeInDatabase('settings', [
            'class'   => PluginsConfig::class,
            'key'     => 'active',
            'value'   => '0',
            'type'    => 'boolean',
            'context' => 'plugin:' . $plugin->getKey(),
        ]);
    }

    public function testRunHooksActive(): void
    {
        $acmeAllHooksPlugin = self::$plugins->getPlugin('acme', 'all-hooks');

        self::$plugins->activate($acmeAllHooksPlugin);

        $this->assertEquals(1, self::$plugins->getActiveCount());

        $podcast = new Podcast();
        $this->assertEquals('', $podcast->title);
        self::$plugins->runHook('rssBeforeChannel', [$podcast]);
        $this->assertEquals('Podcast test', $podcast->title);

        $channel = new SimpleRSSElement('<channel></channel>');
        $this->assertTrue(empty($channel->foo));
        self::$plugins->runHook('rssAfterChannel', [$podcast, $channel]);
        $this->assertFalse(empty($channel->foo));

        $episode = new Episode();
        $this->assertEquals('', $episode->title);
        self::$plugins->runHook('rssBeforeItem', [$episode]);
        $this->assertEquals('Episode test', $episode->title);

        $item = new SimpleRSSElement('<item></item>');
        $this->assertTrue(empty($item->efoo));
        self::$plugins->runHook('rssAfterItem', [$episode, $item]);
        $this->assertFalse(empty($item->efoo));

        ob_start();
        self::$plugins->runHook('siteHead', []);
        $result = ob_get_contents();
        ob_end_clean(); //Discard output buffer
        $this->assertEquals('hello', $result);
    }

    public function testRunHooksInactive(): void
    {
        $acmeAllHooksPlugin = self::$plugins->getPlugin('acme', 'all-hooks');

        self::$plugins->deactivate($acmeAllHooksPlugin);

        $this->assertEquals(0, self::$plugins->getActiveCount());

        // nothing should change when running hooks as the plugin is inactive

        $podcast = new Podcast();
        $this->assertEquals('', $podcast->title);
        self::$plugins->runHook('rssBeforeChannel', [$podcast]);
        $this->assertEquals('', $podcast->title);

        $channel = new SimpleRSSElement('<channel></channel>');
        $this->assertTrue(empty($channel->foo));
        self::$plugins->runHook('rssAfterChannel', [$podcast, $channel]);
        $this->assertTrue(empty($channel->foo));

        $episode = new Episode();
        $this->assertEquals('', $episode->title);
        self::$plugins->runHook('rssBeforeItem', [$episode]);
        $this->assertEquals('', $episode->title);

        $item = new SimpleRSSElement('<item></item>');
        $this->assertTrue(empty($item->efoo));
        self::$plugins->runHook('rssAfterItem', [$episode, $item]);
        $this->assertTrue(empty($item->efoo));

        ob_start();
        self::$plugins->runHook('siteHead', []);
        $result = ob_get_contents();
        ob_end_clean(); //Discard output buffer
        $this->assertEquals('', $result);
    }

    public function testRunUndeclaredHook(): void
    {
        $acmeUndeclaredHookPlugin = self::$plugins->getPlugin('acme', 'undeclared-hook');

        self::$plugins->activate($acmeUndeclaredHookPlugin);

        $podcast = new Podcast();
        $this->assertEquals('', $podcast->title);
        self::$plugins->runHook('rssBeforeChannel', [$podcast]);
        $this->assertEquals('Podcast test undeclared', $podcast->title);

        // rssAfterChannel has not been declared in plugin manifest, should not be running
        $channel = new SimpleRSSElement('<channel></channel>');
        $this->assertTrue(empty($channel->foo));
        self::$plugins->runHook('rssAfterChannel', [$podcast, $channel]);
        $this->assertTrue(empty($channel->foo));
    }
}
