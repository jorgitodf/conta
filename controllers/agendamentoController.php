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
            if ($this->agendamentoModel->deletarPgtoAgendado($id) == TRUE) {
                $this->index();
            }
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
            $idConta = addslashes($_POST['idConta']);
            $dtPgto = addslashes($_POST['data_pgto']);
            $movPgto = addslashes($_POST['mov_pgto']);
            $categoriaPgto = addslashes($_POST['categoria_pgto']);
            $valorPgto = addslashes($_POST['valor_pgto']);
            $valorPgto = str_replace('R$ ', '', str_replace(',', '.', str_replace('.', '', $valorPgto)));
            if (ValidacoesHelper::validarData($dtPgto) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o campo Data!', 'error'=>'erroData');
            } else if (ValidacoesHelper::validarMovimentacao($movPgto) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha a Movimentação', 'error'=>'erroMov');
            } elseif (ValidacoesHelper::validarCategoria($categoriaPgto) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha a Categoria', 'error'=>'erroCat');
            } elseif (ValidacoesHelper::validarValor($valorPgto) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o Valor', 'error'=>'erroVal');
            } else {
                try {
                    if ($this->agendamentoModel->cadastrarPgtoAgendado($idConta, $dtPgto, $movPgto, $categoriaPgto, $valorPgto)) {
                        $json = array('status'=>'success', 'message'=>'Pagamento Agendado com Sucesso!');
                    } else {
                        $json = array('status'=>'error', 'message'=>'Falha ao cadastrar o Pagamento.', 'error'=>'erroCadModel');
                    }
                } catch (Exception $e) {
                    $json = array('status'=>'error', 'message' => $e->getMessage(), 'error'=>'erroException');
                }
            }
            echo json_encode($json);
        } else {
            $this->loadTemplate('naoexisteView');
        }
    }

}
