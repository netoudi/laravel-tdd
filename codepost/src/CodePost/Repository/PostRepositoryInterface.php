<?php

namespace CodePress\CodePost\Repository;

use CodePress\CodeDatabase\Contracts\CriteriaCollectionInterface;
use CodePress\CodeDatabase\Contracts\RepositoryInterface;

interface PostRepositoryInterface extends RepositoryInterface, CriteriaCollectionInterface
{
    public function updateState($id, $state);
}
