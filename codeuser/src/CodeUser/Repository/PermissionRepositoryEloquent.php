<?php

namespace CodePress\CodeUser\Repository;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeUser\Models\Permission;

class PermissionRepositoryEloquent extends AbstractRepository implements PermissionRepositoryInterface
{
    public function model()
    {
        return Permission::class;
    }
}
