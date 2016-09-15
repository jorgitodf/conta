<?php

class loginController extends Controller {
    
    protected $usuarioModel;
    
    function __construct() {
        parent::__construct();
        $this->usuarioModel = new UsuarioModel();
    }
    
    public function index() {
        $this->loadTemplate('loginView');            
    }
    
    public function logar() {
    	
        $dados = array();
        $status = true;
        
        if (isset($_POST['email']) && empty($_POST['email'])) {
            $dados['erroEmail'] = "<span class='erro_email'>Campo E-mail Obrigatório</span>";
            $status = false;
        } else
            $dados['email'] = $_POST['email'];
            
        if (isset($_POST['senha']) && empty($_POST['senha'])) {
            $dados['erroSenha'] = "<span class='erro_senha'>Campo Senha Obrigatório</span>";
            $status = false;
        } else
            $dados['senha'] = $_POST['senha'];

	        if ($status == true) {
	            $email = trim(addslashes($_POST['email']));
	            $senha = trim(addslashes($_POST['senha']));
	            
	            if ($this->usuarioModel->verificaLoginSenha($email, $senha) == true) {
	            	
	                $dadosCliente = $this->usuarioModel->verificaLoginSenha($email, $senha);
	                
	                $_SESSION['userLogin'] = array('idUser'=>'', 'nome'=>'', 'email'=>'');
	                
	                foreach ($dadosCliente as $dados)
	                    $_SESSION['userLogin']['idUser'] = $dados['id_usuario'];{
	                    $_SESSION['userLogin']['nome'] = $dados['nome'];
	                    $_SESSION['userLogin']['email'] = $dados['email'];
	                }
	                
	                header("Location: /home");
	                
	            } else {
	                $dados['erro_login'] = "<span class='alert alert-danger' role='alert' id='erro_login'>Usuário/E-mail não cadastrados!</span>";
	            }

	        }
        		
        $this->loadTemplate("loginView", $dados);
		
	}
    
    public function logout() {
        
        unset($_SESSION['cliente']);
        header("Location: /login");
  
    }    
}