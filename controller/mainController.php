<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of mainController
 *
 * @author Nadeeshani
 */
class mainController extends BaseController {
    //put your code here
    public function index(){
        $this->loadView(null,true,true);
    }
    
    public function details(){
        $this->loadView(NULL,true,true);
    }
    
    public function login(){
        $this->loadView(null,TRUE,TRUE);
    }
    
    public function ConfirmEmail(){
        $this->loadView(null,TRUE,TRUE);
    }
}
