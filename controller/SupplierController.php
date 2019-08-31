<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of SupplierController
 *
 * @author Nadeeshani
 */
class SupplierController extends BaseController{
    //put your code here
    public function newSupplier() {
        $this->loadView();
    }
    
    public function  supplierList(){
        $this->loadView();
    }
    
    public function newSupplierPayment(){
        $this->loadView();
    }
    
    public function supplierPaymentList(){
        $this->loadView();
    }
    
    public function supplierDuePaymentList(){
        $this->loadView();
    }
}
