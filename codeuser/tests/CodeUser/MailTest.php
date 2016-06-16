<?php

namespace CodePress\CodeUser\Tests;

use CodePress\CodeUser\Repository\UserRepositoryInterface;
use Illuminate\Support\Facades\Hash;

class MailTest extends AbstractMailTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_can_create_user()
    {
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
