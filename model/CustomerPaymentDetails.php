<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerPaymentDetails
 *
 * @author Nadeeshani
 */
class CustomerPaymentDetails extends IdentifiedBaseModel{
    //put your code here
    public $cusPayId;
    public $invNo;
    public $invAmount;
    public $paidAmount;
    public $payAmount;
    
    public function deleteCusPayDetails($id){
        $query=  "DELETE FROM customerpaymentdetails WHERE cuspayid='$id'";
        $res=  $this->con->query($query);
//        echo json_encode($res);
        if (!$res) {
            $err=  $this->con->error_list;
        }
        return $res;
    }
}
