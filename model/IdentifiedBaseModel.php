<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IdentifiedBaseModel
 *
 * @author Nadeeshani
 */
class IdentifiedBaseModel extends BaseModel{
    //put your code here
    public $id;
    
    public function findById($id){
        $tableName=  get_class($this);
        $query="SELECT * FROM $tableName WHERE id='$id'";
        echo json_encode($query);
        echo json_encode($this->select($query));
        return $this->select($query);
        
    }
    
    public function findByField($parKey,$parVal){
        $tableName=  get_class($this);
        $result = mysqli_query($this->con, "SELECT * FROM $tableName WHERE $parKey LIKE '$parVal%'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function findList() {
        $tableName = get_class($this);
        $result = mysqli_query($this->con, "SELECT * FROM $tableName");

        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }

        echo json_encode($data);
    }
    
    public function checkId($idField){
        $tableName=  get_class($this);
        $result=  mysqli_query($this->con, "SELECT id FROM $tableName WHERE id='" . $idField."'");
        if (mysqli_num_rows($result)==0) {
            echo 'true';
        }else{
            echo 'false';
        }
    }
    
    public function loadId(){
        $tableName=  get_class($this);
        $result = mysqli_query($this->con, "SELECT COUNT(id) as id FROM $tableName");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
}
