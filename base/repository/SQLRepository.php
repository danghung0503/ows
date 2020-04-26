<?php

namespace base\repository;

use base\repository\database\mysql\Connection;
use base\model\AbstractModel;

class SQLRepository implements DatabaseRepository
{

    private Connection $connection;
    private AbstractModel $model;

    public function __construct(AbstractModel $model)
    {
        $this->model = $model;
        $this->connection = Connection::getInstance();
    }

    public function findById($id)
    {
        $table = $this->model->getTable();
        $keyField = $this->model->getKeyField();
        $sql = "SELECT * FROM  $table WHERE $keyField = $id";
        return $this->connection->first($sql);
    }

    public function findByField($field, $value)
    {
        $table = $this->model->getTable();
        $sql = "SELECT * FROM  $table WHERE $field = '$value'";
        return $this->connection->first($sql);
        return null;
    }

    public function where($field, $value)
    {
        // TODO: Implement where() method.
        return null;
    }

    public function order($field, $director)
    {
        // TODO: Implement order() method.
        return null;
    }

    public function get()
    {
        // TODO: Implement get() method.
        return null;
    }

    public function create($data)
    {
        $fields = [];
        $values = [];
        $fillableFields = $this->model->getFillable();
        foreach ($data as $key => $value) {
            /* Only fill with field existed in fillable field */
            if (in_array($key, $fillableFields)) {
                $fields[] = $key;
                $values[] = "'" . $value . "'";
            }
        }
        $fields = implode(',', $fields);
        $values = implode(',', $values);
        $table = $this->model->getTable();
        $query = "INSERT INTO $table ($fields) VALUES ($values)";
        $raw = $this->connection->commit($query);
        return $raw;
    }

    public function update($data, $id)
    {
        $fields = [];
        $values = [];
        $fillableFields = $this->model->getFillable();
        $queryParams = [];
        foreach ($data as $key => $value) {
            /* Only fill with field existed in fillable field */
            if (in_array($key, $fillableFields)) {
                $fields[] = $key;
                $values[] = "'" . $value . "'";
                $queryParams[] = "$key = '$value'";
            }
        }
        $queryParams = implode(',', $queryParams);
        $table = $this->model->getTable();
        $keyField = $this->model->getKeyField();
        $query = "UPDATE $table SET $queryParams WHERE $keyField = $id";
        $raw = $this->connection->commit($query);
        return $raw;
    }

    public function save($data)
    {
        return null;
    }
}
