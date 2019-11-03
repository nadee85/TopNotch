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
class RawMaterials extends IdentifiedBaseModel {

    //put your code here
    public $id;
    public $description;
    public $curStock;
    public $mandatory;

    public function loadDescription() {
        $result = mysqli_query($this->con, "SELECT id,description FROM rawmaterials");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }

    public function updateRawMaterials($id, $stock) {
        $query = "UPDATE rawmaterials SET curStock=curstock + $stock WHERE id='$id'";
        $res = $this->con->query($query);
//        echo json_encode($res);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }
}
