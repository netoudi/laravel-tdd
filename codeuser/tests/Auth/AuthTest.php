<?php

namespace CodePress\CodeUser\Tests\Auth;


use CodePress\CodeUser\Models\User;
use CodePress\CodeUser\Tests\AbstractTestCase;
use Illuminate\Support\Facades\Auth;
use Orchestra\Testbench\Traits\WithFactories;

class AuthTest extends AbstractTestCase
{
    use WithFactories;

    public function setUp()
    {
        parent::setUp();
        $this->migrate();
        $this->withFactories(__DIR__ . '/../../src/resources/factories');
    }

    public function test_check_if_is_not_authenticated()
    {
        $this->assertEquals(false, Auth::check());
    }

    public function test_check_if_is_authenticated()
    {
        $user = factory(User::class)->create();
        Auth::login($user);

        $this->assertEquals(true, Auth::check());
    }
}
