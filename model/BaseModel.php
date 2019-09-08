<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BaseModel
 *
 * @author Nadeeshani
 */
class BaseModel {

    //put your code here
    protected $con;
    protected $id;

    public function __construct() {
        $this->con = new mysqli("localhost", "root", "adm!nsb123", "topnotch", "3306");
    }

    public function save($element = NULL) {
        if (!isset($element)) {
            $element = $this;
        }

        $fields = $this->getFields();
        $values = $this->getFieldValues($element);


        $fieldList = implode(",", $fields);
        $valueList = implode(",", $values);

        $tableName = get_class($element);

        $query = "INSERT INTO $tableName($fieldList)VALUES ($valueList)";
        $res = $this->con->query($query);
        if (!$res) {
            echo $this->con->error;
        }
        return $res;
    }

    public function update($updatedElement = NULL) {
        $tableName = get_class($this);

        if (!isset($updatedElement)) {
            $updatedElement = $this;
        }

        $fieldValueMap = $this->getFieldValueMap($updatedElement);

        $generateSqlKeyValuePairs = function ($k, $v) {
            return "$k=$v";
        };

        $valueString = implode(',', $this->array_map_asoc($generateSqlKeyValuePairs, $fieldValueMap));

        if (gettype($this->id) !== "Integer") {
            $id = "'$this->id'";
        }
        
        $query = "UPDATE $tableName SET $valueString WHERE id=$id";

        $res = $this->con->query($query);

        if (!$res) {
            $err = $this->con->error_list;
        }
    }

    public function find($id) {
        $tableName = get_class($this);
        
        if (gettype($this->id) !== "Integer") {
            $id = "'$this->id'";
        }
        
        $query = "SELECT * FROM $tableName WHERE id=$id";
        
        $res = $this->con->query($query);

        if ($res->num_rows < 0) {
            return NULL;
        }
        
        $record = $res->fetch_assoc();

        $fields = $this->getFields();

        foreach ($fields as $field) {
            $this->$field = $record[$field];
        }
        
        return $this;
    }

    private function getFields() {
        $reflect = new ReflectionClass($this);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $fields = array();

        foreach ($properties as $k) {
            if ($k->getName() === "con") {
                continue;
            }
            $fields[] = $k->getName();
        }
        return $fields;
    }

    private function getFieldValues($element) {
        $reflect = new ReflectionClass($element);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $values = array();

        foreach ($properties as $k) {
            if ($k->getName() === "con") {
                continue;
            }
            $k->setAccessible(true);

            $val = $k->getValue($element);
            if (gettype($val) !== "Integer") {
                $val = "'$val'";
            }
            $values[] = $val;
            $k->setAccessible(FALSE);
        }
        return $values;
    }

    private function getFieldValueMap($element) {
        $reflect = new ReflectionClass($element);
        $properties = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $values = array();

        foreach ($properties as $k) {
            if ($k->getName() === "con") {
                continue;
            }
            $k->setAccessible(true);

            $name = $k->getName();
            $val = $k->getValue($element);
            if (gettype($val) !== "Integer") {
                $val = "'$val'";
            }

            $values[$name] = $val;
            $k->setAccessible(FALSE);
        }
        return $values;
    }

    private function array_map_asoc($callback, $array) {
        $r = array();
        foreach ($array as $key => $value) {
            $r[$key] = $callback($key, $value);
        }
        return $r;
    }

}
