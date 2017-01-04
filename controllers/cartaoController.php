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
            $dados['bancos'] = $this->cartaoModel->getBancos();
            $this->loadTemplate('cartaoCadastroView', $dados);
        } else if (isset($_POST)) {
            $idUser = (int) filter_input(INPUT_POST, 'idUser', FILTER_SANITIZE_NUMBER_INT);
            $numCartao = trim(addslashes(filter_input(INPUT_POST, 'num_cartao', FILTER_SANITIZE_NUMBER_INT)));
            $dtValidade = trim(addslashes(filter_input(INPUT_POST, 'data_validade', FILTER_SANITIZE_STRING)));
            $bandeira = (int) filter_input(INPUT_POST, 'bandeira', FILTER_SANITIZE_NUMBER_INT);
            $banco = (int) filter_input(INPUT_POST, 'banco', FILTER_SANITIZE_NUMBER_INT);
            if (ValidacoesHelper::validarNumCartao($numCartao) == TRUE) {
               $erro = ValidacoesHelper::validarNumCartao($numCartao);
               $json = array('status'=>'error', 'message'=>$erro);
            } elseif (ValidacoesHelper::validarDataValidade($dtValidade) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha a Data de Validade!');
            } elseif (ValidacoesHelper::validarBandeira($bandeira)== TRUE) {
                $json = array('status'=>'error', 'message'=>'Informe a Bandeira!');
            } elseif (ValidacoesHelper::validarBanco($banco)== TRUE) {
                $json = array('status'=>'error', 'message'=>'Informe o Banco!');
            } else {
                 try {
                    if ($this->cartaoModel->cadastrarCartaoDebito($idUser,$numCartao,$dtValidade,$bandeira,$banco)) { 
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
    
    public function fatura() {
        $dados = array();
        if (isset($_SESSION['userLogin']) && !$_POST) {
            $dados['idUser'] = $_SESSION['userLogin']['idUser'];
            $dados['cartao'] = $this->cartaoModel->getCartaoByIdUser($dados['idUser']);
            $this->loadTemplate('faturaCadastroView', $dados);
        } elseif (isset($_POST)) {
            $cartao = trim(addslashes(filter_input(INPUT_POST, 'cartao', FILTER_SANITIZE_NUMBER_INT)));
            $data_pagto = trim(addslashes(filter_input(INPUT_POST, 'data_pagto', FILTER_SANITIZE_STRING)));
            if (ValidacoesHelper::validarCartao($cartao) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Selecione um Cartão', 'error'=>'erroMov');
            } else if (ValidacoesHelper::validarData($data_pagto) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o campo Data!', 'error'=>'erroData');
            } else {
                try {
                    if ($this->cartaoModel->cadastrarFaturaCartao($cartao, $data_pagto)) {
                        $json = array('status'=>'success', 'message'=>'Fatura Cadastrada com Sucesso!');
                    } else {
                        $json = array('status'=>'error', 'message'=>'Falha ao cadastrar a Fatura.', 'error'=>'erroCadModel');
                    }
                } catch (Exception $e) {
                    $json = array('status'=>'error', 'message' => $e->getMessage(), 'error'=>'erroException');
                }
            }
            echo json_encode($json);
        } else {
            $this->loadTemplate('faturaCadastroView');
        }
    }
    
    public function debitarfatura() {
        $dados = array();
        if (!$_POST) {
            $this->loadTemplate('faturaDebitarView', $dados);
        } elseif (isset($_POST)) {

        } else {
            $this->loadTemplate('faturaDebitarView');
        }  
    }

    
}