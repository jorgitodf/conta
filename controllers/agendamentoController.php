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
    
    public function agendar($id) {
        if (is_numeric($id) && isset($id) && !empty($id)) {
            
        } else {
            $this->loadTemplate('naoexisteView');
        }
    }

}
