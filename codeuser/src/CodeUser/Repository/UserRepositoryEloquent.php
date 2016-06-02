<?php

namespace CodePress\CodeUser\Repository;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeUser\Event\UserCreatedEvent;
use CodePress\CodeUser\Models\User;

class UserRepositoryEloquent extends AbstractRepository implements UserRepositoryInterface
{
    public function create(array  $data)
    {
        $password = $data['password'];
        $data['password'] = bcrypt($password);
        $result = parent::create($data);

//        event(new UserCreatedEvent($result, $password));
//        event('event.asdf', ['param 1', 'param 2']);
        event('event.number1');

        return $result;
    }

    public function model()
    {
        return User::class;
    }
}