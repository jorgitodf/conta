<?php

class cadastroController extends Controller {
     
    protected $usuarioModel;
     
    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        $this->usuarioModel = new UsuarioModel();
    }

    public function index() {

        $this->loadTemplate('cadastroView');
    }
    
    public function salvar() {
    	
    	$dados = array();
    	$status = true;
    	
    	if (isset($_POST['nomeCompleto']) && empty($_POST['nomeCompleto'])) {
            $dados['erroNomeCompleto'] = "<span class='erro_nome_completo'>Campo Nome Completo Obrigatório</span>";
            $status = false;
        } else
            $dados['nomeCompleto'] = $_POST['nomeCompleto'];
            
        if (isset($_POST['email']) && empty($_POST['email'])) {
            $dados['erroEmail'] = "<span class='erro_email_cadastro'>Campo E-mail Obrigatório</span>";
            $status = false;
        } else
            $dados['email'] = $_POST['email'];
            
        if (isset($_POST['senha']) && empty($_POST['senha'])) {
            $dados['erroSenha'] = "<span class='erro_senha_cadastro'>Campo Senha Obrigatório</span>";
            $status = false;
        } else
            $dados['senha'] = $_POST['senha'];  
            
        if ($status == true) {
        	
            $nomeCompleto = trim(addslashes($_POST['nomeCompleto']));
            $email = trim(addslashes($_POST['email']));
            $senha = trim(addslashes($_POST['senha']));
            
            if ($this->usuarioModel->salvarCadastroUsuario($nomeCompleto, $email, $senha) == true) {
            	$dadosSucesso = array('nome' => $nomeCompleto, 'email' => $email, 'senha' => $senha, 'msg_sucesso' => "<span class='alert alert-success' role='alert' id='msg_sucesso'>Dados Cadastrados com Sucesso!</span>");
                $this->loadTemplate('cadastroSucessoView', $dadosSucesso);
                die();
            } else {
                $dados['msg_erro'] = "<span class='alert alert-danger' role='alert' id='msg_erro'>Dados não cadastrados!</span>";
            }

        }            
        $this->loadTemplate('cadastroView', $dados);    
	}
    
}