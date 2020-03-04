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
class InvoiceController extends BaseController {

    //put your code here
    function newInvoice() {
        $this->loadView();
    }

    function invoiceList() {
        $this->loadView();
    }

    function updateInvoice() {
        $this->loadView();
    }

    function Invoice() {
        $this->loadView();
    }

    public function LoadInvNo() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->loadID();
    }

    public function loadInvoice() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->loadInvoice();
    }

    public function totalInvoice() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->totalInvoice();
    }

    public function invoicePayments() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->invoicePayments();
    }

    public function retrieveInvoice() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->retrieveInvoice();
    }

    public function retrieveInvoiceCus() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->retrieveInvoiceCus();
    }

    public function retrieveInvoiceDet() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->retrieveInvoiceDet();
    }

    public function retrieveInvoiceNo() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->retrieveInvoiceNo($_POST['sData']);
    }

    public function retrieveInv() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->retrieveInvoiceNo($_POST['invNo']);
    }

    public function addInvoice() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $invData = $_POST['invData'];

        $invoiceHeader = new InvoiceHeader();

        $invoiceHeader->id = $invData['id'];
        $invoiceHeader->cusid = $invData['cusId'];
        $invoiceHeader->invDate = $invData['invDate'];
        $invoiceHeader->netAmount = $invData['netAmount'];
        $invoiceHeader->discount = $invData['discount'];
        $invoiceHeader->totAmount = $invData['totAmount'];
        $invoiceHeader->status = 1;
        $invoiceHeader->UserId = $_SESSION['user']['name']['username'];
        $invoiceHeader->delStatus = "0";
        $invoiceHeader->delDate = date("Y-m-d");

        $resHeader = $invoiceHeader->save();

        $invoicePayment = new InvoicePayment();
        $invoicePayment->invNo = $invData['id'];
        $invoicePayment->cusId = $invData['cusId'];
        $invoicePayment->invoiceAmount = $invData['totAmount'];
        $invoicePayment->totalPaid = "0";

        $resPay = $invoicePayment->save();

        $invoiceDetails = new invoiceDetails();
        $item = new Item();

        $tableData = stripcslashes($invData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        for ($i = 0; $i < count($tableData); $i++) {
            $invoiceDetails->invNo = $invData['id'];
            $invoiceDetails->itemId = $tableData[$i]['ItemId'];
            $invoiceDetails->sellPrice = $tableData[$i]['price'];
            $invoiceDetails->qty = $tableData[$i]['qty'];
            $invoiceDetails->amount = $tableData[$i]['amount'];
            $resItem = $invoiceDetails->save();

            $resRMaterial = $item->updateItems($tableData[$i]['ItemId'], $tableData[$i]['qty']);
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resItem)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function invoiceUpdate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $invData = $_POST['invData'];

        $invoiceHeader = new InvoiceHeader();

        $invoiceHeader->id = $invData['id'];
        $invoiceHeader->cusid = $invData['cusId'];
        $invoiceHeader->invDate = $invData['invDate'];
        $invoiceHeader->netAmount = $invData['netAmount'];
        $invoiceHeader->discount = $invData['discount'];
        $invoiceHeader->totAmount = $invData['totAmount'];
        $invoiceHeader->status = 1;
        $invoiceHeader->UserId = $_SESSION['user']['name']['username'];
        $invoiceHeader->delStatus = 0;
        $invoiceHeader->delDate = date("Y-m-d");

        $resHeader = $invoiceHeader->update();

        $invoiceDetails = new invoiceDetails();
        $item = new Item();

        $tableData = stripcslashes($invData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        $data = $invoiceDetails->getDataById("invno", $invData['id']);

        for ($i = 0; $i < count($invoiceDetails->getDataById("invno", $invData['id'])); $i++) {
            $qty = $data[$i]['qty'];
            $resdet = $item->updateItems($data[$i]['itemId'], $qty * (-1));
        }

        $resdel = $invoiceDetails->deleteInvDetails($invData['id']);

        for ($i = 0; $i < count($tableData); $i++) {
            $invoiceDetails->invNo = $invData['id'];
            $invoiceDetails->itemId = $tableData[$i]['itemId'];
            $invoiceDetails->sellPrice = $tableData[$i]['price'];
            $invoiceDetails->qty = $tableData[$i]['qty'];
            $invoiceDetails->amount = $tableData[$i]['amount'];
            $resItem = $invoiceDetails->save();

            $resRMaterial = $item->updateItems($tableData[$i]['itemId'], $tableData[$i]['qty']);
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resItem)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    function deleteInvoice() {
        $invoiceHeader = new InvoiceHeader();
        $invoiceHeader->deleteInvoice();

        $item = new Item();
        $invoiceDetails = new invoiceDetails();

        $data = $invoiceDetails->getDataById("invNo", $_POST['id']);

        for ($i = 0; $i < count($invoiceDetails->getDataById("invNo", $_POST['id'])); $i++) {
            $qty = $data[$i]['qty'];
            $item->updateItems($data[$i]['itemId'], $qty * (-1));
        }
    }

}
