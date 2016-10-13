<?php

namespace CodePress\CodeUser\Tests\Controllers;

use CodePress\CodeUser\Controllers\Admin\UsersController;
use CodePress\CodeUser\Controllers\Controller;
use CodePress\CodeUser\Repository\RoleRepositoryEloquent;
use CodePress\CodeUser\Repository\UserRepositoryEloquent;
use CodePress\CodeUser\Tests\AbstractTestCase;
use Illuminate\Contracts\Routing\ResponseFactory;
use Mockery as m;

class UsersControllerTest extends AbstractTestCase
{
    public function test_should_extend_from_controller()
    {
        $responseFactory = m::mock(ResponseFactory::class);
        $userRepository = m::mock(UserRepositoryEloquent::class);
        $roleRepository = m::mock(RoleRepositoryEloquent::class);
        $controller = new UsersController($responseFactory, $userRepository, $roleRepository);

        $this->assertInstanceOf(Controller::class, $controller);
    }

    public function test_controller_should_runt_index_method_and_return_correct_arguments()
    {
        $responseFactory = m::mock(ResponseFactory::class);
        $userRepository = m::mock(UserRepositoryEloquent::class);
        $roleRepository = m::mock(RoleRepositoryEloquent::class);
        $controller = new UsersController($responseFactory, $userRepository, $roleRepository);
        $html = m::mock();

        $usersResult = ['user1', 'user2'];
        $userRepository->shouldReceive('all')->andReturn($usersResult);

        $responseFactory->shouldReceive('view')
            ->with('codeuser::admin.user.index', ['users' => $usersResult])
            ->andReturn($html);

        $this->assertEquals($controller->index(), $html);
    }
}
