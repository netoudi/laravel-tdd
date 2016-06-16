<?php

namespace CodePress\CodeUser\Repository;

use CodePress\CodeDatabase\Contracts\CriteriaCollectionInterface;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;

interface UserRepositoryInterface extends RepositoryInterface, CriteriaCollectionInterface
{
    public function addRoles($id, array $roles);
}
