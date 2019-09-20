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
class CustomerController extends BaseController {

//put your code here
    public function newCustomer() {
        $this->loadView();
    }

    public function customerList() {
        $this->loadView();
    }

    public function loadCustomers() {
        $customer = new Customer();
        $res = $customer->findList();
    }

    public function loadByName() {
        $customer = new Customer();
        $customer->findByName();
    }

    public function newCustomerPayment() {
        $this->loadView();
    }

    public function customerPaymentList() {
        $this->loadView();
    }

    public function customerDuePaymentList() {
        $this->loadView();
    }

    public function addCustomer() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $cusData = $_POST["cusData"];

        if ($cusData['status']==="true") {
            $status = 1;
        } else {
            $status = 0;
        }
        $customer = new Customer();

//        $customer->id = $cusData['cusId'];
        $customer->fname = $cusData['fName'];
        $customer->lname = $cusData['lName'];
        $customer->address = $cusData['address'];
        $customer->tp = $cusData['telephone'];
        $customer->mobile = $cusData['mobile'];
        $customer->email = $cusData['email'];
        $customer->status = $status;


        $res = $customer->save();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function updateCustomer() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $cusData = $_POST["cusData"];
        if ($cusData['status']==="true") {
            $status = 1;
        } else {
            $status = 0;
        }
        $customer = new Customer();

        $customer->id = $cusData['cusId'];
        $customer->fname = $cusData['fName'];
        $customer->lname = $cusData['lName'];
        $customer->address = $cusData['address'];
        $customer->tp = $cusData['telephone'];
        $customer->mobile = $cusData['mobile'];
        $customer->email = $cusData['email'];
        $customer->status = $status;

        $res=$customer->update();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    

}
