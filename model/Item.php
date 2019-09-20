<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Item
 *
 * @author Nadeeshani
 */
class Item extends BaseModel {
    //put your code here
    public $id;
    public $description;
    public $price;
    public $curStock;
    public $status;
    
    public function findByName(){
        $result = mysqli_query($this->con, "SELECT * FROM item where description '" . $_POST['description'] . "%'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
