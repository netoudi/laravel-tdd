<?php

namespace CodePress\CodeUser\Tests;

use CodePress\CodeUser\Models\User;
use CodePress\CodeUser\Repository\UserRepositoryEloquent;
use CodePress\CodeUser\Tests\AbstractTestCase;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Validator;
use Mockery as m;

class MailTest extends AbstractMailTestCase
{
    /**
     * @var UserRepositoryEloquent
     */
    private $repository;

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
        $this->repository = new UserRepositoryEloquent();
    }

    public function test_can_create_user()
    {
        $user = $this->repository->create([
            'name' => 'Test',
            'email' => 'test@test.com',
            'password' => '123456'
        ]);

        $this->assertEquals('Test', $user->name);
        $this->assertEquals('test@test.com', $user->email);
        $this->assertTrue(Hash::check('123456', $user->password));
    }
}