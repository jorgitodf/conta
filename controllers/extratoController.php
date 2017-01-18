<?php

class extratoController extends Controller {

    protected $extratoModel;

    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        LoginHelper::isLoogedUser();
        $this->extratoModel = new ExtratoModel();
    }

    public function index() {
        if ($_POST) {
            $id_conta = (int) $_SESSION['conta']['idConta'];
            $data_inicial = trim(addslashes(filter_input(INPUT_POST, 'data_inicio', FILTER_SANITIZE_STRING)));
            $data_final = trim(addslashes(filter_input(INPUT_POST, 'data_final', FILTER_SANITIZE_STRING)));
            if (ValidacoesHelper::validarData($data_inicial) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o campo Data Inicial!');
            } else if (ValidacoesHelper::validarData($data_final) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o campo Data Final!');
            } else if ($data_final < $data_inicial) {
                $json = array('status'=>'error', 'message'=>'Data Final menor que a Data Inicial!');
            } else {
                if ($this->extratoModel->verExtratoPeriodo($id_conta, $data_inicial, $data_final)) {
                    $extrato = $this->extratoModel->verExtratoPeriodo($id_conta, $data_inicial, $data_final);
                    $divTabela = ConstructHelper::monta_panel_tabela_extrato_periodo($data_inicial, $data_final, $extrato);
                    $json = array('status'=>'success', 'message'=>'Sucesso', 'divtabela'=>$divTabela);
                }
            }
            echo json_encode($json);
        } else {
            $this->loadTemplate('extratoPeriodoView');
        }

        
    }

}
