<?php

class naoexisteController extends Controller {

    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida
    }

    public function index() {
        $this->loadTemplate('naoexisteView');
    }

}