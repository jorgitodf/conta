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
        
        if (isset($_SESSION['userLogin']) && !isset($_SESSION['conta']) && !$_POST) {
            $idUser = $_SESSION['userLogin']['idUser'];
            if ($this->contaModel->verificaConta($idUser) == false) {
                $dados['erroConta'] = "<span class='erro_conta'>Sr. {$_SESSION['userLogin']['nome']} você não possui nenhuma Conta Cadastrada no momento! <a href='../conta'>Clique aqui para cadastrar</a> </span>";
            } else {
                $dados['contas'] = $this->contaModel->verificaConta($idUser);
            }
            $this->loadTemplate('homeView', $dados);
            exit;
        } elseif (isset($_SESSION['userLogin']) && !isset($_SESSION['conta']) && $_POST) {
            $idUser = (int) $_SESSION['userLogin']['idUser'];
            $idConta = (int) $_POST['radio_conta'];
            $dados = $this->contaModel->getConta($idUser, $idConta);
            $_SESSION['conta'] = array('idConta' => '', 'codConta' => '', 'nomeBanco' => '', 'DigVerAgencia' => '', 'TipoConta' => '', 'numConta' => '', 'DigVerConta' => '', 'idUser' => '');
            foreach ($dados as $linha) {
                $_SESSION['conta']['idConta'] = $linha['IdConta'];
                $_SESSION['conta']['codConta'] = $linha['CodAgencia'];
                $_SESSION['conta']['nomeBanco'] = $linha['NomeBanco'];
                $_SESSION['conta']['DigVerAgencia'] = $linha['DigVerAgencia'];
                $_SESSION['conta']['TipoConta'] = $linha['TipoConta'];
                $_SESSION['conta']['numConta'] = $linha['NumeroConta'];
                $_SESSION['conta']['DigVerConta'] = $linha['DigVerConta'];
                $_SESSION['conta']['idUser'] = $linha['IdUser'];
            }
        }
        date_default_timezone_set('America/Sao_Paulo');
        $data['ano'] = date("Y"); 
        $data['mes'] = $this->contaModel->verificaMes();
        $data['contas_agendadas'] = $this->contaModel->getContasAgendadas($_SESSION['conta']['idConta']);
        $this->loadTemplate('homePrincipalContaView', $data);  
    }

}
