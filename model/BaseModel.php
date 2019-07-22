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

    public function __construct() {
        $this->con = new mysqli("localhost", "root", "adm!nsb123", "topnotch", "3306");
    }

    public function save($element=NULL) {
        $reflect=new ReflectionClass($element);
        $properties   = $reflect->getProperties(ReflectionProperty::IS_PUBLIC | ReflectionProperty::IS_PROTECTED | ReflectionProperty::IS_PRIVATE);
        $fields=array();
        $values=array();
        
        foreach ($properties as $k){
            if ($k->getName()==="con") {
                continue;
            }
            $fields[]=$k->getName();
            $k->setAccessible(true);
            $val=$k->getValue($element);
            if (gettype($val)!=="Integer") {
                $val="'$val'";
            }
            $values[]=$val;
            $k->setAccessible(FALSE);
        }
        
            
        $fieldList = implode(",", $fields);
        $valueList = implode(",", $values);
        $tableName=  get_class($element);
        
//        echo json_encode($fieldList);
//        echo json_encode($valueList);
        
        $query = "INSERT INTO $tableName($fieldList)VALUES ($valueList)";
        $res=$this->con->query($query);
        if (!$res) {
            echo $this->con->error;
        }
    }

}
