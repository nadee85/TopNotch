<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Customer
 *
 * @author Nadeeshani
 */
class Customer extends IdentifiedBaseModel {

    //put your code here
    public $id;
    public $fname;
    public $lname;
    public $address;
    public $tp;
    public $mobile;
    public $email;
    public $status;
    
//    public function findByName(){
//        $result = mysqli_query($this->con, "SELECT * FROM customer where fname LIKE '" . $_POST['fname'] . "%'");
//        $data = array();
//        while ($row = mysqli_fetch_object($result)) {
//            array_push($data, $row);
//        }
//        echo json_encode($data);
//    }

}
