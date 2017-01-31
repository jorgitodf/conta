<?php

class relatorioController extends Controller {

    protected $extratoModel;
    protected $categoriaModel;

    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        LoginHelper::isLoogedUser();
        $this->extratoModel = new ExtratoModel();
        $this->categoriaModel = new CategoriaModel();
    }

    public function index() {
        $this->loadTemplate('relatorioMovimentacaoView');
    }
    
    public function consultar() {
        if (isset($_POST['data_inicial']) && isset($_POST['data_final']) && isset($_SESSION['conta']) && isset($_SESSION['userLogin'])) {
            $idConta = $_SESSION['conta']['idConta'];
            $dataInicial = trim(addslashes(filter_input(INPUT_POST, 'data_inicial', FILTER_SANITIZE_STRING)));
            $dataFinal = trim(addslashes(filter_input(INPUT_POST, 'data_final', FILTER_SANITIZE_STRING)));
            if (ValidacoesHelper::validarCampoVazio($dataInicial) == true) {
                $json = array('status'=>'error', 'message'=>'Preencha a Data Inicial!');
            } else if (ValidacoesHelper::validarCampoVazio($dataFinal) == true) {
                $json = array('status'=>'error', 'message'=>'Preencha a Data Final!');
            } else if (ValidacoesHelper::validarIntervaloData($dataInicial, $dataFinal)) {
                $json = array('status'=>'error', 'message'=>'Data Inicial maior que Data Final!');
            } else {
                $table = $this->extratoModel->listarConsultaGastosPorPeriodo($dataInicial, $dataFinal, $idConta);
                $tabela = ConstructHelper::geraTabelaComTotal($table);
                $json = array('status'=>'success', 'message'=>'Consulta Realizada com Sucesso!', 'tabela'=>$tabela);
            }
            echo json_encode($json);
        }
    }
    
    public function geral() {
        $dados = array();
        if (isset($_SESSION['conta']) && $_SESSION['userLogin'] && !$_POST) {
            $dados['idConta'] = $_SESSION['conta']['idConta'];
            $dados['idUser'] = $_SESSION['userLogin']['idUser'];
            $dados['ano'] = $this->extratoModel->listarAnoExtrato();
            $dados['categoria'] = $this->categoriaModel->getCategoriasDespesas();
            $this->loadTemplate('relatorioFormGeralView', $dados);
        } elseif (isset($_POST['nome_categoria']) && empty($_POST['nome_categoria'])) {
            $dados['erroCat'] = "Selecione uma Categoria!";
            $dados['idConta'] = $_SESSION['conta']['idConta'];
            $dados['idUser'] = $_SESSION['userLogin']['idUser'];
            $dados['anoForm'] = $_POST['ano'];
            $dados['ano'] = $this->extratoModel->listarAnoExtrato();
            $dados['categoria'] = $this->categoriaModel->getCategoriasDespesas();
            $this->loadTemplate('relatorioFormGeralView', $dados);
        } elseif (isset($_POST['ano']) && empty($_POST['ano'])) {
            $dados['erroAno'] = "Selecione um Ano";
            $dados['idConta'] = $_SESSION['conta']['idConta'];
            $dados['idUser'] = $_SESSION['userLogin']['idUser'];
            $dados['nome_categoria'] = $_POST['nome_categoria'];
            $dados['ano'] = $this->extratoModel->listarAnoExtrato();
            $dados['categoria'] = $this->categoriaModel->getCategoriasDespesas();
            $this->loadTemplate('relatorioFormGeralView', $dados);
        } else {
            $categoria = intval($_POST['nome_categoria']);
            $idUser = intval($_POST['idUser']);
            $idConta = intval($_POST['idConta']);
            $ano = intval($_POST['ano']);
            $dados['categoria'] = $this->categoriaModel->getCategoriasNome($categoria);
            $dados['gasto_geral_categoria'] = $this->extratoModel->listarRelatorioGastoPorCategoria($categoria, $idUser, $idConta, $ano);
            $this->loadTemplate('relatorioGastoGeralCategoriaView', $dados);
        }
    }

}
