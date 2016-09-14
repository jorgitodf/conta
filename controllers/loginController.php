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
    
    public function logout() {
        
        unset($_SESSION['cliente']);
        header("Location: /login");
  
    }    
}