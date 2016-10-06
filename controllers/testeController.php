<?php

class testeController extends Controller {

    protected $contaModel;

    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        $this->contaModel = new ContaModel();
    }

    public function index() {
        $resultado = $this->contaModel->verificaPagamentoAgendado();
        if ($resultado == 0) {
            echo "Não há nenhuma pagamento agendado para pagamento hoje.";
        } else {
            echo "Pagamento(s) realizado(s) com Sucesso.";
        }
    }    

}
