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
    public $status;

    public function loadDescription() {
        $result = mysqli_query($this->con, "SELECT id,description FROM rawmaterials WHERE status=1");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }

    public function updateRawMaterials($id, $stock) {
        $query = "UPDATE rawmaterials SET curStock=curstock + $stock WHERE id='$id'";
        $res = $this->con->query($query);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }
}
