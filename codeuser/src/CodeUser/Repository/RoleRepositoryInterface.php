<?php

namespace CodePress\CodeUser\Repository;

use CodePress\CodeDatabase\Contracts\CriteriaCollectionInterface;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;

interface RoleRepositoryInterface extends RepositoryInterface, CriteriaCollectionInterface
{
    public function addPermissions($id, array $permissions);
}
