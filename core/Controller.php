<?php

class Controller {

    protected $db;
    protected $contaModel;

    public function __construct() {
        global $config;
        try {
            $this->db = new PDO("mysql:dbname=" . $config['dbname'] . ";host=" . $config['host'], $config['dbuser'], $config['dbpass']);
            $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $ex) {
            if ($ex->getCode() == 1049) {
                echo "O Banco de Dados <b>" . $config['dbname'] . "</b> não Existe...";
                exit;
            }
        }
        $this->contaModel = new ContaModel();
    }

    public function loadTemplate($viewName, $viewData = array()) {
        $dados = array();
        $erro = "";
        if (isset($_SESSION['conta'])) {
            $dados = $this->contaModel->verSaldoAtual($_SESSION['conta']['idConta']);
        } else {
            $erro = "Não há um Login ativo";
        }
        include 'views/template.php';
    }

    public function loadView($viewName, $viewData = array()) {
        extract($viewData); // transforma o array em variáveis
        include 'views/' . $viewName . '.php';
    }

    public function loadViewInTemplate($viewName, $viewData) {
        extract($viewData); // transforma o array em variáveis
        include 'views/' . $viewName . '.php';
    }

}
