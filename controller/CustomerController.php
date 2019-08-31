<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CustomerController
 *
 * @author Nadeeshani
 */
class CustomerController extends BaseController{
    //put your code here
    public function newCustomer(){
        $this->loadView();
    }
    
    public function customerList(){
        $this->loadView();
    }
    
    public function newCustomerPayment(){
        $this->loadView();
    }
    
    public function customerPaymentList(){
        $this->loadView();
    }
    
    public function customerDuePaymentList(){
        $this->loadView();
    }
}
