<?php

declare(strict_types=1);

namespace Tests\Database;

use CodeIgniter\Database\Seeder;
use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\DatabaseTestTrait;
use Tests\Support\Database\Seeds\ExampleSeeder;
use Tests\Support\Models\ExampleModel;

class ExampleDatabaseTest extends CIUnitTestCase
{
    use DatabaseTestTrait;

    /**
     * @var class-string<Seeder>|list<class-string<Seeder>>
     */
    protected $seed = ExampleSeeder::class;

    public function testModelFindAll(): void
    {
        $model = new ExampleModel();

        // Get every row created by ExampleSeeder
        $objects = $model->findAll();

        // Make sure the count is as expected
        $this->assertCount(3, $objects);
    }

    public function testSoftDeleteLeavesRow(): void
    {
        $model = new ExampleModel();
        $this->setPrivateProperty($model, 'useSoftDeletes', true);
        $this->setPrivateProperty($model, 'tempUseSoftDeletes', true);

        $object = $model->first();

        if (! is_object($object)) {
            return;
        }

        $model->delete($object->id);

        // The model should no longer find it
        $this->assertNull($model->find($object->id));

        // ... but it should still be in the database
        $result = $model
            ->builder()
            ->where('id', $object->id)
            ->get()
            ->getResult();

        $this->assertCount(1, $result);
    }
}
