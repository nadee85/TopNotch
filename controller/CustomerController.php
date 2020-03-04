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

    public function returnEmpty() {
        $this->loadView();
    }

    public function updateCusPayment() {
        $this->loadView();
    }

    public function ReturnEmptyList(){
        $this->loadView();
    }

    public function loadRT() {
        $returnBottleHeader = new ReturnBottleHeader();
        $returnBottleHeader->loadID();
    }

    public function loadByName() {
        $customer = new Customer();
        $name = $_POST['fname'];
        $customer->findByField('fname', $name);
    }

    function loadName() {
        $customer = new Customer();
        $customer->loadName();
    }

    function totalCus(){
        $customer=new Customer();
        $customer->totalCus();
    }

    function returnEmptyBot(){
        $returnBottleHeader=new ReturnBottleHeader();
        $returnBottleHeader->returnEmptyBot();
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

    public function loadCusPayNo() {
        $customerPaymentHeader = new CustomerPaymentHeader();
        $customerPaymentHeader->loadID();
    }

    public function loadCusPayments() {
        $customerPaymentHeader = new CustomerPaymentHeader();
        $customerPaymentHeader->loadCusPayment();
    }

    public function loadTotalPayment(){
        $customerPaymentHeader=new CustomerPaymentHeader();
        $customerPaymentHeader->loadTotalPayment();
    }

    public function loadCusDuePayments() {
        $customerPaymentHeader = new CustomerPaymentHeader();
        $customerPaymentHeader->loadCusDuePayment();
    }

    public function retrieveCusPay() {
        $customerPaymentHeader = new CustomerPaymentHeader();
        $customerPaymentHeader->retrieveCusPayments($_POST['cusPayNo']);
    }

    public function addCustomer() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $cusData = $_POST["cusData"];

        if ($cusData['status'] === "true") {
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
        if ($cusData['status'] === "true") {
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

        $res = $customer->update();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function addCusPayment() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }
        $cusPayData = $_POST['cusPayData'];
        $customerPaymentHeader = new CustomerPaymentHeader();
        $customerPaymentHeader->id = $cusPayData['id'];
        $customerPaymentHeader->cusId = $cusPayData['cusId'];
        $customerPaymentHeader->PayDate = $cusPayData['cusPayDate'];
        $customerPaymentHeader->totAmount = $cusPayData['totAmount'];
        $customerPaymentHeader->UserId = 
                $_SESSION['user']['name']['username'];
        $customerPaymentHeader->delStatus = "0";
        $customerPaymentHeader->delDate = date("Y-m-d");
        $resHeader = $customerPaymentHeader->save();
        $invoicePayment = new InvoicePayment();
        $customerPaymentDetails = new CustomerPaymentDetails();
        $tableData = stripcslashes($cusPayData['tableData']);
        $tableData = json_decode($tableData, TRUE);
        for ($i = 0; $i < count($tableData); $i++) {
            $customerPaymentDetails->cusPayId = $cusPayData['id'];
            $customerPaymentDetails->invNo = $tableData[$i]['invNo'];
            $customerPaymentDetails->invAmount = $tableData[$i]['invAmo'];
            $customerPaymentDetails->paidAmount = $tableData[$i]['paidAmo'];
            $customerPaymentDetails->payAmount = $tableData[$i]['payAmo'];
            $resItem = $customerPaymentDetails->save();
            $resRMaterial = $invoicePayment->
                    updateInvPay($tableData[$i]['invNo'], 
                            $tableData[$i]['payAmo']);
        }
        echo json_encode($resHeader);
        if (!($resHeader && $resItem)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function customerPaymentUpdate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $cusPayData = $_POST['cusPayData'];

        $customerPaymentHeader = new CustomerPaymentHeader();

        $customerPaymentHeader->id = $cusPayData['id'];
        $customerPaymentHeader->cusId = $cusPayData['cusId'];
        $customerPaymentHeader->PayDate = $cusPayData['cusPayDate'];
        $customerPaymentHeader->totAmount = $cusPayData['totAmount'];
        $customerPaymentHeader->UserId = $_SESSION['user']['name']['username'];
        $customerPaymentHeader->delStatus = 0;
        $customerPaymentHeader->delDate = date("Y-m-d");

        $resHeader = $customerPaymentHeader->update();

        $invoicePayment = new InvoicePayment();

        $customerPaymentDetails = new CustomerPaymentDetails();

        $tableData = stripcslashes($cusPayData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        $data = $customerPaymentDetails->getDataById("cuspayid", $cusPayData['id']);

        for ($i = 0; $i < count($customerPaymentDetails->getDataById("cuspayid", $cusPayData['id'])); $i++) {
            $payAmo = $data[$i]['payAmount'];
            $invoicePayment->updateInvPay($data[$i]['invNo'], $payAmo * (-1));
        }

        $resdel = $customerPaymentDetails->deleteCusPayDetails($cusPayData['id']);

        for ($i = 0; $i < count($tableData); $i++) {
            $customerPaymentDetails->cusPayId = $cusPayData['id'];
            $customerPaymentDetails->invNo = $tableData[$i]['invNo'];
            $customerPaymentDetails->invAmount = $tableData[$i]['invAmo'];
            $customerPaymentDetails->paidAmount = $tableData[$i]['paidAmo'];
            $customerPaymentDetails->payAmount = $tableData[$i]['payAmo'];
            $resItem = $customerPaymentDetails->save();

            $resRMaterial = $invoicePayment->updateInvPay($tableData[$i]['invNo'], $tableData[$i]['payAmo']);
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resItem)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function addReturn() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $retData = $_POST['retData'];

        $returnBottleHeader = new ReturnBottleHeader();

        $returnBottleHeader->id = $retData['id'];
        $returnBottleHeader->cusId = $retData['cusId'];
        $returnBottleHeader->dateAdded = $retData['retDate'];

        $resHeader = $returnBottleHeader->save();

        $returnBottleDetails = new ReturnBottleDetails();

        $tableData = stripcslashes($retData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        for ($i = 0; $i < count($tableData); $i++) {
            $returnBottleDetails->RetNo = $retData['id'];
            $returnBottleDetails->RawMatId = $tableData[$i]['itemId'];
            $returnBottleDetails->Qty = $tableData[$i]['qty'];
            $resItem = $returnBottleDetails->save();
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resItem)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    function deleteCusPay() {
        $customerPaymentHeader = new CustomerPaymentHeader();
        $customerPaymentHeader->deleteInvoice();

        $invoicePayment = new InvoicePayment();
        $customerPaymentDetails = new CustomerPaymentDetails();

        $data = $customerPaymentDetails->getDataById("cuspayid", $_POST['id']);

        for ($i = 0; $i < count($customerPaymentDetails->getDataById("cuspayid", $_POST['id'])); $i++) {
            $payAmo = $data[$i]['payAmount'];
            $invoicePayment->updateInvPay($data[$i]['invNo'], $payAmo * (-1));
        }
    }

}
