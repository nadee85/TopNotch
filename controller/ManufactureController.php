<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManufactureControl
 *
 * @author Nadeeshani
 */
class ManufactureController extends BaseController {

    //put your code here
    public function ManufacturingItems() {
        $this->loadView();
    }

    public function Manufacture() {
        $this->loadView();
    }
    
    public function ManufactureItemList(){
        $this->loadView();
    }

    public function loadManItemNo() {
        $manItemHeader = new ManItemHeader();
        $manItemHeader->loadID();
    }

    function loadManNo() {
        $manHeader = new ManHeader();
        $manHeader->loadID();
    }
    
    function totalManufacture(){
        $manheader=new ManHeader();
        $manheader->totalManufacture();
    }
            
    function getEmpty(){
        $returnBottleHeader=new ReturnBottleHeader();
        $returnBottleHeader->getEmpty();
    }

    function getCurStock(){
        $manHeader=new ManHeader();
        $manHeader->getCurStock();
    }

    public function addManItem() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $manItemData = $_POST['manItemData'];

        $manItemHeader = new ManItemHeader();

        $manItemHeader->Id = $manItemData['id'];
        $manItemHeader->ItemId = $manItemData['itemId'];

        $resHeader = $manItemHeader->save();

        $manItemDetails = new ManItemDetails();

        $tableData = stripcslashes($manItemData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        for ($i = 0; $i < count($tableData); $i++) {
            $manItemDetails->manId = $manItemData['id'];
            $manItemDetails->rawMatId = $tableData[$i]['rItemId'];
            $manItemDetails->Qty = $tableData[$i]['qty'];
            $resItem = $manItemDetails->save();
        }

        echo json_encode($resHeader);
        if (!($resHeader && $resItem)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    public function addMan(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $manData = $_POST['manData'];

        $manHeader = new ManHeader();

        if ($manData['retBot'] === "true") {
            $status = 1;
        } else {
            $status = 0;
        }
        
        $manHeader->id= $manData['id'];
        $manHeader->manDate = $manData['manDate'];
        $manHeader->cusId= $manData['cusId'];
        $manHeader->retBot= $status;

        $resHeader = $manHeader->save();

        $manDetails = new ManDetails();
        $returnBottleHeader=new ReturnBottleHeader();

        $tableData = stripcslashes($manData['tableData']);
        $tableData = json_decode($tableData, TRUE);

        for ($i = 0; $i < count($tableData); $i++) {
            $manDetails->manId = $manData['id'];
            $manDetails->itemId=$tableData[$i]['ItemId'];
            $manDetails->qty = $tableData[$i]['qty'];
            $resDetail = $manDetails->save();
            
            $resRMaterial = $returnBottleHeader->
                    updateRowMat($tableData[$i]['ItemId'], 
                            $tableData[$i]['qty'],$manData['cusId']);
            
            $resItem=$manHeader->
                    updateItems($tableData[$i]['ItemId'], 
                            $tableData[$i]['qty']);
        }

        echo json_encode($resRMaterial);
        if (!($resHeader && $resDetail)) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

    public function exists() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $itemid = $_POST["cmbItem"];
        $item = new ManItemHeader();
        $item->checkItemId($itemid);
    }
    
    public function checkStock(){
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $username = $_POST["username"];
        $user = new User();
        $user->checkId($username);
    }
    
    public function manItemDetails(){
        $manItemHeader=new ManItemHeader();
        $manItemHeader->manItemDetails();
    }
}
