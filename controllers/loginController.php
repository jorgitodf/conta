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
        if (isset($_POST['email']) && isset($_POST['senha'])) {
            $status = true;
            $email = trim(addslashes(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_STRING)));
            $senha = trim(addslashes(filter_input(INPUT_POST, 'senha', FILTER_SANITIZE_STRING)));
            if (empty($email)) {
                $dados['erroEmail'] = "<span class='erro_email'>Campo E-mail Obrigatório</span>";
                $status = false;
            } else {
                $dados['email'] = $_POST['email'];
            } 
            if (empty($senha)) {
                $dados['erroSenha'] = "<span class='erro_senha'>Campo Senha Obrigatório</span>";
                $status = false;
            } else {
                $dados['senha'] = $_POST['senha'];
            }
            if ($status == true) {
                if ($this->usuarioModel->verificaLoginSenha($email, $senha) == TRUE) {
                    $dadosCliente = $this->usuarioModel->verificaLoginSenha($email, $senha);
                    $_SESSION['userLogin'] = array('idUser'=>'', 'nome'=>'', 'email'=>'');
                    foreach ($dadosCliente as $dados)
                        $_SESSION['userLogin']['idUser'] = $dados['id_usuario'];{
                        $_SESSION['userLogin']['nome'] = $dados['nome'];
                        $_SESSION['userLogin']['email'] = $dados['email'];
                    }
                    header("Location: /home");
                } else {
                    $dados['erro_login'] = "<div class='alert alert-danger msgError' id='msg_ret_login' role='alert'>Usuário/E-mail não cadastrados!</div>";
                }
            }
        }
        $this->loadTemplate("loginView", $dados);
    }

    public function logout() {
        unset($_SESSION['userLogin']);
        header("Location: /home");
    }

}
