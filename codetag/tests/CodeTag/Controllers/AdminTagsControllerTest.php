<?php

namespace CodePress\CodeTag\Tests\Controllers;

use CodePress\CodeTag\Controllers\AdminTagsController;
use CodePress\CodeTag\Controllers\Controller;
use CodePress\CodeTag\Models\Tag;
use CodePress\CodeTag\Tests\AbstractTestCase;
use Illuminate\Contracts\Routing\ResponseFactory;
use Mockery as m;


class AdminTagsControllerTest extends AbstractTestCase
{
    public function test_should_extend_from_controller()
    {
        $tag = m::mock(Tag::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagsController($responseFactory, $tag);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_runt_index_method_and_return_correct_arguments()
    {
        $tag = m::mock(Tag::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminTagsController($responseFactory, $tag);
        $html = m::mock();

        $tagsResult = ['tag1', 'tag2'];
        $tag->shouldReceive('all')->andReturn($tagsResult);

        $responseFactory->shouldReceive('view')
            ->with('codetag::index', ['tags' => $tagsResult])
            ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }
}