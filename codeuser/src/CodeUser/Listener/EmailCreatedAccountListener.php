<?php

namespace CodePress\CodeUser\Listener;

use CodePress\CodeUser\Event\UserCreatedEvent;
use Illuminate\Mail\Mailer;

class EmailCreatedAccountListener
{
    /**
     * @var Mailer
     */
    private $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    public function handle(UserCreatedEvent $event)
    {
        $user = $event->getUser();
        $plainPassword = $event->getPlainPassword();
        return $this->mailer->send('email.registration', [
            'username' => $user->email,
            'password' => $plainPassword,
        ], function ($message) use ($user) {
            $message->to($user->email, $user->name)
                ->subject("{$user->name}, your account was created!");
        });
    }
}