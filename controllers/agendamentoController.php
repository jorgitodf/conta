<?php

class agendamentoController extends Controller {

    protected $contaModel;
    protected $categoriaModel;
    protected $agendamentoModel;

    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        LoginHelper::isLoogedUser();
        $this->contaModel = new ContaModel();
        $this->categoriaModel = new CategoriaModel();
        $this->agendamentoModel = new AgendamentoModel();
    }

    public function index() {
        $dados = array();
        $dados['pgto_agendados'] = $this->agendamentoModel->getAllPgamentosAgendados();
        $this->loadTemplate('agendaPgtoIndexView', $dados);
    }
    
    public function alterar($id) {
        if (is_numeric($id) && isset($id) && !empty($id)) {
            
        } else {
            $this->loadTemplate('naoexisteView');
        }
    }

    public function apagar($id) {
        if (is_numeric($id) && isset($id) && !empty($id)) {
            
        } else {
            $this->loadTemplate('naoexisteView');
        }
    }
    
    public function agendar($id = null) {
        $dados = array();
        if (is_numeric($id) && isset($id) && !empty($id)) {
            $dados['idConta'] = (int) $_SESSION['conta']['idConta'];
            $dados['idUser'] = (int) $_SESSION['conta']['idUser'];
            $dados['categorias'] = $this->categoriaModel->getCategorias();
            $this->loadTemplate('agendaPgtoView_1', $dados);    
        } elseif (isset($_POST)) {
            $status = TRUE;
            $idUser = addslashes($_POST['idUser']);
            $idConta = addslashes($_POST['idConta']);
            $dtPgto = addslashes($_POST['data_pgto']);
            $movPgto = addslashes($_POST['mov_pgto']);
            $categoriaPgto = addslashes($_POST['categoria_pgto']);
            $valorPgto = addslashes($_POST['valor_pgto']);
            
            ValidacoesHelper::validarData($dtPgto);
            if (ValidacoesHelper::validarData($dtPgto) == TRUE) {
                $status = FALSE;
                echo ValidacoesHelper::validarData($dtPgto);
            }
            ValidacoesHelper::validarMovimentacao($movPgto);
            if (ValidacoesHelper::validarMovimentacao($movPgto) == TRUE) {
                $status = FALSE;
                echo ValidacoesHelper::validarMovimentacao($movPgto);
            }
            ValidacoesHelper::validarCategoria($categoriaPgto);
            if (ValidacoesHelper::validarCategoria($categoriaPgto) == TRUE) {
                $status = FALSE;
                echo ValidacoesHelper::validarCategoria($categoriaPgto);
            }
            ValidacoesHelper::validarValor($valorPgto);
            if (ValidacoesHelper::validarValor($valorPgto) == TRUE) {
                $status = FALSE;
                echo ValidacoesHelper::validarValor($valorPgto);
            }
            if ($status == TRUE) {
                
            }
            
        } else {
            $this->loadTemplate('naoexisteView');
        }
    }

}
