<?php

namespace CodePress\CodeUser\Tests;

use CodePress\CodeUser\Event\UserCreatedEvent;
use CodePress\CodeUser\Models\Permission;
use CodePress\CodeUser\Models\Role;
use CodePress\CodeUser\Models\User;
use CodePress\CodeUser\Repository\PermissionRepositoryInterface;
use CodePress\CodeUser\Repository\RoleRepositoryInterface;
use CodePress\CodeUser\Repository\UserRepositoryInterface;
use CodePress\CodeUser\Tests\AbstractTestCase;
use Illuminate\Support\Facades\Hash;

class AuthorizationRepositoryTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_can_create_user()
    {
        $user = $this->createUser();

        $this->assertEquals('Test', $user->name);
        $this->assertEquals('test@test.com', $user->email);
        $this->assertTrue(Hash::check('123456', $user->password));
    }

    public function test_can_create_role()
    {
        $this->createUser();
        $this->createRoles();

        $this->assertCount(3, $this->app->make(RoleRepositoryInterface::class)->all());
        $this->app->make(UserRepositoryInterface::class)->addRoles(1, [1, 2, 3]);
        $this->assertCount(3, User::find(1)->roles);
        $this->assertCount(1, Role::find(1)->users);
        $this->assertTrue(User::find(1)->isAdmin());
    }

    public function test_can_create_permissions()
    {
        $this->createRoles();
        $this->createPermissions();

        $this->assertCount(3, $this->app->make(PermissionRepositoryInterface::class)->all());
        $this->app->make(RoleRepositoryInterface::class)->addPermissions(1, [1, 2]);
        $this->app->make(RoleRepositoryInterface::class)->addPermissions(2, [1]);
        $this->app->make(RoleRepositoryInterface::class)->addPermissions(3, [1, 2, 3]);
        $this->assertCount(1, Role::find(2)->permissions);
        $this->assertCount(2, Role::find(1)->permissions);
        $this->assertCount(3, Role::find(3)->permissions);
        $this->assertCount(3, Permission::find(1)->roles);
    }

    private function createUser()
    {
        $this->expectsEvents(UserCreatedEvent::class);

        return $this->app->make(UserRepositoryInterface::class)->create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => '123456'
        ]);
    }

    protected function createRoles()
    {
        $this->app->make(RoleRepositoryInterface::class)->create(['name' => 'Admin']);
        $this->app->make(RoleRepositoryInterface::class)->create(['name' => 'Editor']);
        $this->app->make(RoleRepositoryInterface::class)->create(['name' => 'Redactor']);
    }

    protected function createPermissions()
    {
        $this->app->make(PermissionRepositoryInterface::class)->create(['name' => 'insert']);
        $this->app->make(PermissionRepositoryInterface::class)->create(['name' => 'update']);
        $this->app->make(PermissionRepositoryInterface::class)->create(['name' => 'remove']);
    }
}
