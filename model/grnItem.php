<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of grnItem
 *
 * @author Nadeeshani
 */
class grnItem extends IdentifiedBaseModel{
    //put your code here
    public $grnNo;
    public $rItemId;
    public $purPrice;
    public $qty;
    public $amount;
    
    public function deleteGRNItem($id){
        $query=  "DELETE FROM grnitem WHERE grnno='$id'";
        $res=  $this->con->query($query);
//        echo json_encode($res);
        if (!$res) {
            $err=  $this->con->error_list;
        }
        return $res;
    }
    
    public function getCount($id){
        $this->loadId("SELECT COUNT(grnno) as id FROM grnitem WHERE grnno='$id'");
    }
}
