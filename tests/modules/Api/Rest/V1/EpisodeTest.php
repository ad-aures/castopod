<?php

declare(strict_types=1);

namespace Tests\Modules\Api\Rest\V1;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use CodeIgniter\Test\FeatureTestTrait;
use Override;
use Tests\Support\Database\Seeds\FakeSinglePodcastApiSeeder;

class EpisodeTest extends CIUnitTestCase
{
    use FeatureTestTrait;
    use DatabaseTestTrait;

    /**
     * @var bool
     */
    protected $migrate = true;

    /**
     * @var bool
     */
    protected $migrateOnce = false;

    /**
     * @var string|null
     */
    protected $namespace;

    /**
     * @var class-string<Seeder>|list<class-string<Seeder>>
     */
    protected $seed = FakeSinglePodcastApiSeeder::class;

    /**
     * @var string
     */
    protected $basePath = 'app/Database';

    /**
     * @var array<string, mixed>
     */
    private array $episode = [];

    private string $apiUrl = '';

    #[Override]
    protected function setUp(): void
    {
        parent::setUp();

        $this->episode = FakeSinglePodcastApiSeeder::episode();

        $this->episode['created_at'] = [];
        $this->episode['updated_at'] = [];
        $this->apiUrl = config('RestApi')
            ->gateway;
    }

    #[Override]
    protected function tearDown(): void
    {
        parent::tearDown();

        restore_error_handler();
        restore_exception_handler();
    }

    public function testList(): void
    {
        $result = $this->call('get', $this->apiUrl . 'episodes');
        $result->assertStatus(200);
        $result->assertHeader('Content-Type', 'application/json; charset=UTF-8');
        $result->assertJSONFragment([
            0 => $this->episode,
        ]);
    }

    public function testView(): void
    {
        $result = $this->call('get', $this->apiUrl . 'episodes/1');
        $result->assertStatus(200);
        $result->assertHeader('Content-Type', 'application/json; charset=UTF-8');
        $result->assertJSONFragment($this->episode);
    }

    public function testViewNotFound(): void
    {
        $result = $this->call('get', $this->apiUrl . 'episodes/2');
        $result->assertStatus(404);
        $result->assertJSONExact(
            [
                'status'   => 404,
                'error'    => 404,
                'messages' => [
                    'error' => 'Episode not found',
                ],
            ],
        );
        $result->assertHeader('Content-Type', 'application/json; charset=UTF-8');
    }

    /*
    * Refreshing database to fetch empty array of episodes
    */
    public function testListEmpty(): void
    {
        $this->regressDatabase();
        $this->migrateDatabase();
        $result = $this->call('get', $this->apiUrl . 'episodes');
        $result->assertStatus(200);
        $result->assertHeader('Content-Type', 'application/json; charset=UTF-8');
        $result->assertJSONExact([]);
        $this->seed($this->seed);
    }
}
