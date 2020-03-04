<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of GRNPayment
 *
 * @author Nadeeshani
 */
class GRNPayment extends IdentifiedBaseModel{
    //put your code here
    public $grnNo;
    public $supId;
    public $grnAmount;
    public $totalPaid;
    
    public function updateGRNPay($id, $amount) {
        $query = "UPDATE grnpayment SET totalpaid=totalpaid + $amount WHERE grnno='$id'";
        $res = $this->con->query($query);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }
}
