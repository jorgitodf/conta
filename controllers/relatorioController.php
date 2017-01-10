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
        $dados = array();
        if (isset($_SESSION['conta']) && $_SESSION['userLogin'] && !$_POST) {
            $dados['idConta'] = $_SESSION['conta']['idConta'];
            $dados['idUser'] = $_SESSION['userLogin']['idUser'];
            $this->loadTemplate('relatorioMovimentacaoView', $dados);
        }
        if ($_POST) {
            $status = true;
            if (isset($_POST['data_inicial']) && empty($_POST['data_inicial'])) {
                $dados['erroDataInicial'] = "<span class='alert alert-danger' role='alert' id='msg_data_inicial_relatorio_erro'>Data Inicial Obrigatória!</span>";
                $status = false;
            } else {
                $dados['data_inicial'] = $_POST['data_inicial'];
            }
            if (isset($_POST['data_final']) && empty($_POST['data_final'])) {
                $dados['erroDataFinal'] = "<span class='alert alert-danger' role='alert' id='msg_data_final_relatorio_erro'>Data Final Obrigatória!</span>";
                $status = false;
            } else {
                $dados['data_final'] = $_POST['data_final'];
            }
            if (isset($_POST['movimentacao_relatorio']) && empty($_POST['movimentacao_relatorio'])) {
                $dados['erroMovimentacao'] = "<span class='alert alert-danger' role='alert' id='msg_movimentacao_relatorio_erro'>Movimentação Obrigatória!</span>";
                $status = false;
            } else {
                $dados['movimentacao_relatorio'] = $_POST['movimentacao_relatorio'];
            }

            if ($status == true) {
                $data = array('idConta' => (int) $_POST['idConta'], 'dataInicial' => trim(addslashes($_POST['data_inicial'])),
                    'dataFinal' => trim(addslashes($_POST['data_final'])), 'movimentacao' => trim(addslashes($_POST['movimentacao_relatorio'])));
                if ($this->extratoModel->listarMovimentacaoPeriodo($data) == true) {
                    $dados['extrato_relatorio'] = $this->extratoModel->listarMovimentacaoPeriodo($data);
                    $this->loadTemplate('relatorioMovimentacaoListagemView', $dados);
                    die();
                }
            }

            $dados['idConta'] = $_SESSION['conta']['idConta'];
            $this->loadTemplate('relatorioMovimentacaoView', $dados);
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
