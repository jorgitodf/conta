<?php

class extratoController extends Controller {

    protected $extratoModel;

    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        LoginHelper::isLoogedUser();
        $this->extratoModel = new ExtratoModel();
    }

    public function index() {
        $dados = array();

        if ($_POST) {
            $status = true;
            if (empty($_POST['data_inicio'])) {
                $dados['erroDataInicial'] = "<span class='erro_data_inicial'>Data Inicial Obrigatória!!</span><br/>";
                $status = false;
            } else {
                $dados['data_inicio'] = $_POST['data_inicio'];
            }
            if (empty($_POST['data_final'])) {
                $dados['erroDataFinal'] = "<span class='erro_data_final'>Data Final Obrigatória!!</span>";
                $status = false;
            } else {
                $dados['data_final'] = $_POST['data_final'];
            }
            if ((!empty($_POST['data_inicio']) && !empty($_POST['data_final'])) && ($_POST['data_inicio'] > $_POST['data_final'])) {
                $dados['erroDataFinal'] = "<span class='erro_data_final'>Data Inicial maioir que Data Final!!</span>";
                $status = false;
            }

            if ($status == true) {
                $id_conta = (int) $_SESSION['conta']['idConta'];
                $data_inicial = trim(addslashes($_POST['data_inicio']));
                $data_final = trim(addslashes($_POST['data_final']));

                if ($this->extratoModel->verExtratoPeriodo($id_conta, $data_inicial, $data_final) == true) {
                    $dados['extrato'] = $this->extratoModel->verExtratoPeriodo($id_conta, $data_inicial, $data_final);
                    $dados['data_inicial'] = $data_inicial;
                    $dados['data_final'] = $data_final;
                    $this->loadTemplate('extratoView', $dados);
                    die();
                }
            }
        }

        $this->loadTemplate('extratoPeriodoView', $dados);
    }

}

?>