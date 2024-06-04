<?php

declare(strict_types=1);

namespace Tests\Modules\Plugins;

use CodeIgniter\Test\CIUnitTestCase;
use Modules\Plugins\Manifest\Manifest;

/**
 * @internal
 */
final class ManifestTest extends CIUnitTestCase
{
    public function testLoadRequiredData(): void
    {
        $manifest = new Manifest('acme/hello-world');

        // properties have not been set yet
        $this->assertNotEquals($manifest->name, 'acme/hello-world');
        $this->assertNotEquals($manifest->version, '1.0.0');

        $manifest->loadFromFile(TESTPATH . 'modules/Plugins/mocks/manifests/manifest-required.json');

        // no errors
        $this->assertEmpty($manifest->getPluginErrors('acme/hello-world'));

        // properties have been set
        $this->assertEquals($manifest->name, 'acme/hello-world');
        $this->assertEquals($manifest->version, '1.0.0');
    }

    public function testLoadEmptyData(): void
    {
        $manifest = new Manifest('acme/hello-world');

        $manifest->loadFromFile(TESTPATH . 'modules/Plugins/mocks/manifests/manifest-empty.json');

        $errors = $manifest->getPluginErrors('acme/hello-world');

        $this->assertCount(2, $errors);

        // missing required name and version
        $this->assertArrayHasKey('name', $errors);
        $this->assertArrayHasKey('version', $errors);
    }

    public function testLoadValidData(): void
    {
        $manifest = new Manifest('acme/hello-world');

        $manifest->loadFromFile(TESTPATH . 'modules/Plugins/mocks/manifests/manifest-full-valid.json');

        // no errors
        $this->assertEmpty($manifest->getPluginErrors('acme/hello-world'));
    }

    public function testLoadInvalidData(): void
    {
        $manifest = new Manifest('acme/hello-world');

        $manifest->loadFromFile(TESTPATH . 'modules/Plugins/mocks/manifests/manifest-full-invalid.json');

        // errors
        $this->assertNotEmpty($manifest->getPluginErrors('acme/hello-world'));
    }
}
