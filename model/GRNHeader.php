<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GRNHeader
 *
 * @author Nadeeshani
 */
class GRNHeader extends IdentifiedBaseModel {
    //put your code here
    public $id;
    public $supid;
    public $grnDate;
    public $totalAmount;
    public $UserId;
    public $delStatus;
    
    public function loadGRN(){
        $result = mysqli_query($this->con, "SELECT grnheader.id, supplier.fname,supplier.lname,grnheader.grndate, grnheader.totalamount"
                . " FROM `grnheader` INNER JOIN supplier on grnheader.supId=supplier.id WHERE grnheader.delstatus=0 ORDER BY grnheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function deleteGRN(){
        $query=  "UPDATE grnheader SET delstatus=1 WHERE id='".$_POST['id']."'";
        $res=  $this->con->query($query);
        echo json_encode($res);
        if (!$res) {
            $err=  $this->con->error_list;
        }
        return $res;
    }
    
    public function retrieveGRN(){
        $result = mysqli_query($this->con, "SELECT grnheader.id, grnheader.supid,supplier.fname,supplier.lname,grnheader.grndate,"
                . " grnheader.totalamount,grnitem.ritemid,grnitem.purprice,grnitem.qty,grnitem.amount, rawmaterials.description "
                . " FROM `grnheader` INNER JOIN grnitem ON grnheader.id=grnitem.grnno INNER JOIN supplier on grnheader.supId=supplier.id "
                . " INNER JOIN rawmaterials ON grnitem.ritemid=rawmaterials.id WHERE grnheader.id ='".$_POST['grnNo']."'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function retrieveGRNSup(){
        $result = mysqli_query($this->con, "SELECT grnheader.id, supplier.fname,supplier.lname,grnheader.grndate,"
                . " grnheader.totalamount" 
                . " FROM `grnheader` INNER JOIN supplier on grnheader.supid=supplier.id INNER JOIN grnpayment ON "
                . " grnheader.id=grnpayment.grnno"
                . " WHERE grnheader.delstatus=0 AND grnheader.supid='" .$_POST['sData']. "' AND "
                . " (grnpayment.grnamount-grnpayment.totalpaid<>0) ORDER BY grnheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function retrieveGRNDet(){
        $result = mysqli_query($this->con, "SELECT grnheader.totalamount, grnpayment.totalpaid"
                . " FROM grnheader INNER JOIN grnpayment ON grnheader.id=grnpayment.grnno "
                . " WHERE grnheader.id='" .$_POST['sData']. "'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function totalGRN(){
        $result = mysqli_query($this->con, "SELECT  sum(totalamount) as totamount " 
                . " FROM `grnheader`  "
                . " WHERE delstatus=0 AND month(grndate)='".date('m')."' AND year(grndate)='".  date("Y")."'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function GRNSummeryDate(){
        $grnData=$_POST['sData'];
        $fromDate=$grnData['fromDate'];
        $toDate=$grnData['toDate'];
        $result = mysqli_query($this->con, "SELECT grnheader.id, grnheader.supid,supplier.fname,supplier.lname,grnheader.grndate,"
                . " grnheader.totalamount "
                . " FROM `grnheader` INNER JOIN supplier on grnheader.supId=supplier.id "
                . " WHERE grnheader.delstatus=0 AND grnheader.grndate BETWEEN '" .$fromDate. "' AND '" .$toDate. "' "
                . " ORDER BY grnheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
