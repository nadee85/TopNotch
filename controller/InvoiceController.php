<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InvoiceController
 *
 * @author Nadeeshani
 */
class InvoiceController extends BaseController{
    //put your code here
    function newInvoice(){
        $this->loadView();
    }
    
    function invoiceList(){
        $this->loadView();
    }
}
