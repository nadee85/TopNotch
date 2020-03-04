<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceHeader
 *
 * @author Nadeeshani
 */
class InvoiceHeader extends IdentifiedBaseModel{
    //put your code here
    public $id;
    public $cusid;
    public $invDate;
    public $netAmount;
    public $discount;
    public $totAmount;
    public $status;
    public $UserId;
    public $delStatus;
    public $delDate;


    public function loadInvoice(){
        $result = mysqli_query($this->con, "SELECT invoiceheader.id, customer.fname,customer.lname,invoiceheader.invdate,"
                . " invoiceheader.netamount, invoiceheader.discount, invoiceheader.totamount" 
                . " FROM `invoiceheader` INNER JOIN customer on invoiceheader.cusid=customer.id "
                . " WHERE invoiceheader.delstatus=0 ORDER BY invoiceheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function deleteInvoice(){
        $query=  "UPDATE invoiceheader SET delstatus=1, deldate='".  date("Y-m-d")."' WHERE id='".$_POST['id']."'";
        $res=  $this->con->query($query);
        echo json_encode($res);
        if (!$res) {
            $err=  $this->con->error_list;
        }
        return $res;
    }
    
    public function retrieveInvoice(){
        $invData=$_POST['sData'];
        $fromDate=$invData['fromDate'];
        $toDate=$invData['toDate'];
        $result = mysqli_query($this->con, "SELECT invoiceheader.id, customer.fname,customer.lname,invoiceheader.invdate,"
                . " invoiceheader.netamount, invoiceheader.discount, invoiceheader.totamount" 
                . " FROM `invoiceheader` INNER JOIN customer on invoiceheader.cusid=customer.id "
                . " WHERE invoiceheader.delstatus=0 AND invoiceheader.invdate BETWEEN '" .$fromDate. "' AND '" .$toDate. "' ORDER BY invoiceheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function retrieveInvoiceCus(){
        $result = mysqli_query($this->con, "SELECT invoiceheader.id, customer.fname,customer.lname,invoiceheader.invdate,"
                . " invoiceheader.netamount, invoiceheader.discount, invoiceheader.totamount" 
                . " FROM `invoiceheader` INNER JOIN customer on invoiceheader.cusid=customer.id INNER JOIN invoicepayment ON "
                . " invoiceheader.id=invoicepayment.invNo "
                . " WHERE invoiceheader.delstatus=0 AND invoiceheader.cusid='" .$_POST['sData']. "' AND "
                . " (invoicepayment.invoiceamount-invoicepayment.totalpaid<>0) ORDER BY invoiceheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function cusWiseInvoice(){
        $invData=$_POST['sData'];
        $cus=$invData['customer'];
        $fromDate=$invData['fromDate'];
        $toDate=$invData['toDate'];
        $result = mysqli_query($this->con, "SELECT invoiceheader.id, customer.fname,customer.lname,invoiceheader.invdate,"
                . " invoiceheader.netamount, invoiceheader.discount, invoiceheader.totamount" 
                . " FROM `invoiceheader` INNER JOIN customer on invoiceheader.cusid=customer.id INNER JOIN invoicepayment ON "
                . " invoiceheader.id=invoicepayment.invNo "
                . " WHERE invoiceheader.delstatus=0 AND invoiceheader.cusid='" .$cus. "' AND "
                . " invoiceheader.invdate BETWEEN '" .$fromDate. "' AND '" .$toDate. "' ORDER BY invoiceheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function retrieveInvoiceNo($invNo){
        $result = mysqli_query($this->con, "SELECT invoiceheader.id, customer.fname,customer.lname, customer.address,customer.tp,"
                . " customer.email, invoiceheader.invdate, invoiceheader.cusid,"
                . " invoiceheader.netamount, invoiceheader.discount, invoiceheader.totamount, item.description,invoicedetails.* " 
                . " FROM `invoiceheader` INNER JOIN customer on invoiceheader.cusid=customer.id INNER JOIN invoicedetails ON "
                . " invoiceheader.id=invoicedetails.invno INNER JOIN item ON invoicedetails.itemid=item.id "
                . " WHERE invoiceheader.delstatus=0 AND invoiceheader.id='" .$invNo. "' ORDER BY invoiceheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function retrieveInvoiceDet() {
        $result = mysqli_query($this->con, "SELECT invoiceheader.totamount, invoicepayment.totalpaid"
                . " FROM invoiceheader INNER JOIN invoicepayment ON invoiceheader.id=invoicepayment.invNo "
                . " WHERE invoiceheader.id='" . $_POST['sData'] . "'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }

    public function totalInvoice(){
        $result = mysqli_query($this->con, "SELECT  sum(totamount) as totamount " 
                . " FROM `invoiceheader`  "
                . " WHERE delstatus=0 AND month(invdate)='".date('m')."' AND year(invdate)='".  date("Y")."'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function invoicePayments(){
        $result = mysqli_query($this->con, "SELECT  sum(invoicepayment.invoiceamount) as invAmount,sum(invoicepayment.totalPaid) as totpaid, "
                . " (sum(invoicepayment.invoiceamount)-sum(invoicepayment.totalPaid)) AS dueamount " 
                . " FROM `invoicepayment` INNER JOIN invoiceheader ON invoicepayment.invno=invoiceheader.id "
                . " WHERE invoiceheader.delstatus=0 AND month(invoiceheader.invdate)='".date('m')."' AND "
                . " year(invoiceheader.invdate)='".  date("Y")."'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
