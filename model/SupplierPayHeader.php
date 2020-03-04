<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierPayHeader
 *
 * @author Nadeeshani
 */
class SupplierPayHeader extends IdentifiedBaseModel{
    //put your code here
    public $id;
    public $supId;
    public $payDate;
    public $totalAmount;
    public $UserID;
    public $delStatus;
    public $delDate;
    
    public function loadSupPayment(){
        $result = mysqli_query($this->con, "SELECT supplierpayheader.id, supplier.fname,supplier.lname,supplierpayheader.paydate,"
                . " supplierpayheader.totalamount" 
                . " FROM `supplierpayheader` INNER JOIN supplier on supplierpayheader.supid=supplier.id "
                . " WHERE supplierpayheader.delstatus=0 ORDER BY supplierpayheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
     public function deleteSupPay(){
        $query=  "UPDATE supplierpayheader SET delstatus=1, deldate='".  date("Y-m-d")."' WHERE id='".$_POST['id']."'";
        $res=  $this->con->query($query);
        echo json_encode($res);
        if (!$res) {
            $err=  $this->con->error_list;
        }
        return $res;
    }
    
    public function retrieveSupPayments($supPayNo){
        $result = mysqli_query($this->con, "SELECT supplierpayheader.id, supplier.fname,supplier.lname, supplier.address,supplier.tp,"
                . " supplier.email, supplierpayheader.paydate, supplierpayheader.supid,"
                . " supplierpayheader.totalamount, suppaydetails.* " 
                . " FROM `supplierpayheader` INNER JOIN supplier ON supplierpayheader.supid=supplier.id INNER JOIN "
                . " suppaydetails ON supplierpayheader.id=suppaydetails.suppayid "
                . " WHERE supplierpayheader.delstatus=0 AND supplierpayheader.id='" .$supPayNo. "'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function loadSupDuePayment(){
        $result = mysqli_query($this->con, "SELECT grnpayment.grnAmount,grnpayment.totalPaid,"
                . " (grnpayment.grnAmount-grnpayment.totalPaid) AS balAmount,"
                . " supplier.fname,supplier.lname, grnheader.grnDate, grnheader.id FROM grnpayment INNER JOIN grnheader ON"
                . " grnpayment.grnNo=grnheader.id INNER JOIN supplier ON grnpayment.supId=supplier.id "
                . " WHERE (grnpayment.grnAmount-grnpayment.totalPaid<>0)");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function supWisePayment(){
        $payData=$_POST['sData'];
        $sup=$payData['supplier'];
        $fromDate=$payData['fromDate'];
        $toDate=$payData['toDate'];
        $result = mysqli_query($this->con, "SELECT supplierpayheader.id, supplier.fname,supplier.lname,supplierpayheader.paydate,"
                . " supplierpayheader.totalamount" 
                . " FROM `supplierpayheader` INNER JOIN supplier on supplierpayheader.supid=supplier.id "
                . " WHERE supplierpayheader.delstatus=0 AND supplierpayheader.supid='" .$sup. "' AND "
                . " supplierpayheader.paydate BETWEEN '" .$fromDate. "' AND '" .$toDate. "' ORDER BY supplierpayheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
