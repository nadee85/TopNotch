<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of RawMaterialController
 *
 * @author Nadeeshani
 */
class RawMaterialController extends BaseController {

    //put your code here
    public function newRawMaterial() {
        $this->loadView();
    }

    public function rawMaterialList() {
        $this->loadView();
    }

    public function loadRawMaterials() {
        $rawMaterial = new RawMaterials();
        $rawMaterial->findList();
    }
    
    public function loadDescription(){
        $rawMaterial=new RawMaterials();
        $rawMaterial->loadDescription();
    }

    public function addRawMaterial() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $rawData = $_POST['rawData'];

        if ($rawData['mandatory'] === "true") {
            $mandatory = 1;
        } else {
            $mandatory = 0;
        }

        $rawMaterial = new RawMaterials();

        $rawMaterial->id = $rawData['id'];
        $rawMaterial->description = $rawData['description'];
        $rawMaterial->curStock = $rawData['stock'];
        $rawMaterial->mandatory = $mandatory;

        $res = $rawMaterial->save();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }
    
    public function updateRawMaterial(){
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header("HTTP/1.1 405 NOT ALLOWED");
        }

        $rawData = $_POST['rawData'];
        
        if ($rawData['mandatory'] === "true") {
            $mandatory = 1;
        } else {
            $mandatory = 0;
        }

        $rawMaterial = new RawMaterials();

        $rawMaterial->id = $rawData['id'];
        $rawMaterial->description = $rawData['description'];
        $rawMaterial->curStock = $rawData['stock'];
        $rawMaterial->mandatory = $mandatory;

        $res = $rawMaterial->update();
        echo json_encode($res);
        if (!$res) {
            header("HTTP/1.1 500 Internal Server Error");
        }
    }

}
