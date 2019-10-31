<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserDetail
 *
 * @author Nadeeshani
 */
class UserDetails extends IdentifiedBaseModel{
    //put your code here
    public $userid;
    public $fname;
    public $lname;
    public $mobile;
    public $email;
    public $picture;
    public $status;
    
    public function loadImage(){
        $result = mysqli_query($this->con, "SELECT user.fname,user.lname, userdetails.picture FROM user INNER JOIN userdetails "
                . " ON user.id=userdetails.userid WHERE userdetails.userid ='" . $_POST['userid']. "'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function checkUsername(){
        $result=  mysqli_query($this->con, "SELECT userid FROM userdetails WHERE userid='" . $_POST['username']."'");
        if (mysqli_num_rows($result)==0) {
            echo 'true';
        }else{
            echo 'false';
        }
    }
}
