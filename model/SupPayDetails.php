<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierPayDetails
 *
 * @author Nadeeshani
 */
class SupPayDetails extends IdentifiedBaseModel{
    //put your code here
    public $supPayId;
    public $grnNo;
    public $grnAmount;
    public $paidAmount;
    public $payAmount;
    
    public function updateGRNPay($id, $amount) {
        $query = "UPDATE grnpayment SET totalpaid=totalpaid + $amount WHERE grnno='$id'";
        $res = $this->con->query($query);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }
    
    public function deleteSupPayDetails($id){
        $query=  "DELETE FROM suppaydetails WHERE suppayid='$id'";
        $res=  $this->con->query($query);
//        echo json_encode($res);
        if (!$res) {
            $err=  $this->con->error_list;
        }
        return $res;
    }
}
