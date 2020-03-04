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
class UserDetails extends IdentifiedBaseModel {

    //put your code here
    public $userid;
    public $fname;
    public $lname;
    public $mobile;
    public $email;
    public $picture;
    public $status;

    public function loadImage() {
        $result = mysqli_query($this->con, "SELECT user.fname,user.lname, userdetails.picture FROM user INNER JOIN userdetails "
                . " ON user.id=userdetails.userid WHERE userdetails.userid ='" . $_POST['userid'] . "'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }

    public function checkUsername() {
        $result = mysqli_query($this->con, "SELECT userid FROM userdetails WHERE userid='" . $_POST['username'] . "'");
        if (mysqli_num_rows($result) == 0) {
            echo 'true';
        } else {
            echo 'false';
        }
    }

    public function loadName() {
        $result = mysqli_query($this->con, "SELECT userid,fname,lname FROM userdetails WHERE status='1'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }

    public function checkUserRole() {
        $result = mysqli_query($this->con, "SELECT userid FROM userroles WHERE userid='" . $_POST['cmbUser'] . "'");
        if (mysqli_num_rows($result) == 0) {
            echo 'true';
        } else {
            echo 'false';
        }
    }
    
    public function findByUId($id){
        $tableName=  get_class($this);
        $query="SELECT * FROM $tableName WHERE userid='$id'";
        return $this->select($query);
        
    }
    
    public function activateUser($id) {
        $query = "UPDATE userdetails SET status='1' WHERE userid='$id'";
        $res = $this->con->query($query);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }
    
    public function checkCode() {
        $result = mysqli_query($this->con, "SELECT onetimepassword.value FROM onetimepassword INNER JOIN userdetails"
                . " ON onetimepassword.mobilenumber=userdetails.mobile WHERE onetimepassword.value='" . $_POST['actCode'] . "'");
        if (mysqli_num_rows($result) == 0) {
            echo 'false';
        } else {
            echo 'true';
        }
    }
    
    public function updateUser($id) {
        $userData=$_POST["userData"];
        $query = "UPDATE UserDetails SET fname='".$userData['fName']. "', lname='".$userData['lName']."', "
                . " mobile='".$userData['mobile']."', email='".$userData['email']."', "
                . " picture='".$userData['picture']."' WHERE userid='$id'";
        $res = $this->con->query($query);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }
}
