<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grnController
 *
 * @author Nadeeshani
 */
class grnController extends BaseController {

    //put your code here
    public function newGRN() {
        $this->loadView();
    }

    public function grnList() {
        $this->loadView();
    }

    public function updateGRN() {
        $this->loadView();
    }

    public function loadGRNNO() {
        $grnHeader = new GRNHeader();
        $grnHeader->loadID();
    }

    public function loadGRN() {
        $grnHeader = new GRNHeader();
        $grnHeader->loadGRN();
    }

    public function retrieveGRN() {
        $grnHeader = new GRNHeader();
        $grnHeader->retrieveGRN();
    }

    public function retrieveGRNSup() {
        $grnHeader = new GRNHeader();
        $grnHeader->retrieveGRNSup();
    }

    public function retrieveGRNDet() {
        $grnHeader = new GRNHeader();
        $grnHeader->retrieveGRNDet();
    }

    public function totalGRN() {
        $grnHeader = new GRNHeader();
        $grnHeader->totalGRN();
    }

    public function addGRN() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $grnData = $_POST['grnData'];

        $grnHeader = new GRNHeader();

        $grnHeader->id = $grnData['id'];
        $grnHeader->supid = $grnData['supId'];
        $grnHeader->grnDate = $grnData['grnDate'];
        $grnHeader->totalAmount = $grnData['totAmount'];
        $grnHeader->UserId = $_SESSION['user']['name']['username'];
        $grnHeader->delStatus = "0";

        $resHeader = $grnHeader->save();

        $grnPayment = new GRNPayment();
        $grnPayment->grnNo = $grnData['id'];
        $grnPayment->supId = $grnData['supId'];
        $grnPayment->grnAmount = $grnData['totAmount'];
        $grnPayment->totalPaid = "0";

        $resPay = $grnPayment->save();

        $grnItem = new grnItem();
        $rawMaterial = new RawMaterials();

        $tableData = stripcslashes($grnData['tableData']);
        $tableData = json_decode($tableData, TRUE);
        for ($i = 0; $i < count($tableData); $i++) {
            $grnItem->grnNo = $grnData['id'];
            $grnItem->rItemId = $tableData[$i]['rItemId'];
            $grnItem->purPrice = $tableData[$i]['price'];
            $grnItem->qty = $tableData[$i]['qty'];
            $grnItem->amount = $tableData[$i]['amount'];
            $resItem = $grnItem->save();

            $resRMaterial = $rawMaterial->
                    updateRawMaterials($tableData[$i]['rItemId'], 
                            $tableData[$i]['qty']);
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resItem)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function grnUpdate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $grnData = $_POST['grnData'];

        $grnHeader = new GRNHeader();

        $grnHeader->id = $grnData['id'];
        $grnHeader->supid = $grnData['supId'];
        $grnHeader->grnDate = $grnData['grnDate'];
        $grnHeader->totalAmount = $grnData['totAmount'];
        $grnHeader->UserId = $_SESSION['user']['name']['username'];
        $grnHeader->delStatus = 0;

        $resHeader = $grnHeader->update();

        $tableData = stripcslashes($grnData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        $grnItem = new grnItem();
        $rawMaterial = new RawMaterials();

        $data = $grnItem->getDataById("grnno", $grnData['id']);

        for ($i = 0; $i < count($grnItem->getDataById("grnno", $grnData['id'])); $i++) {
            $qty = $data[$i]['qty'];
            $rawMaterial->updateRawMaterials($data[$i]['rItemId'], $qty * (-1));
        }

        $resdel = $grnItem->deleteGRNItem($grnData['id']);

        for ($i = 0; $i < count($tableData); $i++) {
            $grnItem->grnNo = $grnData['id'];
            $grnItem->rItemId = $tableData[$i]['rItemId'];
            $grnItem->purPrice = $tableData[$i]['price'];
            $grnItem->qty = $tableData[$i]['qty'];
            $grnItem->amount = $tableData[$i]['amount'];
            $resItem = $grnItem->save();

            $resRMaterial = $rawMaterial->updateRawMaterials($tableData[$i]['rItemId'], $tableData[$i]['qty']);
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resdel && $resRMaterial)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    function deleteGRN() {
        $grnHeader = new GRNHeader();
        $grnHeader->deleteGRN();

        $grnItem = new grnItem();
        $rawMaterial = new RawMaterials();

        $data = $grnItem->getDataById("grnno", $_POST['id']);

        for ($i = 0; $i < count($grnItem->getDataById("grnno", $_POST['id'])); $i++) {
            $qty = $data[$i]['qty'];
            $rawMaterial->updateRawMaterials($data[$i]['rItemId'], $qty * (-1));
        }
    }

}
