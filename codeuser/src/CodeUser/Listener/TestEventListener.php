<?php

namespace CodePress\CodeUser\Listener;

class TestEventListener
{
    public function number1()
    {
        echo "\nEvent number 1";
    }

    public function number2()
    {
        echo "\nEvent number 2";
    }

    public function subscribe($events)
    {
        $events->listen('event.number1', 'CodePress\CodeUser\Listener\TestEventListener@number1', 10);
        $events->listen('event.number1', 'CodePress\CodeUser\Listener\TestEventListener@number2', 20);
    }
}