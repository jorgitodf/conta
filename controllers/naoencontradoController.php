<?php

class naoencontradoController extends Controller {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function index() {
        
        $this->loadTemplate("naoencontrado", array());
        
    }
    
}