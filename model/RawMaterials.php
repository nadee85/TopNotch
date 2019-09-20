<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RawMaterial
 *
 * @author Nadeeshani
 */
class RawMaterials extends BaseModel{
    //put your code here
    public $id;
    public $description;
    public $curStock;
    public $mandatory;
    
    public function findByName(){
        $result = mysqli_query($this->con, "SELECT * FROM rawmaterials where description '" . $_POST['description'] . "%'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
