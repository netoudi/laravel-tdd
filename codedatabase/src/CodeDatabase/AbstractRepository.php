<?php

namespace CodePress\CodeDatabase;

use CodePress\CodeDatabase\Contracts\RepositoryInterface;

abstract class AbstractRepository implements RepositoryInterface
{
    public abstract function model();
}