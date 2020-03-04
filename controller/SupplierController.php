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

    public function updateSupPayment() {
        $this->loadView();
    }

    public function loadSupPayNo() {
        $supplierPaymentHeader = new SupplierPayHeader();
        $supplierPaymentHeader->loadID();
    }

    public function loadSuppliers() {
        $supplier = new Supplier();
        $supplier->findList();
    }

    public function totalSup() {
        $supplier=new Supplier();
        $supplier->totalSup();
    }

    public function loadSupPayments() {
        $supplierPayHeader = new SupplierPayHeader();
        $supplierPayHeader->loadSupPayment();
    }

    function loadName() {
        $supplier = new Supplier();
        $supplier->loadName();
    }

    public function retrieveSupPay() {
        $supplierPayHeader = new SupplierPayHeader();
        $supplierPayHeader->retrieveSupPayments($_POST['supPayNo']);
    }

    public function loadSupDuePayments() {
        $supplierPaymentHeader = new SupplierPayHeader();
        $supplierPaymentHeader->loadSupDuePayment();
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

    public function addSupPayment() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $supPayData = $_POST['supPayData'];

        $supplierPaymentHeader = new SupplierPayHeader();

        $supplierPaymentHeader->id = $supPayData['id'];
        $supplierPaymentHeader->supId = $supPayData['supId'];
        $supplierPaymentHeader->payDate = $supPayData['supPayDate'];
        $supplierPaymentHeader->totalAmount = $supPayData['totAmount'];
        $supplierPaymentHeader->UserID = 
                $_SESSION['user']['name']['username'];
        $supplierPaymentHeader->delStatus = "0";
        $supplierPaymentHeader->delDate = date("Y-m-d");

        $resHeader = $supplierPaymentHeader->save();

        $grnPayment = new GRNPayment();

        $supplierPaymentDetails = new SupPayDetails();

        $tableData = stripcslashes($supPayData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        for ($i = 0; $i < count($tableData); $i++) {
            $supplierPaymentDetails->supPayId = $supPayData['id'];
            $supplierPaymentDetails->grnNo = $tableData[$i]['grnNo'];
            $supplierPaymentDetails->grnAmount = $tableData[$i]['grnAmo'];
            $supplierPaymentDetails->paidAmount = $tableData[$i]['paidAmo'];
            $supplierPaymentDetails->payAmount = $tableData[$i]['payAmo'];
            $resItem = $supplierPaymentDetails->save();

            $resRMaterial = $grnPayment->
                    updateGRNPay($tableData[$i]['grnNo'], $tableData[$i]['payAmo']);
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resItem)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function supplierPaymentUpdate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $supPayData = $_POST['supPayData'];

        $supplierPaymentHeader = new SupplierPayHeader();

        $supplierPaymentHeader->id = $supPayData['id'];
        $supplierPaymentHeader->supId = $supPayData['supId'];
        $supplierPaymentHeader->payDate = $supPayData['supPayDate'];
        $supplierPaymentHeader->totalAmount = $supPayData['totAmount'];
        $supplierPaymentHeader->UserID = $_SESSION['user']['name']['username'];
        $supplierPaymentHeader->delStatus = 0;
        $supplierPaymentHeader->delDate = date("Y-m-d");

        $resHeader = $supplierPaymentHeader->update();

        $grnPayment = new GRNPayment();

        $supPayDetails = new SupPayDetails();

        $tableData = stripcslashes($supPayData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        $data = $supPayDetails->getDataById("suppayid", $supPayData['id']);

        for ($i = 0; $i < count($supPayDetails->getDataById("suppayid", $supPayData['id'])); $i++) {
            $payAmo = $data[$i]['payAmount'];
            $grnPayment->updateGRNPay($data[$i]['grnNo'], $payAmo * (-1));
        }

        $resdel = $supPayDetails->deleteSupPayDetails($supPayData['id']);

        for ($i = 0; $i < count($tableData); $i++) {
            $supPayDetails->supPayId = $supPayData['id'];
            $supPayDetails->grnNo = $tableData[$i]['grnNo'];
            $supPayDetails->grnAmount = $tableData[$i]['grnAmo'];
            $supPayDetails->paidAmount = $tableData[$i]['paidAmo'];
            $supPayDetails->payAmount = $tableData[$i]['payAmo'];
            $resItem = $supPayDetails->save();

            $resRMaterial = $grnPayment->updateGRNPay($tableData[$i]['grnNo'], $tableData[$i]['payAmo']);
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resItem)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    function deleteSupPay() {
        $supplierPayHeader = new SupplierPayHeader();
        $supplierPayHeader->deleteSupPay();

        $grnPayment = new GRNPayment();
        $supPayDetails = new SupPayDetails();

        $data = $supPayDetails->getDataById("suppayid", $_POST['id']);

        for ($i = 0; $i < count($supPayDetails->getDataById("suppayid", $_POST['id'])); $i++) {
            $payAmo = $data[$i]['payAmount'];
            $grnPayment->updateGRNPay($data[$i]['grnNo'], $payAmo * (-1));
        }
    }

}
