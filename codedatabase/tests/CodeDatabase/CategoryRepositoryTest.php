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

    public function test_can_makemodel()
    {
        $repository = new CategoryRepository();
        $result = $repository->makeModel();
        $this->isInstanceOf(Category::class, $result);

        $reflectionClass = new \ReflectionClass($repository);
        $reflectionProperty = $reflectionClass->getProperty('model');
        $reflectionProperty->setAccessible(true);

        $result = $reflectionProperty->getValue($repository);
        $this->isInstanceOf(Category::class, $result);
    }
}