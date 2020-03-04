<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ManItemHeader
 *
 * @author Nadeeshani
 */
class ManItemHeader extends IdentifiedBaseModel {
    //put your code here
    public $Id;
    public $ItemId;
    
    public function checkItemId($idField){
        $tableName=  get_class($this);
        $result=  mysqli_query($this->con, "SELECT id FROM manitemheader WHERE itemid='" . $idField."'");
        if (mysqli_num_rows($result)==0) {
            echo 'true';
        }else{
            echo 'false';
        }
    }
    
    public function manItemDetails() {
        $result = mysqli_query($this->con, "SELECT item.description as ides, rawmaterials.description as rdes, manitemdetails.qty"
                . " FROM manitemheader INNER JOIN manitemdetails ON manitemheader.id=manitemdetails.manid INNER JOIN item "
                . " ON manitemheader.itemid=item.id INNER JOIN rawmaterials ON manitemdetails.rawmatid=rawmaterials.id "
                . " ORDER BY manitemheader.itemid");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
