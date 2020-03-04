<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of UserRoles
 *
 * @author Nadeeshani
 */
class UserRoles extends IdentifiedBaseModel {

    //put your code here
    public $roleId;
    public $UserId;

    public function getUserRoles() {
        $result = mysqli_query($this->con, "SELECT userroles.userid,userroles.roleid,roles.description FROM "
                . " userroles INNER JOIN roles ON userroles.roleid=roles.id WHERE userid='".$_POST['userid']."'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
//        echo $data['userid'];
    }
}
