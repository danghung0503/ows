<?php

namespace repository;

use base\model\AbstractModel;
use \base\repository\SQLRepository;
class Repository
{
    private SQLRepository $repository;
    private object $model;
    public function __construct(AbstractModel $model)
    {
        $this->model = $model;
        $this->repository = new SQLRepository($this->model);
    }


    public function findById($id)
    {
        return $this->repository->findById($id);
    }

    public function findByField($field, $value)
    {
        return $this->repository->findByField($field, $value);
    }

    public function where($field, $value)
    {
        return $this->repository->where($field, $value);
    }

    public function order($field, $director)
    {
        return $this->repository->order($field, $director);
    }

    public function get()
    {
        return $this->repository->get();
    }


    public function create($data)
    {
        return $this->repository->create($data);
    }

    public function update($data, $id)
    {
        return $this->repository->update($data, $id);
    }

    public function save($data)
    {
        return $this->repository->save($data);
    }
}
