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
class Item extends IdentifiedBaseModel {
    //put your code here
    public $id;
    public $description;
    public $price;
    public $curStock;
    public $reOrderLevel;
    public $status;
    
    public function loadDescription() {
        $result = mysqli_query($this->con, "SELECT id,description FROM item WHERE status=1");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function updateItems($id, $stock) {
        $query = "UPDATE item SET curStock=curstock - $stock WHERE id='$id'";
        $res = $this->con->query($query);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }
    
    public function getPrice() {
        $result = mysqli_query($this->con, "SELECT price,curStock FROM item WHERE id='".$_POST['item']."'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function totalStock() {
        $result = mysqli_query($this->con, "SELECT sum(curStock) as stock FROM item ");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
