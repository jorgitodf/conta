<?php

class contaController extends Controller {

    protected $contaModel;
    protected $categoriaModel;

    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Controller
        LoginHelper::isLoogedUser();
        $this->contaModel = new ContaModel();
        $this->categoriaModel = new CategoriaModel();
    }

    public function index() {
        $dados = array();
        $dados['bancos'] = $this->contaModel->getBancos();
        $dados['tipoConta'] = $this->contaModel->getTipoConta();
        $this->loadTemplate('cadastroContaView', $dados);
    }

    public function salvar() {
        $dados = array();
        $dados['bancos'] = $this->contaModel->getBancos();
        $dados['tipoConta'] = $this->contaModel->getTipoConta();
        $status = true;

        if (isset($_POST['nome_banco']) && empty($_POST['nome_banco'])) {
            $dados['erroNomeBanco'] = "<span class='erro_banco'>Campo Nome do Banco Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['nome_banco'] = $_POST['nome_banco'];

        if (isset($_POST['cod_agencia']) && empty($_POST['cod_agencia'])) {
            $dados['erroCodAgencia'] = "<span class='erro_cod_agencia'>Campo Código da Agência Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['codAgencia'] = $_POST['cod_agencia'];

        //if (isset($_POST['dig_agencia']) && !empty($_POST['dig_agencia'])) {
        //$dados['digAgencia'] = $_POST['dig_agencia'];
        //$dados['erroDigVerificador'] = "<span class='erro_dig_verificador'>Campo Dígito Verificador Obrigatório <br/></span>";
        //$status = false;
        //} //else
        //$dados['digAgencia'] = $_POST['dig_agencia'];      

        if (isset($_POST['tipo_conta']) && empty($_POST['tipo_conta'])) {
            $dados['erroTipoConta'] = "<span class='erro_tipo_conta'>Campo Tipo de Conta Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['tipo_conta'] = $_POST['tipo_conta'];

        if (isset($_POST['num_conta']) && empty($_POST['num_conta'])) {
            $dados['erroNumConta'] = "<span class='erro_num_conta'>Campo Número da Conta Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['numConta'] = $_POST['num_conta'];

        if (isset($_POST['dig_conta']) && empty($_POST['dig_conta'])) {
            $dados['erroDigConta'] = "<span class='erro_num_conta'>Campo Dígito Verificador da Conta Obrigatório <br/></span>";
            $status = false;
        } else
            $dados['digConta'] = $_POST['dig_conta'];

        if (isset($_POST['cod_operacao']) && !empty($_POST['cod_operacao'])) {
            $codOperacao = trim(addslashes($_POST['cod_operacao']));
            //$dados['erroCodOperacao'] = "<span class='erro_cod_operacao'>Campo Código de Operação <br/></span>";
            //$status = false;
        }// else
        // $dados['codOperacao'] = $_POST['cod_operacao'];  

        if ($status == true) {

            $nomeBanco = trim(addslashes($_POST['nome_banco']));
            $codAgencia = trim(addslashes($_POST['cod_agencia']));
            $digAgencia = trim(addslashes($_POST['dig_agencia']));
            $tipoConta = trim(addslashes($_POST['tipo_conta']));
            $numConta = trim(addslashes($_POST['num_conta']));
            $digConta = trim(addslashes($_POST['dig_conta']));
            $idUser = $_SESSION['userLogin']['idUser'];

            if ($this->contaModel->verificaContaCadastrada($idUser, $numConta, $codAgencia) > 0) {
                $dados['msg_conta_cadastrada'] = "<span class='alert alert-danger' role='alert' id='msg_conta_cadastrada'>Conta {$numConta} pertecente a Agência {$codAgencia} já cadastrada no Sistema!</span>";
            } elseif ($this->contaModel->cadastrarConta($nomeBanco, $codAgencia, $digAgencia, $tipoConta, $numConta, $digConta, $codOperacao, $idUser) == true) {
                $retorno = $this->contaModel->getContaUsuario($idUser);
                $dadosSucesso = array(
                    'retorno' => $retorno,
                    'msg_sucesso' => "<span class='alert alert-success' role='alert' id='msg_sucesso_conta'>Conta Cadastrada com Sucesso!</span>");
                $this->loadTemplate('cadastroContaSucessoView', $dadosSucesso);
                die();
            } else {
                $dados['msg_erro'] = "<span class='alert alert-danger' role='alert' id='msg_erro'>Não foi possível cadastrar essa Conta!</span>";
            }
        }

        $this->loadTemplate('cadastroContaView', $dados);
    }

    public function extrato($idConta) {
        $dados = array();
        if (is_numeric($idConta)) {
            if ($this->contaModel->verExtratoAtual($idConta) == false) {
                $dados['extrato_erro'] = "<span class='alert alert-danger' role='alert' id='extrato_erro'>Não existe movimentação nesse mês!</span>";
            } else {
                $dados['extrato'] = $this->contaModel->verExtratoAtual($idConta);
                foreach ($dados['extrato'] as $item) {
                    $data_final = $item['DatMov'];
                }
                date_default_timezone_set('America/Sao_Paulo');
                $dataAtual = date("m");
                $data_inicial = "2016-{$dataAtual}-01";
                $dados['data_inicial'] = $data_inicial;
                $dados['data_final'] = $data_final;
            }
        }
        $this->loadTemplate('extratoView', $dados);
    }

    public function debitar($idConta = null) {
        if (is_numeric($idConta) && isset($idConta) && !empty($idConta)) {
            $dados['idConta'] = (int) $_SESSION['conta']['idConta'];
            $dados['idUser'] = (int) $_SESSION['conta']['idUser'];
            $dados['categorias'] = $this->categoriaModel->getCategorias();
            $this->loadTemplate('debitoView', $dados);
        } elseif (isset($_POST)) {
            $idConta = addslashes($_POST['idConta']);
            $dtDebito = trim(addslashes($_POST['data_debito']));
            $movimentacao = trim(addslashes($_POST['movimentacao']));
            $nome_categoria = trim(addslashes($_POST['nome_categoria']));
            $valor = trim(addslashes($_POST['valor']));
            $valor = str_replace('R$ ', '', str_replace(',', '.', str_replace('.', '', $valor)));
            if (ValidacoesHelper::validarData($dtDebito) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o campo Data!', 'error'=>'erroData');
            } else if (ValidacoesHelper::validarMovimentacao($movimentacao) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha a Movimentação', 'error'=>'erroMov');
            } elseif (ValidacoesHelper::validarCategoria($nome_categoria) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha a Categoria', 'error'=>'erroCat');
            } elseif (ValidacoesHelper::validarValor($valor) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o Valor', 'error'=>'erroVal');
            } else {
                try {
                    if ($this->contaModel->debitarValor($idConta,$dtDebito,$movimentacao,$nome_categoria,$valor) == true) {
                        $json = array('status'=>'success', 'message'=>'Débito Realizado com Sucesso!');
                    } elseif ($this->contaModel->debitarValor($idConta,$dtDebito,$movimentacao,$nome_categoria,$valor) == 2) {
                        $json = array('status'=>'error', 'message'=>'Saldo Insuficiente para Realiazar a Transação!');
                    } else {
                        $json = array('status'=>'error', 'message'=>'Falha ao Debitar a Transação.');
                    }
                } catch (Exception $e) {
                    $json = array('status'=>'error', 'message' => $e->getMessage(), 'error'=>'erroException');
                }
            }
            echo json_encode($json);
        } else {
            $this->loadTemplate('debitoView');
        }
    }

    public function creditar($idConta = null) {
        if (is_numeric($idConta) && isset($idConta) && !empty($idConta)) {
            $dados['idConta'] = (int) $_SESSION['conta']['idConta'];
            $dados['idUser'] = (int) $_SESSION['conta']['idUser'];
            $dados['categorias'] = $this->categoriaModel->getCategorias();
            $this->loadTemplate('creditoView', $dados);
        } elseif (isset($_POST)) {
            $idConta = (int) filter_input(INPUT_POST, 'idConta', FILTER_SANITIZE_NUMBER_INT);
            $dtCredito = trim(addslashes(filter_input(INPUT_POST, 'data_credito', FILTER_SANITIZE_STRING)));
            $movimentacao_cre = trim(addslashes(filter_input(INPUT_POST, 'mov_cred', FILTER_SANITIZE_STRING)));
            $categoria = (int) filter_input(INPUT_POST, 'nome_cat_cre', FILTER_SANITIZE_NUMBER_INT);
            $valor = trim(addslashes($_POST['valor_cre']));
            $valorNew = str_replace('R$ ', '', str_replace(',', '.', str_replace('.', '', $valor)));
            if (ValidacoesHelper::validarData($dtCredito) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o campo Data!');
            } elseif (ValidacoesHelper::validarMovimentacao($movimentacao_cre) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha a Movimentação',);
            } elseif (ValidacoesHelper::validarCategoria($categoria) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha a Categoria', 'error'=>'erroCat');
            } elseif (ValidacoesHelper::validarValor($valorNew) == TRUE) {
                $json = array('status'=>'error', 'message'=>'Preencha o Valor', 'error'=>'erroVal');
            } else {
                try {
                    if ($this->contaModel->creditarValor($idConta,$dtCredito,$movimentacao_cre,$categoria,$valorNew)) {
                        $json = array('status'=>'success', 'message'=>'Transação Creditada com Sucesso!');
                    } else {
                        $json = array('status'=>'error', 'message'=>'Falha ao Creditar a Transação.');
                    }
                } catch (Exception $e) {
                    $json = array('status'=>'error', 'message' => $e->getMessage(), 'error'=>'erroException');
                }
            }
            echo json_encode($json);
        } else {
            $this->loadTemplate('creditoView');
        }
    }

    /* public function agendar($idConta = null) {
        $dados = array();

        if ($_POST) {
            $status = true;
            if (empty($_POST['data_credito'])) {
                $dados['erroCredito'] = "<span class='erro_credito'>Preencha o campo Data!!</span>";
                $status = false;
            } else {
                $dados['data_credito'] = $_POST['data_credito'];
            }
            if (empty($_POST['movimentacao'])) {
                $dados['erroMovimentacao'] = "<span class='erro_movimentacao'>Preencha o campo Movimentacao!!</span>";
                $status = false;
            } else {
                $dados['movimentacao'] = $_POST['movimentacao'];
            }
            if (empty($_POST['nome_categoria'])) {
                $dados['erroCategoria'] = "<span class='erro_nome_categoria'>Preencha o campo Categoria!!</span>";
                $status = false;
            } else {
                $dados['nome_categoria'] = $_POST['nome_categoria'];
            }
            if (empty($_POST['valor']) || $_POST['valor'] == 'R$ 0,00') {
                $dados['erroValor'] = "<span class='erro_valor'>Preencha o campo Valor!!</span>";
                $status = false;
            } else {
                $dados['valor'] = $_POST['valor'];
            }

            if ($status == true) {
                $idConta = trim(addslashes($_POST['idConta']));
                $dataCredito = trim(addslashes($_POST['data_credito']));
                $movimentacao = trim(addslashes($_POST['movimentacao']));
                $categoria = trim(addslashes($_POST['nome_categoria']));
                $valor = trim(addslashes($_POST['valor']));
                $valor = str_replace('.', '', $valor);
                $valor = str_replace(',', '.', $valor);
                $novoValor = str_replace('R$ ', '', $valor);

                if ($this->contaModel->creditarPgto($idConta, $dataCredito, $movimentacao, $categoria, $novoValor) == true) {
                    $dadosSucesso = array();
                    $dadosSucesso['idConta'] = $idConta;
                    $dadosSucesso['msg_sucesso'] = "<span class='alert alert-success' role='alert' id='msg_sucesso_deb'>Pagamento Agendado com Sucesso!</span>";
                    $dadosSucesso['last_pgto_agendado'] = $this->contaModel->getLastPgtoAgendado($idConta);
                    $this->loadTemplate('agendaPgtoSucessoView', $dadosSucesso);
                    die();
                } else {
                    
                }
            }
            $dados['idConta'] = $idConta;
            $dados['categorias'] = $this->categoriaModel->getCategorias();
            $this->loadTemplate('agendaPgtoView', $dados);
        } else {
            if (is_numeric($idConta)) {
                $dados['idConta'] = $idConta;
                $dados['categorias'] = $this->categoriaModel->getCategorias();
                $this->loadTemplate('agendaPgtoView', $dados);
            }
        }
    } */

    public function trocar() {
        unset($_SESSION['conta']);
        header("Location: /home");
    }
    
    public function trazerTabela (){
        if ($_POST['idConta']) {
            date_default_timezone_set('America/Sao_Paulo');
            $idConta = (int) filter_input(INPUT_POST, 'idConta', FILTER_SANITIZE_NUMBER_INT); 
            $ano = date("Y");
            $mes = $this->contaModel->verificaMes();
            $contas_agendadas = $this->contaModel->getContasAgendadas($idConta);
            $tabela = ConstructHelper::monta_tabela_grupos($mes, $ano, $contas_agendadas);
            $json = array('status'=>'sucess', 'message'=>'Não há nenhum pagamento agendado pagamento hoje!', 'tabela'=>$tabela);
            echo json_encode($json);
        } 
    }

    public function pagar() {
        if ($_POST['idConta']) {
            date_default_timezone_set('America/Sao_Paulo');
            $idConta = (int) filter_input(INPUT_POST, 'idConta', FILTER_SANITIZE_NUMBER_INT);
            $resultado = $this->contaModel->verificaPagamentoAgendado();
            if ($resultado == 0) {
                $ano = date("Y");
                $mes = $this->contaModel->verificaMes();
                $contas_agendadas = $this->contaModel->getContasAgendadas($idConta);
                $tabela = ConstructHelper::monta_tabela_grupos($mes, $ano, $contas_agendadas);
                $json = array('status'=>'error', 'message'=>'Não há nenhum pagamento agendado para hoje!', 'tabela'=>$tabela);
            } else {
                $ano = date("Y");
                $mes = $this->contaModel->verificaMes();
                $contas_agendadas = $this->contaModel->getContasAgendadas($idConta);
                $tabela = ConstructHelper::monta_tabela_grupos($mes, $ano, $contas_agendadas);
                $json = array('status'=>'success', 'message'=>'Pagamento(s) realizado(s) com Sucesso!', 'tabela'=>$tabela);
            }
            echo json_encode($json);
        }
    }

    public function validaData($dat) {
        $data = explode("/", "$dat"); // fatia a string $dat em pedados, usando / como referência
        $d = $data[0];
        $m = $data[1];
        $y = $data[2];
        $res = checkdate($m, $d, $y);
        if ($res == 1) {
            return true;
        }
    }

}
