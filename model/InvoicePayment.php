<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoicePayment
 *
 * @author Nadeeshani
 */
class InvoicePayment extends IdentifiedBaseModel{
    //put your code here
    public $invNo;
    public $cusId;
    public $invoiceAmount;
    public $totalPaid;
    
    public function updateInvPay($id, $amount) {
        $query = "UPDATE invoicepayment SET totalpaid=totalpaid + $amount WHERE invno='$id'";
        $res = $this->con->query($query);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }
}
