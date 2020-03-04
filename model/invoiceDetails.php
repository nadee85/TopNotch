<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of invoiceDetails
 *
 * @author Nadeeshani
 */
class invoiceDetails extends IdentifiedBaseModel{
    //put your code here
    public $invNo;
    public $itemId;
    public $qty;
    public $sellPrice;
    public $amount;
    
    public function deleteInvDetails($id){
        $query=  "DELETE FROM invoicedetails WHERE invno='$id'";
        $res=  $this->con->query($query);
//        echo json_encode($res);
        if (!$res) {
            $err=  $this->con->error_list;
        }
        return $res;
    }
    
    public function itemWiseInvoice(){
        $invData=$_POST['sData'];
        $fromDate=$invData['fromDate'];
        $toDate=$invData['toDate'];
        $result = mysqli_query($this->con, "SELECT item.description, invoicedetails.sellprice,sum(invoicedetails.qty) as qty,"
                . " sum(invoicedetails.amount) as amount FROM `invoiceheader` INNER JOIN invoicedetails ON "
                . " invoiceheader.id=invoicedetails.invno INNER JOIN item ON invoicedetails.itemid=item.id "
                . " WHERE invoiceheader.delstatus=0 AND invoiceheader.invdate BETWEEN '" .$fromDate. "' AND '" .$toDate. "' "
                . " GROUP BY invoicedetails.itemid");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }
}
