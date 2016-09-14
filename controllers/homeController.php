<?php

class homeController extends Controller {
    
    protected $loginModel;
    
    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        LoginHelper::isLoogedUser();
    }


    public function index() {
        $this->loadTemplate('homeView');
    }
    
}