<?php

use Illuminate\Foundation\Testing\DatabaseTransactions;

class AuthTest extends \TestCase
{
    use DatabaseTransactions;

    public function test_can_login_in_application()
    {
        $this->visit('/login')
            ->type('user@email', 'email')
            ->type('123456', 'password')
            ->press('Login')
            ->seePageIs('/home')
            ->see('Dashboard');
    }

    public function test_cannot_login_in_application()
    {
        $this->visit('/login')
            ->type('user@email', 'email')
            ->type('1234567', 'password')
            ->press('Login')
            ->seePageIs('/login')
            ->see('Password');
    }
}
