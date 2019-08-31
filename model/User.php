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
class User extends BaseModel{
    //put your code here
    private $userId;
    private $fName;
    private $lName;
    private $email;
    private $password;
    
    public function __construct() {
        parent::__construct();
    }
    
    function getUserId() {
        return $this->userId;
    }

    function getFName() {
        return $this->fName;
    }

    function getLName() {
        return $this->lName;
    }

    function getEmail() {
        return $this->email;
    }

    function getPassword() {
        return $this->password;
    }

    function setUserId($userId) {
        $this->userId = $userId;
    }

    function setFName($fName) {
        $this->fName = $fName;
    }

    function setLName($lName) {
        $this->lName = $lName;
    }

    function setEmail($email) {
        $this->email = $email;
    }

    function setPassword($password) {
        $this->password = $password;
    }


}
