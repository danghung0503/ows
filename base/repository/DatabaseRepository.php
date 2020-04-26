<?php
namespace base\repository;

interface DatabaseRepository
{
    public function create($data);
    public function update($data, $id);
    public function save($data);

    public function findById($id);

    /**
     * @param $field: field to search
     * @param $value: value of field
     * @return mixed: a pojo object
     */
    public function findByField($field, $value);

    /**
     * This seem to same a builder, to build query
     * @param $field: field to search
     * @param $value: value to search
     * @return mixed: this
     */
    public function where($field, $value);
    public function order($field, $director);
    public function get();
}
