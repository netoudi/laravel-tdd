<?php

namespace CodePress\CodeUser\Tests;

use CodePress\CodeUser\Event\UserCreatedEvent;
use CodePress\CodeUser\Models\User;
use Illuminate\Mail\Mailer;
use Illuminate\Mail\Message;
use Mockery as m;

class EmailCreatedAccountListenerTest extends AbstractTestCase
{
    public function setUp()
    {
        parent::setUp();
        $this->migrate();
    }

    public function test_can_trigger_handle()
    {
        $mockUser = m::mock(User::class);
        $mockUser->name = 'Test';
        $mockUser->email = 'test@test.com';
        $mockUser->password = '123456';

        $event = new UserCreatedEvent($mockUser, $mockUser->password);

        $mockMailer = m::mock(Mailer::class);
        $mockMailer->shouldReceive('send')
            ->with('email.registration', [
                'username' => $mockUser->email,
                'password' => $mockUser->password
            ], m::on(function (\Closure $closure) use ($mockUser) {
                $mockMessage = m::mock(Message::class);
                $mockMessage->shouldReceive('to')
                    ->with($mockUser->email, $mockUser->name)
                    ->andReturn($mockMessage);
                $mockMessage->shouldReceive('subject')
                    ->with("{$mockUser->name}, your account was created!");
                $closure($mockMessage);
            }));
    }
}