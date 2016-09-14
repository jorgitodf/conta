<?php

class cadastroController extends Controller {
     
    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
    }

    public function index() {

        $this->loadTemplate('cadastroView');
    }
    
    public function salvar() {
    	
    	$dados = array();
    	
    	if (isset($_POST['nomeCompleto']) && empty($_POST['nomeCompleto'])) {
            $dados['erroNomeCompleto'] = "<span class='erro_nome_completo'>Campo Nome Completo Obrigatório</span>";
            $status = false;
        } else
            $dados['nomeCompleto'] = $_POST['nomeCompleto'];
            
        if (isset($_POST['email']) && empty($_POST['email'])) {
            $dados['erroEmail'] = "<span class=''>Campo E-mail Obrigatório</span>";
            $status = false;
        } else
            $dados['email'] = $_POST['email'];
            
        if (isset($_POST['senha']) && empty($_POST['senha'])) {
            $dados['erroSenha'] = "<span class=''>Campo Senha Obrigatório</span>";
            $status = false;
        } else
            $dados['senha'] = $_POST['senha'];  
            
        $this->loadTemplate('cadastroView', $dados);    
		
	}
    
}