<?php

class cartaoController extends Controller {
     
    protected $usuarioModel;
    protected $cartaoModel;
     
    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        $this->usuarioModel = new UsuarioModel();
        $this->cartaoModel = new CartaoModel();
    }

    public function index() {
        $dados = array();
        if (isset($_SESSION['userLogin']) && !$_POST) {
            $dados['idUser'] = $_SESSION['userLogin']['idUser'];
            $dados['bandeiras'] = $this->cartaoModel->getBandeiras();
            $this->loadTemplate('cartaoCadastroView', $dados);
        } else if ($_POST) {
            $idUser = (int) filter_input(INPUT_POST, 'idUser', FILTER_SANITIZE_NUMBER_INT);
            $numCartao = trim(addslashes(filter_input(INPUT_POST, 'num_cartao', FILTER_SANITIZE_NUMBER_INT)));
            $dtValidade = trim(addslashes(filter_input(INPUT_POST, 'data_validade', FILTER_SANITIZE_STRING)));
            $bandeira = (int) filter_input(INPUT_POST, 'bandeira', FILTER_SANITIZE_NUMBER_INT);
            if (ValidacoesHelper::validarNumCartao($numCartao) == TRUE) {
               $erro = ValidacoesHelper::validarNumCartao($numCartao);
               $json = array('status'=>'error', 'message'=>$erro);
            } elseif (ValidacoesHelper::validarDataValidade($dtValidade) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha a Data de Validade!');
            } elseif (ValidacoesHelper::validarBandeira($bandeira)== TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha a Bandeira!');
            } else {
                 try {
                    if ($this->cartaoModel->cadastrarCartaoDebito($idUser,$numCartao,$dtValidade,$bandeira)) { 
                        $json = array('status'=>'success', 'message'=>'Cartão Cadastrado com Sucesso!');
                    } else {
                        $json = array('status'=>'error', 'message'=>'Falha ao Cadastrar o Cartão!', 'error'=>'erroCadModel');
                    }
                 } catch (Exception $e) {
                     $json = array('status'=>'error', 'message' => $e->getMessage(), 'error'=>'erroException');
                 }
            }
            echo json_encode($json);
        } else {
            $this->loadTemplate('cartaoCadastroView');
        }
        
        
    }
    
    
    
}