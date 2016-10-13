<?php

namespace CodePress\CodeUser\Tests\Models;


use CodePress\CodeUser\Models\User;
use CodePress\CodeUser\Tests\AbstractTestCase;
use Illuminate\Validation\Validator;
use Mockery as m;

class UserTest extends AbstractTestCase
{

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_inject_validator_in_user_model()
    {
        $user = new User();
        $validator = m::mock(Validator::class);
        $user->setValidator($validator);

        $this->assertEquals($user->getValidator(), $validator);
    }

    public function test_should_check_if_it_is_valid_when_it_is()
    {
        $user = new User();
        $user->name = "User Test";

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        $validator->shouldReceive('setData')->with(['name' => 'User Test']);
        $validator->shouldReceive('fails')->andReturn(false);

        $user->setValidator($validator);

        $this->assertTrue($user->isValid());
    }

    public function test_should_check_if_it_is_invalid_when_it_is()
    {
        $user = new User();
        $user->name = "User Test";

        $messageBag = m::mock('Illuminate\Support\MessageBag');

        $validator = m::mock(Validator::class);
        $validator->shouldReceive('setRules')->with([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);
        $validator->shouldReceive('setData')->with(['name' => 'User Test']);
        $validator->shouldReceive('fails')->andReturn(true);
        $validator->shouldReceive('errors')->andReturn($messageBag);

        $user->setValidator($validator);

        $this->assertFalse($user->isValid());
        $this->assertEquals($messageBag, $user->errors);
    }

    public function test_check_if_a_user_can_be_persisted()
    {
        $user = User::create(['name' => 'User Test', 'email' => 'user@email.com', 'password' => '123456']);
        $this->assertEquals('User Test', $user->name);

        $user = User::find(2);
        $this->assertEquals('User Test', $user->name);
    }

    public function test_can_soft_deletes()
    {
        $user = User::create(['name' => 'User Test', 'email' => 'user@email.com', 'password' => '123456']);
        $user->delete();

        $this->assertEquals(true, $user->trashed());
        $this->assertCount(1, User::all());
    }

    public function test_can_get_rows_deleted()
    {
        $user = User::create(['name' => 'User Test', 'email' => 'user@email.com', 'password' => '123456']);
        $user->delete();

        $user = User::onlyTrashed()->get();
        $this->assertEquals(2, $user[0]->id);
        $this->assertEquals('User Test', $user[0]->name);
    }

    public function test_can_get_rows_deleted_and_activated()
    {
        $user = User::create(['name' => 'User Test 1', 'email' => 'user1@email.com', 'password' => '123456']);
        User::create(['name' => 'User Test 2', 'email' => 'user2@email.com', 'password' => '123456']);
        $user->delete();

        $users = User::withTrashed()->get();
        $this->assertCount(3, $users);
        $this->assertEquals(2, $users[1]->id);
        $this->assertEquals('User Test 1', $users[1]->name);
    }

    public function test_can_force_delete()
    {
        $user = User::create(['name' => 'User Test', 'email' => 'user@email.com', 'password' => '123456']);
        $user->forceDelete();
        $this->assertCount(1, User::all());
    }

    public function test_can_restore_rows_from_deleted()
    {
        $user = User::create(['name' => 'User Test', 'email' => 'user@email.com', 'password' => '123456']);
        $user->delete();
        $user->restore();

        $user = User::find(2);
        $this->assertEquals(2, $user->id);
        $this->assertEquals('User Test', $user->name);
    }

}