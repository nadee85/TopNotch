<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerPaymentHeader
 *
 * @author Nadeeshani
 */
class CustomerPaymentHeader extends IdentifiedBaseModel{
    //put your code here
    public $id;
    public $cusId;
    public $PayDate;
    public $totAmount;
    public $UserId;
    public $delStatus;
    public $delDate;
 
    public function loadCusPayment(){
        $result = mysqli_query($this->con, "SELECT customerpaymentheader.id, customer.fname,customer.lname,customerpaymentheader.paydate,"
                . " customerpaymentheader.totamount" 
                . " FROM `customerpaymentheader` INNER JOIN customer on customerpaymentheader.cusid=customer.id "
                . " WHERE customerpaymentheader.delstatus=0 ORDER BY customerpaymentheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function deleteInvoice(){
        $query=  "UPDATE customerpaymentheader SET delstatus=1, deldate='".  date("Y-m-d")."' WHERE id='".$_POST['id']."'";
        $res=  $this->con->query($query);
        echo json_encode($res);
        if (!$res) {
            $err=  $this->con->error_list;
        }
        return $res;
    }
    
    public function retrieveCusPayments($cusPayNo){
        $result = mysqli_query($this->con, "SELECT customerpaymentheader.id, customer.fname,customer.lname, customer.address,customer.tp,"
                . " customer.email, customerpaymentheader.paydate, customerpaymentheader.cusid,"
                . " customerpaymentheader.totamount, customerpaymentdetails.* " 
                . " FROM `customerpaymentheader` INNER JOIN customer on customerpaymentheader.cusid=customer.id INNER JOIN "
                . " customerpaymentdetails ON customerpaymentheader.id=customerpaymentdetails.cuspayid "
                . " WHERE customerpaymentheader.delstatus=0 AND customerpaymentheader.id='" .$cusPayNo. "'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function loadCusDuePayment(){
        $result = mysqli_query($this->con, "SELECT invoicepayment.invoiceAmount,invoicepayment.totalPaid,"
                . " (invoicepayment.invoiceAmount-invoicepayment.totalPaid) AS balAmount,"
                . " customer.fname,customer.lname, invoiceheader.invDate, invoiceheader.id FROM invoicepayment INNER JOIN invoiceheader ON"
                . " invoicepayment.invNo=invoiceheader.id INNER JOIN customer ON invoicepayment.cusId=customer.id "
                . " WHERE (invoicepayment.invoiceAmount-invoicepayment.totalPaid<>0)");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
     public function loadTotalPayment(){
        $result = mysqli_query($this->con, "SELECT sum(totamount) as totamount " 
                . " FROM `customerpaymentheader` "
                . " WHERE delstatus=0 AND month(paydate)='".date('m')."' AND year(paydate)='".  date("Y")."'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function cusWisePayment(){
        $payData=$_POST['sData'];
        $cus=$payData['customer'];
        $fromDate=$payData['fromDate'];
        $toDate=$payData['toDate'];
        $result = mysqli_query($this->con, "SELECT customerpaymentheader.id, customer.fname,customer.lname,customerpaymentheader.paydate,"
                . " customerpaymentheader.totamount" 
                . " FROM `customerpaymentheader` INNER JOIN customer on customerpaymentheader.cusid=customer.id "
                . " WHERE customerpaymentheader.delstatus=0 AND customerpaymentheader.cusid='" .$cus. "' AND "
                . " customerpaymentheader.paydate BETWEEN '" .$fromDate. "' AND '" .$toDate. "' ORDER BY customerpaymentheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
