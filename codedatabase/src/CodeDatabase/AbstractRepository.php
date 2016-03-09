<?php

namespace CodePress\CodeDatabase;

use CodePress\CodeDatabase\Contracts\RepositoryInterface;
use CodePress\CodeDatabase\Contracts\CriteriaCollectionInterface;
use CodePress\CodeDatabase\Contracts\CriteriaInterface;

abstract class AbstractRepository implements RepositoryInterface, CriteriaCollectionInterface
{
    protected $model;

    protected $criteriaCollection = [];

    public function __construct()
    {
        $this->makeModel();
    }

    public abstract function model();

    public function makeModel()
    {
        $class = $this->model();
        $this->model = new $class;
        return $this->model;
    }

    public function all($columns = array('*'))
    {
        return $this->model->get($columns);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(array $data, $id)
    {
        $model = $this->find($id);
        $model->update($data);
        return $model;
    }

    public function delete($id)
    {
        $model = $this->find($id);
        return $model->delete();
    }

    public function find($id, $columns = array('*'))
    {
        return $this->model->findOrFail($id, $columns);
    }

    public function findBy($field, $value, $columns = array('*'))
    {
        return $this->model->where($field, '=', $value)->get($columns);
    }

    public function lists($columns = '*')
    {
        return $this->model->lists($columns);
    }

    public function addCriteria(CriteriaInterface $criteriaInterface)
    {
        $this->criteriaCollection[] = $criteriaInterface;
        return $this;
    }

    public function getCriteriaCollection()
    {
        return $this->criteriaCollection;
    }

    public function getByCriteria(CriteriaInterface $criteriaInterface)
    {
        $this->model = $criteriaInterface->apply($this->model, $this);
        return $this;
    }

    public function applyCriteria()
    {
    }
}