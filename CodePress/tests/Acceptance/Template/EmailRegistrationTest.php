<?php

class EmailRegistrationTest extends \TestCase
{
    protected function createRoute()
    {
        Route::group(['middleware' => ['web']], function () {
            Route::get('/email/registration', function () {
                return view('email.registration', [
                    'username' => 'test@test.com',
                    'password' => '123456'
                ]);
            });
        });
    }

    public function test_can_generate_html_from_template()
    {
        $this->createRoute();
        $this->visit('/email/registration')
            ->see('test@test.com')
            ->see('123456');
    }
}
