<?php

namespace CodePress\CodeUser\Repository;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeUser\Models\Tag;

class UserRepositoryEloquent extends AbstractRepository implements UserRepositoryInterface
{
    public function model()
    {
        return User::class;
    }
}