<?php

class cartaoController extends Controller {
     
    protected $usuarioModel;
    protected $cartaoModel;
     
    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        $this->usuarioModel = new UsuarioModel();
        $this->cartaoModel = new CartaoModel();
    }

    public function index() {
        $this->cartaoModel->data_validade;
        $this->loadTemplate('cadastroView');
    }
    
    
    
}