<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ItemController
 *
 * @author Nadeeshani
 */
class ItemController extends BaseController {

    //put your code here
    public function newItem() {
        $this->loadView();
    }

    public function itemList() {
        $this->loadView();
    }
    
    public function itemStock(){
        $this->loadView();
    }

    public function loadItems() {
        $item = new Item();
        $item->findList();
    }

    public function loadDescription(){
        $item=new Item();
        $item->loadDescription();
    }
    
    public function getPrice(){
        $item=new Item();
        $item->getPrice();
    }

    public function totalStock(){
        $item=new Item();
        $item->totalStock();
    }

    public function addItem() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $itemData = $_POST['itemData'];

        if ($itemData['status'] === "true") {
            $status = 1;
        } else {
            $status = 0;
        }

        $item = new Item();

        $item->id = $itemData['itemId'];
        $item->description = $itemData['description'];
        $item->price = $itemData['price'];
        $item->curStock = $itemData['stock'];
        $item->reOrderLevel=$itemData['reOrder'];
        $item->status = $status;

        $res = $item->save();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    public function updateItem(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $itemData = $_POST['itemData'];

        if ($itemData['status'] === "true") {
            $status = 1;
        } else {
            $status = 0;
        }

        $item = new Item();

        $item->id = $itemData['itemId'];
        $item->description = $itemData['description'];
        $item->price = $itemData['price'];
        $item->curStock = $itemData['stock'];
        $item->reOrderLevel=$itemData['reOrder'];
        $item->status = $status;

        $res = $item->update();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    public function exists() {
        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $rId = $_POST["itemid"];
        $item = new Item();
        $item->checkId($rId);
    }

}
