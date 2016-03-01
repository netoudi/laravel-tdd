<?php

namespace CodePress\CodeTag\Tests\Controllers;

use CodePress\CodeTag\Controllers\AdminTagsController;
use CodePress\CodeTag\Controllers\Controller;
use CodePress\CodeTag\Repository\TagRepository;
use CodePress\CodeTag\Tests\AbstractTestCase;
use Illuminate\Contracts\Routing\ResponseFactory;
use Mockery as m;


class AdminTagsControllerTest extends AbstractTestCase
{
    public function test_should_extend_from_controller()
    {
        $tagRepository = m::mock(TagRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagsController($responseFactory, $tagRepository);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_runt_index_method_and_return_correct_arguments()
    {
        $tagRepository = m::mock(TagRepository::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagsController($responseFactory, $tagRepository);
        $html = m::mock();

        $tagsResult = ['tag1', 'tag2'];
        $tagRepository->shouldReceive('all')->andReturn($tagsResult);

        $responseFactory->shouldReceive('view')
            ->with('codetag::index', ['tags' => $tagsResult])
            ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }
}