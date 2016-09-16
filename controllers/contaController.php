<?php

class contaController extends Controller {
    
    protected $contaModel;
   
    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        LoginHelper::isLoogedUser();
        $this->contaModel = new ContaModel();
    }


    public function index() {
    	$dados = array();
    	$dados['bancos'] = $this->contaModel->getBancos();
		$this->loadTemplate('cadastroContaView', $dados);            
    }
    
}