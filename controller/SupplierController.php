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
class SupplierController extends BaseController {

    //put your code here
    public function newSupplier() {
        $this->loadView();
    }

    public function supplierList() {
        $this->loadView();
    }

    public function newSupplierPayment() {
        $this->loadView();
    }

    public function supplierPaymentList() {
        $this->loadView();
    }

    public function supplierDuePaymentList() {
        $this->loadView();
    }

    public function loadSuppliers() {
        $supplier = new Supplier();
        $supplier->findList();
    }
    
    function loadName(){
        $supplier=new Supplier();
        $supplier->loadName();
    }

    public function addSupplier() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $supData = $_POST['supData'];

        if ($supData['status'] === "true") {
            $status = 1;
        } else {
            $status = 0;
        }

        $supplier = new Supplier();

        $supplier->fname = $supData['fName'];
        $supplier->lname = $supData['lName'];
        $supplier->address = $supData['address'];
        $supplier->tp = $supData['telephone'];
        $supplier->mobile = $supData['mobile'];
        $supplier->email = $supData['email'];
        $supplier->status = $status;

        $res = $supplier->save();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function updateSupplier() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $supData = $_POST['supData'];
        if ($supData['status'] === "true") {
            $status = 1;
        } else {
            $status = 0;
        }

        $supplier = new Supplier();

        $supplier->id = $supData['supId'];
        $supplier->fname = $supData['fName'];
        $supplier->lname = $supData['lName'];
        $supplier->address = $supData['address'];
        $supplier->tp = $supData['telephone'];
        $supplier->mobile = $supData['mobile'];
        $supplier->email = $supData['email'];
        $supplier->status = $status;

        $res = $supplier->update();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

}
