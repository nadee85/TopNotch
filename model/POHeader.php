<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of POHeader
 *
 * @author Nadeeshani
 */
class POHeader extends IdentifiedBaseModel{
    //put your code here
    public $id;
    public $supid;
    public $poDate;
    public $UserId;
    public $delStatus;


    public function loadPO(){
        $result = mysqli_query($this->con, "SELECT poheader.id, supplier.fname,supplier.lname,poheader.podate FROM `poheader` "
                . "INNER JOIN supplier on poheader.supId=supplier.id WHERE poheader.delstatus=0 ORDER BY poheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function findByPO(){
        $result = mysqli_query($this->con, "SELECT poheader.id, supplier.fname,supplier.lname,poheader.podate FROM `poheader` "
                . "INNER JOIN supplier on poheader.supId=supplier.id WHERE poheader.id LIKE '".$_POST['pono']."%'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function findBySupId(){
        $result = mysqli_query($this->con, "SELECT poheader.id, supplier.fname,supplier.lname,poheader.podate FROM `poheader` "
                . "INNER JOIN supplier on poheader.supId=supplier.id WHERE supplier.id ='".$_POST['id']."'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function findByDate(){
        $result = mysqli_query($this->con, "SELECT poheader.id, supplier.fname,supplier.lname,poheader.podate FROM `poheader` "
                . "INNER JOIN supplier on poheader.supId=supplier.id WHERE poheader.podate BETWEEN '".$_POST['startDate']."' AND '" . $_POST['endDate']."'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function deletePO(){
        $query=  "UPDATE poheader SET delstatus=1 WHERE id='".$_POST['id']."'";
        $res=  $this->con->query($query);
        echo json_encode($res);
        if (!$res) {
            $err=  $this->con->error_list;
        }
        return $res;
    }
    
    public function retrievePO(){

        $result = mysqli_query($this->con, "SELECT poheader.id, poheader.supid,supplier.fname,supplier.lname,poheader.podate,poitem.ritemid,poitem.qty,"
                . " rawmaterials.description FROM `poheader` INNER JOIN poitem ON poheader.id=poitem.pono "
                . " INNER JOIN supplier on poheader.supId=supplier.id INNER JOIN rawmaterials ON poitem.ritemid=rawmaterials.id"
                . " WHERE poheader.id LIKE '".$_POST['pono']."%'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
