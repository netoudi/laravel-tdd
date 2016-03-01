<?php

namespace CodePress\CodeDatabase\Tests;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Models\Category;
use CodePress\CodeDatabase\Repository\CategoryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Mockery as m;

class CategoryRepositoryTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_can_model()
    {
        $repository = new CategoryRepository();
        $this->assertEquals(Category::class, $repository->model());
    }
}