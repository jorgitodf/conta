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

    public function ver() {
        if (isset($_POST['radio_conta']) && !empty($_POST['radio_conta'])) {
            $idUser = $_SESSION['userLogin']['idUser'];
            $idConta = (int) $_POST['radio_conta'];
            $_SESSION['conta'] = array('idConta' => '', 'codConta' => '', 'nomeBanco' => '', 'DigVerAgencia' => '', 'TipoConta' => '', 'numConta' => '', 'DigVerConta' => '', 'idUser' => '');
            $dados = $this->contaModel->getConta($idUser, $idConta);
            foreach ($dados as $linha) {
                $_SESSION['conta']['idConta'] = $linha['IdConta'];
                $_SESSION['conta']['codConta'] = $linha['CodAgencia'];
                $_SESSION['conta']['nomeBanco'] = $linha['NomeBanco'];
                $_SESSION['conta']['DigVerAgencia'] = $linha['DigVerAgencia'];
                $_SESSION['conta']['TipoConta'] = $linha['TipoConta'];
                $_SESSION['conta']['numConta'] = $linha['NumeroConta'];
                $_SESSION['conta']['DigVerConta'] = $linha['DigVerConta'];
            }
            $this->loadTemplate('homePrincipalContaView');
        }
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
        $dados = array();

        if ($_POST) {
            $status = true;
            if (empty($_POST['data_debito'])) {
                $dados['erroDebito'] = "<span class='erro_debito'>Preencha o campo Data!!</span>";
                $status = false;
            } else {
                $dados['data_debito'] = $_POST['data_debito'];
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
                $dataDebito = trim(addslashes($_POST['data_debito']));
                $movimentacao = trim(addslashes($_POST['movimentacao']));
                $categoria = trim(addslashes($_POST['nome_categoria']));
                $valor = trim(addslashes($_POST['valor']));
                $valor = str_replace('.', '', $valor);
                $valor = str_replace(',', '.', $valor);
                $novoValor = str_replace('R$ ', '', $valor);

                if ($this->contaModel->debitarValor($idConta, $dataDebito, $movimentacao, $categoria, $novoValor) == true) {
                    $dadosSucesso = array();
                    $dadosSucesso['idConta'] = $idConta;
                    $dadosSucesso['msg_sucesso'] = "<span class='alert alert-success' role='alert' id='msg_sucesso_deb'>Valor Debitado com Sucesso!</span>";
                    $dadosSucesso['last_debito'] = $this->contaModel->getLastDebito($idConta);
                    $this->loadTemplate('debitoSucessoView', $dadosSucesso);
                    die();
                } else {
                    
                }
            }
            $dados['idConta'] = $idConta;
            $dados['categorias'] = $this->categoriaModel->getCategorias();
            $this->loadTemplate('debitoView', $dados);
        } else {
            if (is_numeric($idConta)) {
                $dados['idConta'] = $idConta;
                $dados['categorias'] = $this->categoriaModel->getCategorias();
                $this->loadTemplate('debitoView', $dados);
            }
        }
    }

    public function creditar($idConta = null) {
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

                if ($this->contaModel->creditarValor($idConta, $dataCredito, $movimentacao, $categoria, $novoValor) == true) {
                    $dadosSucesso = array();
                    $dadosSucesso['idConta'] = $idConta;
                    $dadosSucesso['msg_sucesso'] = "<span class='alert alert-success' role='alert' id='msg_sucesso_deb'>Valor Creditado com Sucesso!</span>";
                    $dadosSucesso['last_debito'] = $this->contaModel->getLastDebito($idConta);
                    $this->loadTemplate('creditoSucessoView', $dadosSucesso);
                    die();
                } else {
                    
                }
            }
            $dados['idConta'] = $idConta;
            $dados['categorias'] = $this->categoriaModel->getCategorias();
            $this->loadTemplate('creditoView', $dados);
        } else {
            if (is_numeric($idConta)) {
                $dados['idConta'] = $idConta;
                $dados['categorias'] = $this->categoriaModel->getCategorias();
                $this->loadTemplate('creditoView', $dados);
            }
        }
    }
    
    public function agendar($idConta = null) {
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
    }

    public function trocar() {
        unset($_SESSION['conta']);
        header("Location: /home");
    }

}
