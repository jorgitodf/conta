<?php

class homeController extends Controller {
    
    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida
    }


    public function index() {

        $this->loadTemplate('homeView');
        
    }
}