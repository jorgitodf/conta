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
            $dados['cartao'] = $this->cartaoModel->getCartaoByDataPgtoFatura();
            $this->loadTemplate('faturaDebitarView', $dados);
        } elseif (isset($_POST)) {
            $idFaturaCartao = (int) filter_input(INPUT_POST, 'cartao_fat', FILTER_SANITIZE_NUMBER_INT);
            $dtCompra = trim(addslashes(filter_input(INPUT_POST, 'data_compra', FILTER_SANITIZE_STRING)));
            $descricao = trim(addslashes(filter_input(INPUT_POST, 'descricao', FILTER_SANITIZE_STRING)));
            $valor = trim(addslashes($_POST['valor_compra_fatura']));
            $valor = str_replace('R$ ', '', str_replace(',', '.', str_replace('.', '', $valor)));
            $parcela = filter_input(INPUT_POST, 'parcela', FILTER_SANITIZE_STRING);
            if (ValidacoesHelper::validarCampoIntegerVazio($idFaturaCartao) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Selecione um Cartão com a Data de Vencimento da Fatura', 'error'=>'erroMov');
            } elseif (ValidacoesHelper::validarData($dtCompra) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Informe a Data da Compra', 'error'=>'erroMov');
            } elseif (ValidacoesHelper::validarCampoDescricao($descricao) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Informe a Descrição da Compra', 'error'=>'erroMov');
            } elseif (ValidacoesHelper::validarValor($valor) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Informe o Valor da Compra', 'error'=>'erroMov');
            } else {
                try {
                    if ($this->cartaoModel->cadastrarDespesaFaturaCartaoCredito($idFaturaCartao,$descricao,$dtCompra,$valor,$parcela)) {
                        $json = array('status'=>'success', 'message'=>'Despesa na Fatura Gravada com Sucesso!');
                    } else {
                        $json = array('status'=>'error', 'message'=>'Falha ao Gravar a Despesa na Fatura.', 'error'=>'erroCadModel');
                    }
                } catch (Exception $e) {
                    $json = array('status'=>'error', 'message' => $e->getMessage(), 'error'=>'erroException');
                }
            }
            echo json_encode($json);
        } else {
            $this->loadTemplate('faturaDebitarView');
        }  
    }

    public function fecharfatura() {
        $dados = array();
        if (!$_POST) {
            $dados['cartao'] = $this->cartaoModel->getCartaoByDataPgtoFatura();
            $this->loadTemplate('faturaFecharView', $dados);
        } elseif (isset($_SESSION['userLogin']) && isset($_POST)) {
            if (isset($_POST['cartao_fat'])) {
                $idUser = (int) $_SESSION['userLogin']['idUser'];
                $idFaturaCartao = (int) filter_input(INPUT_POST, 'cartao_fat', FILTER_SANITIZE_NUMBER_INT);
                $dados['fatura'] = $this->cartaoModel->getCartaoByDataPgtoFatura($idFaturaCartao, $idUser);
                $dados['itensfatura'] = $this->cartaoModel->getItensDespesaFaturaByIdFaturaCartao($idFaturaCartao);
                $this->loadTemplate('faturaFecharView', $dados);
            } elseif (isset($_POST['id_cartao_fat']) || isset($_POST['subtotal']) || isset($_POST['encargos']) || isset($_POST['iof'])
                  || isset($_POST['anuidade']) || isset($_POST['protecao_prem']) || isset($_POST['restante']) || isset($_POST['juros_fat'])) {
                $idUser = (int) $_SESSION['userLogin']['idUser'];
                $idFaturaCartao = (int) filter_input(INPUT_POST, 'id_cartao_fat', FILTER_SANITIZE_NUMBER_INT);
                $subtotal = $_POST['subtotal'];
                $encargos = addslashes($_POST['encargos']);
                $iof = addslashes($_POST['iof']);
                $anuidade = addslashes($_POST['anuidade']);
                $protecao_prem = addslashes($_POST['protecao_prem']);
                $juros_fat = addslashes($_POST['juros_fat']);
                $restante = addslashes($_POST['restante']);
                $valor_pagar = $_POST['valor_pagar'];
                
                $encargosNew = ValidacoesHelper::removeCaracteresValor($encargos);
                $iofNew = ValidacoesHelper::removeCaracteresValor($iof);
                $anuidadeNew = ValidacoesHelper::removeCaracteresValor($anuidade);
                $protecao_premNew = ValidacoesHelper::removeCaracteresValor($protecao_prem);
                $juros_fatNew = ValidacoesHelper::removeCaracteresValor($juros_fat);
                $restanteNew = ValidacoesHelper::removeCaracteresValor($restante);
                $valor_pagarNew = ValidacoesHelper::removeCaracteresValor($valor_pagar);
                
                $totalGeral = ($subtotal + $encargosNew + $iofNew + $anuidadeNew + $protecao_premNew + $juros_fatNew + $restanteNew);
                
                $dados['rettotalgeral'] = ['encargos'=>$encargosNew,'iof'=>$iofNew,'anuidade'=>$anuidadeNew,'protecao'=>$protecao_premNew,
                    'juros'=>$juros_fatNew,'restante'=>$restanteNew,'totalgeral'=>$totalGeral,'valor_pagar'=>$valor_pagarNew];
                
                if ($valor_pagarNew <= $totalGeral && !empty($valor_pagarNew) && !empty($totalGeral)) {
                    if ($this->cartaoModel->pagarFatura($dados['rettotalgeral'], $idFaturaCartao) == true) {
                        echo "Fatura paga com Sucesso...";
                    } else {
                        echo "Erro ao Pagar a Fatura...";
                    }
                }
                
                $dados['fatura'] = $this->cartaoModel->getCartaoByDataPgtoFatura($idFaturaCartao, $idUser);
                $dados['itensfatura'] = $this->cartaoModel->getItensDespesaFaturaByIdFaturaCartao($idFaturaCartao);
                $this->loadTemplate('faturaFecharView', $dados);
            }
        } else {
            $this->loadTemplate('faturaFecharView');
        }  
    }
}