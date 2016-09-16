<?php

class homeController extends Controller {
    
    protected $loginModel;
    protected $contaModel;
    
    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        LoginHelper::isLoogedUser();
        $this->contaModel = new ContaModel();
    }


    public function index() {
    	$dados = array();
    	
    	if (isset($_SESSION['userLogin'])) {
			$idUser = (int)$_SESSION['userLogin']['idUser'];
			if($this->contaModel->verificaConta($idUser) == false) {
				$dados['erroConta'] = "<span class='erro_conta'>Sr. {$_SESSION['userLogin']['nome']} você não possui nenhuma Conta Cadastrada no momento! <a href='../conta'>Clique aqui para cadastrar</a> </span>";

			}
		}
        $this->loadTemplate('homeView', $dados);
    }
    
}