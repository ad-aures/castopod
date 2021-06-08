<?php

declare(strict_types=1);

namespace Tests\Support;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\ExampleSeeder;

/**
 * @phpstan-ignore-next-line
 */
class DatabaseTestCase extends CIUnitTestCase
{
    use DatabaseTestTrait;

    /**
     * Should the database be refreshed before each test?
     *
     * @var boolean
     */
    protected $refresh = true;

    /**
     * The seed file(s) used for all tests within this test case. Should be fully-namespaced or relative to $basePath
     *
     * @var string|string[]
     */
    protected $seed = ExampleSeeder::class;

    /**
     * The path to the seeds directory. Allows overriding the default application directories.
     *
     * @var string
     */
    protected $basePath = SUPPORTPATH . 'Database/';

    /**
     * The namespace(s) to help us find the migration classes. Empty is equivalent to running `spark migrate -all`. Note
     * that running "all" runs migrations in date order, but specifying namespaces runs them in namespace order (then
     * date)
     *
     * @var string|string[]|null
     */
    protected $namespace = 'Tests\Support';

    protected function setUp(): void
    {
        parent::setUp();

        // Extra code to run before each test
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        // Extra code to run after each test
    }
}
