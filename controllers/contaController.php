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
 
        //if (isset($_POST['dig_agencia']) && !empty($_POST['dig_agencia'])) {
        	//$dados['digAgencia'] = $_POST['dig_agencia'];
            //$dados['erroDigVerificador'] = "<span class='erro_dig_verificador'>Campo Dígito Verificador Obrigatório <br/></span>";
            //$status = false;
        //} //else
            //$dados['digAgencia'] = $_POST['dig_agencia'];      
            
        if (isset($_POST['tipo_conta']) && empty($_POST['tipo_conta'])) {
            $dados['erroTipoConta'] = "<span class='erro_tipo_conta'>Campo Tipo de Conta Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['tipo_conta'] = $_POST['tipo_conta'];     

        if (isset($_POST['num_conta']) && empty($_POST['num_conta'])) {
            $dados['erroNumConta'] = "<span class='erro_num_conta'>Campo Número da Conta Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['numConta'] = $_POST['num_conta'];      
            
        if (isset($_POST['dig_conta']) && empty($_POST['dig_conta'])) {
            $dados['erroDigConta'] = "<span class='erro_num_conta'>Campo Dígito Verificador da Conta Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['digConta'] = $_POST['dig_conta'];   
            
        if (isset($_POST['cod_operacao']) && !empty($_POST['cod_operacao'])) {
        	$codOperacao = trim(addslashes($_POST['cod_operacao']));
            //$dados['erroCodOperacao'] = "<span class='erro_cod_operacao'>Campo Código de Operação <br/></span>";
            //$status = false;
        }// else
           // $dados['codOperacao'] = $_POST['cod_operacao'];  
                      
        if ($status == true) {
        	
			$nomeBanco = trim(addslashes($_POST['nome_banco']));
			$codAgencia = trim(addslashes($_POST['cod_agencia']));
			$digAgencia = trim(addslashes($_POST['dig_agencia']));
			$tipoConta = trim(addslashes($_POST['tipo_conta']));
			$numConta = trim(addslashes($_POST['num_conta']));
			$digConta = trim(addslashes($_POST['dig_conta']));
			$idUser = $_SESSION['userLogin']['idUser'];
			
			if ($this->contaModel->verificaContaCadastrada($idUser, $numConta, $codAgencia) > 0) {
				$dados['msg_conta_cadastrada'] = "<span class='alert alert-danger' role='alert' id='msg_conta_cadastrada'>Conta {$numConta} pertecente a Agência {$codAgencia} já cadastrada no Sistema!</span>";
			} elseif ($this->contaModel->cadastrarConta($nomeBanco, $codAgencia, $digAgencia, $tipoConta, $numConta, $digConta, $codOperacao, $idUser) == true) {
				$retorno = $this->contaModel->getContaUsuario($idUser);
	            $dadosSucesso = array(
	            	'retorno' => $retorno, 
	            	'msg_sucesso' => "<span class='alert alert-success' role='alert' id='msg_sucesso_conta'>Conta Cadastrada com Sucesso!</span>");
	            $this->loadTemplate('cadastroContaSucessoView', $dadosSucesso);
	            die();					
			} else {
	            $dados['msg_erro'] = "<span class='alert alert-danger' role='alert' id='msg_erro'>Não foi possível cadastrar essa Conta!</span>";
	        } 
    
    	}
    	
    $this->loadTemplate('cadastroContaView', $dados);      
    }	

	public function ver() {
		
        if (isset($_POST['radio_conta']) && !empty($_POST['radio_conta'])) {
        	$dados = array();
            $dados['idConta'] = $radio_conta = $_POST['radio_conta'];

            $this->loadTemplate('homePrincipalContaView', $dados);       
        }
		
	}

	public function extrato($idConta) {
		
        if (is_numeric($idConta)) {
  			echo $idConta; 
        }
		
	}
    
}