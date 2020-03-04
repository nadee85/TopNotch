<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManHeader
 *
 * @author Nadeeshani
 */
class ManHeader extends IdentifiedBaseModel{
    //put your code here
    public $id;
    public $manDate;
    public $cusId;
    public $retBot;
    
    public function getCurStock() {
        $result = mysqli_query($this->con, "SELECT rawmaterials.curStock FROM manitemdetails INNER JOIN "
                . " rawmaterials ON manitemdetails.rawMatID=rawmaterials.id INNER JOIN manitemheader ON "
                . " manitemheader.Id=manitemdetails.manId"
                . " WHERE manitemheader.ItemId='" . $_POST['item'] . "'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function updateItems($id, $stock) {
        $query = "UPDATE item SET curStock=curstock + $stock WHERE id='$id'";
        $res = $this->con->query($query);
        if (!$res) {
            $err = $this->con->error_list;
        }
        return $res;
    }
    
    public function totalManufacture(){
        $result = mysqli_query($this->con, "SELECT  sum(qty) as qty " 
                . " FROM `manheader`  INNER JOIN mandetails on manheader.id=mandetails.manid "
                . " WHERE month(mandate)='".date('m')."' AND year(mandate)='".  date("Y")."'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
    
    public function manufactureDate(){
        $manData=$_POST['sData'];
        $fromDate=$manData['fromDate'];
        $toDate=$manData['toDate'];
        $result = mysqli_query($this->con, "SELECT manheader.id, item.description,manheader.mandate,"
                . " mandetails.qty " 
                . " FROM `manheader` INNER JOIN mandetails ON manheader.id=mandetails.manid INNER JOIN item ON mandetails.itemid=item.id "
                . " WHERE manheader.mandate BETWEEN '" .$fromDate. "' AND '" .$toDate. "' ORDER BY manheader.id");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
