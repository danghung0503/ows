<?php

namespace base\model;

class AbstractModel
{
    /**
     * @var string: key field
     */
    protected string $key = 'id';

    /**
     * @var string: name of table
     */
    protected string $table;

    /**
     * @var array: list of field that can fill data
     */
    protected array $fillable;

    /**
     * @var array: list of field cannot get value
     */
    protected array $hidden;

    /**
     * @return string: save value of fields
     */
    private array $values = [];

    public function getTable(){
        return $this->table;
    }

    public function getFillable(){
        return $this->fillable;
    }

    public function getHidden(){
        return $this->hidden;
    }


    public function setFieldValue($field, $value) {
        $this->values[$field] = $value;
        return true;
    }

    public function get($field){
        if(isset($this->values[$field])){
            return $this->values[$field];
        }
        return null;
    }

    public function getKeyField(){
        return $this->key;
    }
}
