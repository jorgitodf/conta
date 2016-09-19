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
    	$dados['tipoConta'] = $this->contaModel->getTipoConta();
		$this->loadTemplate('cadastroContaView', $dados);            
    }
    
    public function salvar() {
    	$dados = array();
    	$dados['bancos'] = $this->contaModel->getBancos();
    	$dados['tipoConta'] = $this->contaModel->getTipoConta();
    	$status = true;
    	
        if (isset($_POST['nome_banco']) && empty($_POST['nome_banco'])) {
            $dados['erroNomeBanco'] = "<span class='erro_banco'>Campo Nome do Banco Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['nome_banco'] = $_POST['nome_banco'];

        if (isset($_POST['cod_agencia']) && empty($_POST['cod_agencia'])) {
            $dados['erroCodAgencia'] = "<span class='erro_cod_agencia'>Campo Código da Agência Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['codAgencia'] = $_POST['cod_agencia'];    
 
        if (isset($_POST['dig_agencia']) && !empty($_POST['dig_agencia'])) {
        	$dados['digAgencia'] = (int)$_POST['dig_agencia'];
            //$dados['erroDigVerificador'] = "<span class='erro_dig_verificador'>Campo Dígito Verificador Obrigatório <br/></span>";
            //$status = false;
        } //else
            //$dados['digAgencia'] = $_POST['dig_agencia'];           
            
            
        if (isset($_POST['tipo_conta']) && empty($_POST['tipo_conta'])) {
            $dados['erroTipoConta'] = "<span class='erro_tipo_conta'>Campo Tipo de Conta Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['tipo_conta'] = $_POST['tipo_conta'];

		$this->loadTemplate('cadastroContaView', $dados);            
    }
    
}