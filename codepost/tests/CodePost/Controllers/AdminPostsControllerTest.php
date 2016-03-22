<?php

namespace CodePress\CodePost\Tests\Controllers;

use CodePress\CodePost\Controllers\AdminPostsController;
use CodePress\CodePost\Controllers\Controller;
use CodePress\CodePost\Repository\PostRepositoryEloquent;
use CodePress\CodePost\Tests\AbstractTestCase;
use Illuminate\Contracts\Routing\ResponseFactory;
use Mockery as m;


class AdminPostsControllerTest extends AbstractTestCase
{
    public function test_should_extend_from_controller()
    {
        $postRepository = m::mock(PostRepositoryEloquent::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminPostsController($responseFactory, $postRepository);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_runt_index_method_and_return_correct_arguments()
    {
        $postRepository = m::mock(PostRepositoryEloquent::class);
        $responseFactory = m::mock(ResponseFactory::class);
        $controller = new AdminPostsController($responseFactory, $postRepository);
        $html = m::mock();

        $postsResult = ['cat1', 'cat2'];
        $postRepository->shouldReceive('all')->andReturn($postsResult);

        $responseFactory->shouldReceive('view')
            ->with('codepost::index', ['posts' => $postsResult])
            ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }
}