<?php

namespace CodePress\CodeDatabase\Tests;

use CodePress\CodeDatabase\Contracts\CriteriaCollectionInterface;
use CodePress\CodeDatabase\Contracts\CriteriaInterface;
use CodePress\CodeDatabase\Criteria\FindByNameAndDescription;
use CodePress\CodeDatabase\Models\Category;
use CodePress\CodeDatabase\Repository\CategoryRepository;
use Mockery as m;

class CategoryRepositoryCriteriaTest extends AbstractTestCase
{
    /**
     * @var CategoryRepository
     */
    private $repository;

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
        $this->repository = new CategoryRepository();
        $this->createCategory();
    }

    public function test_if_instanceof_criteriacollectioninterface()
    {
        $this->assertInstanceOf(CriteriaCollectionInterface::class, $this->repository);
    }

    public function test_can_get_criteria_collection()
    {
        $result = $this->repository->getCriteriaCollection();
        $this->assertCount(0, $result);
    }

    public function test_can_add_criteria()
    {
        $mockCriteria = m::mock(CriteriaInterface::class);
        $result = $this->repository->addCriteria($mockCriteria);
        $this->assertInstanceOf(CategoryRepository::class, $result);
        $this->assertCount(1, $this->repository->getCriteriaCollection());
    }

    public function test_can_get_by_criteria()
    {
        $criteria = new FindByNameAndDescription('Category 1', 'Description 1');
        $repository = $this->repository->getByCriteria($criteria);
        $this->assertInstanceOf(CategoryRepository::class, $repository);

        $result = $repository->all();
        $this->assertCount(1, $result);

        $result = $result->first();
        $this->assertEquals($result->name, 'Category 1');
        $this->assertEquals($result->description, 'Description 1');
    }

    private function createCategory()
    {
        Category::create([
            'name' => 'Category 1',
            'description' => 'Description 1'
        ]);
        Category::create([
            'name' => 'Category 2',
            'description' => 'Description 2'
        ]);
        Category::create([
            'name' => 'Category 3',
            'description' => 'Description 3'
        ]);
    }
}