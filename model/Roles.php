<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Roles
 *
 * @author Nadeeshani
 */
class Roles  extends IdentifiedBaseModel{
    //put your code here
    public $id;
    public $description;
    
    public function loadRoleDes() {
        $result = mysqli_query($this->con, "SELECT id, description FROM roles");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
