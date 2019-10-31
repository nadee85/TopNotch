<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of POController
 *
 * @author Nadeeshani
 */
class POController extends BaseController {
    
    public $pono;

    function newPO() {
        $this->loadView();
    }

    function poList() {
        $this->loadView();
    }

    function updatePO() {
        $this->loadView();
    }

    function loadPONo() {
        $poHeader = new POHeader();
        $poHeader->loadId();
    }

    function loadPO() {
        $poHeader = new POHeader();
        $poHeader->loadPO();
    }

    function loadByPo() {
        $poHeader = new POHeader();
        $poHeader->findByPO();
    }

    function findBySupId() {
        $poHeader = new POHeader();
        $poHeader->findBySupId();
    }

    function findByDate() {
        $poHeader = new POHeader();
        $poHeader->findByDate();
    }

    function retrievePO() {
        $poHeader = new POHeader();
        $poHeader->retrievePO();
    }

    public function addPO() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $poData = $_POST['poData'];

        $poHeader = new POHeader();

        $poHeader->id = $poData['id'];
        $poHeader->supid = $poData['supId'];
        $poHeader->poDate = $poData['poDate'];
        $poHeader->UserId = $_SESSION['user']['name']['username'];
        $poHeader->delStatus = 0;

        $resHeader = $poHeader->save();

        $poItem = new POItem();

        $tableData = stripcslashes($poData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        for ($i = 0; $i < count($tableData); $i++) {
            $poItem->poNo = $poData['id'];
            $poItem->rItemId = $tableData[$i]['rItemId'];
            $poItem->qty = $tableData[$i]['qty'];
            $resItem = $poItem->save();
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resItem)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function poUpdate() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $poData = $_POST['poData'];

        $poHeader = new POHeader();

        $poHeader->id = $poData['id'];
        $poHeader->supid = $poData['supId'];
        $poHeader->poDate = $poData['poDate'];
        $poHeader->UserId = $_SESSION['user']['name']['username'];
        $poHeader->delStatus = 0;

        $resHeader = $poHeader->update();

        $tableData = stripcslashes($poData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        $poItem = new POItem();
        $resdel = $poItem->deletePOItem($poData['id']);

        for ($i = 0; $i < count($tableData); $i++) {
            $poItem->poNo = $poData['id'];
            $poItem->rItemId = $tableData[$i]['rItemId'];
            $poItem->qty = $tableData[$i]['qty'];
            $resItem = $poItem->save();
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resdel)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    function deletePO() {
        $poHeader = new POHeader();
        $poHeader->deletePO();
    }

}
