<?php

namespace CodePress\CodeDatabase\Repository;

use CodePress\CodeDatabase\AbstractRepository;
use CodePress\CodeDatabase\Models\Category;

class CategoryRepository extends AbstractRepository
{
    public function all($columns = array('*'))
    {
    }

    public function create(array $data)
    {
    }

    public function update(array $data, $id)
    {
    }

    public function delete($id)
    {
    }

    public function find($id, $columns = array('*'))
    {
    }

    public function findBy($field, $value, $columns = array('*'))
    {
    }

    public function model()
    {
        return Category::class;
    }
}