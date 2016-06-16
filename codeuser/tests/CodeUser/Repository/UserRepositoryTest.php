<?php

namespace CodePress\CodeUser\Tests;

use CodePress\CodeUser\Event\UserCreatedEvent;
use CodePress\CodeUser\Repository\UserRepositoryInterface;
use CodePress\CodeUser\Tests\AbstractTestCase;
use Illuminate\Support\Facades\Hash;

class UserRepositoryTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_can_create_user()
    {
        $this->expectsEvents(UserCreatedEvent::class);

        $user = $this->app->make(UserRepositoryInterface::class)->create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $this->assertEquals('Test', $user->name);
        $this->assertEquals('test@test.com', $user->email);
        $this->assertTrue(Hash::check('123456', $user->password));
    }
}
