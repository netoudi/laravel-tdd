<?php

namespace CodePress\CodeUser\Tests;

use CodePress\CodeUser\Event\UserCreatedEvent;
use CodePress\CodeUser\Listener\EmailCreatedAccountListener;
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
        $mockUser->shouldReceive('getAttribute')->with('name')->andReturn('Test');
        $mockUser->shouldReceive('getAttribute')->with('email')->andReturn('test@test.com');
        $mockUser->shouldReceive('getAttribute')->with('password')->andReturn('123456');

        $event = new UserCreatedEvent($mockUser, $mockUser->password);

        $mockMailer = m::mock(Mailer::class);
        $mockMailer->shouldReceive('send')
            ->with('email.registration', [
                'username' => $mockUser->email,
                'password' => $mockUser->password // plainPassword
            ], m::on(function (\Closure $closure) use ($mockUser) {
                $mockMessage = m::mock(Message::class);
                $mockMessage->shouldReceive('to')
                    ->with($mockUser->email, $mockUser->name)
                    ->andReturn($mockMessage);
                $mockMessage->shouldReceive('subject')
                    ->with("{$mockUser->name}, your account was created!");
                $closure($mockMessage);
                return true;
            }))
            ->andReturn(1);

        $listener = new EmailCreatedAccountListener($mockMailer);
        $result = $listener->handle($event);

        $this->assertEquals(1, $result);
    }
}