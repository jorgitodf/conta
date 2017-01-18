<?php

class cadastroController extends Controller {
     
    protected $usuarioModel;
     
    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        $this->usuarioModel = new UsuarioModel();
    }

    public function index() {
        if ($_POST) {
            $nomeCompleto = trim(addslashes(filter_input(INPUT_POST, 'nomeCompleto', FILTER_SANITIZE_STRING)));
            $email = trim(addslashes(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));
            $senha = trim(addslashes(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING)));
            if (ValidacoesHelper::validarCampoVazio($nomeCompleto) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o campo Nome Completo!');
            } else if (ValidacoesHelper::validarCampoVazio($email) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o campo E-mail!');
            } else if (ValidacoesHelper::validarEmail($email) == TRUE) {
                $erro = ValidacoesHelper::validarEmail($email);
                $json = array('status'=>'error', 'message'=>$erro);
            } else if (!empty($this->usuarioModel->getEmail($email))) {
                    $json = array('status'=>'error', 'message'=>'O E-mail informado já está cadastrado!');
            } else if (ValidacoesHelper::validarCampoVazio($senha) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o campo Senha!');
            } else {
                try {
                    if ($this->usuarioModel->salvarCadastroUsuario($nomeCompleto, $email, $senha)) {
                        $json = array('status'=>'success', 'message'=>'Usuário Cadastrado com Sucesso!');
                    } else {
                        $json = array('status'=>'error', 'message'=>'Falha ao cadastrar o Usuário.', 'error'=>'erroCadModel');
                    }
                } catch (Exception $e) {
                    $json = array('status'=>'error', 'message' => $e->getMessage(), 'error'=>'erroException');
                }
            }
            echo json_encode($json);
        } else {
            $this->loadTemplate('cadastroView');
        }
            
        
    }
    
    
    
}