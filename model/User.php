<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of User
 *
 * @author Nadeeshani
 */
class User extends IdentifiedBaseModel{
    //put your code here
    public $id;
    public $password;
    
    public function loadImage(){
        $result = mysqli_query($this->con, "SELECT userdetails.fname,userdetails.lname, userdetails.picture FROM user INNER JOIN userdetails "
                . " ON user.id=userdetails.userid WHERE userdetails.userid ='" . $_POST['userid']. "'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
