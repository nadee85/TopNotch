<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ReturnBottleHeader
 *
 * @author Nadeeshani
 */
class ReturnBottleHeader extends IdentifiedBaseModel {

    //put your code here
    public $id;
    public $cusId;
    public $dateAdded;

    public function getEmpty() {
        $result = mysqli_query($this->con, "SELECT SUM(returnbottledetails.Qty) as Qty FROM `returnbottledetails` "
                . " INNER JOIN returnbottleheader ON returnbottleheader.id=returnbottledetails.RetNo "
                . " INNER JOIN manitemdetails ON manitemdetails.rawMatID=returnbottledetails.RawMatId "
                . " INNER JOIN manitemheader ON manitemheader.Id=manitemdetails.manId "
                . " WHERE returnbottleheader.cusId='" . $_POST['customer'] . "' AND manitemheader.ItemId='" . $_POST['item'] . "'");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }

    public function updateRowMat($id, $stock,$cusId) {
        $res=FALSE;
        $result1 = mysqli_query($this->con, "SELECT manitemdetails.rawmatid,manitemdetails.qty,manitemheader.itemid FROM manitemDetails "
                . " INNER JOIN manitemheader ON "
                . " manitemdetails.manid=manitemheader.id WHERE manitemheader.itemid='$id'");
        while ($row1 = mysqli_fetch_array($result1)) {
            $rQty = $row1['qty'] * $stock;
            $result = mysqli_query($this->con, "SELECT Qty, returnbottleheader.id FROM `returnbottledetails` "
                    . " INNER JOIN returnbottleheader ON returnbottleheader.id=returnbottledetails.RetNo"
                    . " WHERE returnbottleheader.cusId='$cusId' AND returnbottledetails.rawmatid='" . $row1['rawmatid'] . "' "
                    . " AND returnbottledetails.qty<>0 ORDER BY returnbottledetails.qty");
            if (mysqli_num_rows($result) != 0) {
                while ($row = mysqli_fetch_array($result)) {
                    //update return bottle
                    //request qty is less than stored empty bottles
                    if ($row['Qty'] > $rQty) {
                        $query = "UPDATE returnbottledetails SET qty=qty-$rQty WHERE rawmatid='" . $row1['rawmatid'] . "' AND retNo='" . $row['id'] . "'";
                        $rQty = 0;
                        $res = $this->con->query($query);
                    } elseif ($row['Qty'] == $rQty) {
                        $rQty = 0;
                        $query = "UPDATE returnbottledetails SET qty=0 WHERE rawmatid='" . $row1['rawmatid'] . "' AND retNo='" . $row['id'] . "'";
                        $res = $this->con->query($query);
                    } elseif ($row['Qty'] < $rQty) {
                        $rQty = $rQty - $row['Qty'];
                        $query = "UPDATE returnbottledetails SET qty=0 WHERE rawmatid='" . $row1['rawmatid'] . "' AND retNo='" . $row['id'] . "'";
                        $res = $this->con->query($query);
                        $query2 = "UPDATE rawmaterials SET curstock=curstock-$rQty WHERE id='" . $row1['rawmatid'] . "'";
                        $res2 = $this->con->query($query2);
                    }
                }
            } else {
                $query = "UPDATE rawmaterials SET curstock=curstock-$rQty WHERE id='" . $row1['rawmatid'] . "'";
                $res = $this->con->query($query);
            }
        }
        return $res;
        
    }
    
    public function returnEmptyBot() {
        $result = mysqli_query($this->con, "SELECT customer.fname,customer.lname,rawmaterials.description,"
                . " SUM(returnbottledetails.Qty) as Qty FROM `returnbottledetails` "
                . " INNER JOIN returnbottleheader ON returnbottleheader.id=returnbottledetails.RetNo "
                . " INNER JOIN rawmaterials ON rawmaterials.id=returnbottledetails.RawMatId "
                . " INNER JOIN customer ON customer.Id=returnbottleheader.cusid");
        $data = array();
        while ($row = mysqli_fetch_object($result)) {
            array_push($data, $row);
        }
        echo json_encode($data);
    }

}
