<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of POItem
 *
 * @author Nadeeshani
 */
class POItem extends IdentifiedBaseModel {
    //put your code here
    public $poNo;
    public $rItemId;
    public $qty;
    
    public function deletePOItem($id){
        $query=  "DELETE FROM poitem WHERE pono='$id'";
        $res=  $this->con->query($query);
//        echo json_encode($res);
        if (!$res) {
            $err=  $this->con->error_list;
        }
        return $res;
    }
}
