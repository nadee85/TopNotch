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
class RawMaterialController extends BaseController{
    //put your code here
    public function newRawMaterial() {
        $this->loadView();
    }
    
    public function rawMaterialList(){
        $this->loadView();
    }
}
