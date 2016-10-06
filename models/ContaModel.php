<?php

class ContaModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function verificaConta($idUser) {
        if (isset($idUser) && !empty($idUser)) {
            $stmt = $this->db->prepare("SELECT tb_conta.id_conta AS 'IdConta', tb_conta.codigo_agencia AS 'CodAgencia', "
                  . "tb_banco.nome_banco  AS 'NomeBanco', tb_conta.digito_verificador_agencia AS 'DigVerAgencia', "
                  . "tb_tipo_conta.tipo_conta AS 'TipoConta', tb_conta.numero_conta AS 'NumeroConta', "
                  . "tb_conta.digito_verificador_conta AS 'DigVerConta', tb_conta.codigo_operacao AS 'CodOperacao', "
                  . "date_format(tb_conta.data_cadastro, '%d/%m/%Y') AS 'DataCadastro' FROM tb_conta LEFT JOIN tb_banco "
                  . "ON (tb_conta.fk_cod_banco = tb_banco.cod_banco) LEFT JOIN tb_tipo_conta ON (tb_conta.fk_tipo_conta = "
                  . "tb_tipo_conta.id_tipo_conta) WHERE tb_conta.fk_id_usuario = ? ORDER BY tb_conta.id_conta DESC");
            $stmt->bindValue(1, $idUser, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getContaUsuario($idUser) {
        $stmt = $this->db->prepare("SELECT tb_conta.id_conta AS 'IdConta', tb_conta.codigo_agencia AS 'CodAgencia', tb_banco.nome_banco  AS 'NomeBanco', tb_conta.digito_verificador_agencia AS 'DigVerAgencia', tb_tipo_conta.tipo_conta AS 'TipoConta', tb_conta.numero_conta AS 'NumeroConta', tb_conta.digito_verificador_conta AS 'DigVerConta', tb_conta.codigo_operacao AS 'CodOperacao', date_format(tb_conta.data_cadastro, '%d/%m/%Y') AS 'DataCadastro' FROM tb_conta LEFT JOIN tb_banco ON (tb_conta.fk_cod_banco = tb_banco.cod_banco) LEFT JOIN tb_tipo_conta ON (tb_conta.fk_tipo_conta = tb_tipo_conta.id_tipo_conta) WHERE tb_conta.fk_id_usuario = ? ORDER BY tb_conta.id_conta DESC");
        $stmt->bindValue(1, $idUser, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getBancos() {
        $stmt = $this->db->query("SELECT * FROM tb_banco ORDER BY nome_banco");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getTipoConta() {
        $stmt = $this->db->query("SELECT * FROM tb_tipo_conta ORDER BY tipo_conta");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function cadastrarConta($nomeBanco, $codAgencia, $digAgencia, $tipoConta, $numConta, $digConta, $codOperacao, $idUser) {
        if (!empty($nomeBanco) && !empty($codAgencia) && !empty($tipoConta) && !empty($numConta) && !empty($digConta) && !empty($idUser)) {

            if (!isset($codOperacao) || empty($codOperacao)) {
                $codOperacao = NULL;
            }
            if (!isset($digAgencia) || empty($digAgencia)) {
                $digAgencia = NULL;
            }

            $statement = $this->db->prepare('INSERT INTO tb_conta (codigo_agencia, digito_verificador_agencia, numero_conta, digito_verificador_conta, codigo_operacao, data_cadastro, fk_id_usuario, fk_cod_banco, fk_tipo_conta) VALUES (:codigo_agencia, :digito_verificador_agencia, :numero_conta, :digito_verificador_conta, :codigo_operacao, :data_cadastro, :fk_id_usuario, :fk_cod_banco, :fk_tipo_conta)');

            $nomeBanco = filter_var($nomeBanco);
            $codAgencia = filter_var($codAgencia);
            $tipoConta = filter_var($tipoConta);
            $numConta = filter_var($numConta);
            $digConta = filter_var($digConta);
            $idUser = filter_var($idUser);
            date_default_timezone_set('America/Sao_Paulo');
            $dataCadastro = date("Y-m-d H:i:s");

            $statement->bindParam(':codigo_agencia', $codAgencia);
            $statement->bindParam(':digito_verificador_agencia', $digAgencia);
            $statement->bindParam(':numero_conta', $numConta);
            $statement->bindParam(':digito_verificador_conta', $digConta);
            $statement->bindParam(':codigo_operacao', $codOperacao);
            $statement->bindParam(':data_cadastro', $dataCadastro);
            $statement->bindParam(':fk_id_usuario', $idUser);
            $statement->bindParam(':fk_cod_banco', $nomeBanco);
            $statement->bindParam(':fk_tipo_conta', $tipoConta);

            if (!$statement->execute()) {
                return false;
            } else {
                return true;
            }
        }
    }

    public function verificaContaCadastrada($idUser, $numConta, $codAgencia) {
        $stmt = $this->db->prepare("SELECT * FROM tb_conta WHERE fk_id_usuario = ? AND numero_conta = ? AND codigo_agencia = ?");
        $stmt->bindValue(1, $idUser, PDO::PARAM_INT);
        $stmt->bindValue(2, $numConta, PDO::PARAM_INT);
        $stmt->bindValue(3, $codAgencia, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->rowCount();
    }

    public function verExtratoAtual($idConta) {
        if (isset($idConta) && !empty($idConta)) {
            date_default_timezone_set('America/Sao_Paulo');
            $dataAtual = date("m");
            $dataMovimentacaoInicial = "2016-{$dataAtual}-01";
            $dataMovimentacaoFinal = "2016-{$dataAtual}-31";

            $stmt = $this->db->prepare("SELECT Ext.data_movimentacao AS 'DatMov', Ext.movimentacao AS 'Mov', Cat.nome_categoria AS 'Cat', Ext.tipo_operacao AS 'Op', Ext.valor AS 'Val', Ext.saldo AS 'Sal', Ext.despesa_fixa AS 'Dp' FROM tb_extrato AS Ext LEFT JOIN tb_categoria AS Cat ON (Ext.fk_id_categoria = Cat.id_categoria) WHERE Ext.fk_id_conta = ? AND Ext.data_movimentacao BETWEEN ? AND ?");
            $stmt->bindValue(1, $idConta, PDO::PARAM_INT);
            $stmt->bindValue(2, $dataMovimentacaoInicial);
            $stmt->bindValue(3, $dataMovimentacaoFinal);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function verSaldoAtual($idConta) {
        if (isset($idConta) && !empty($idConta)) {
            $stmt = $this->db->prepare("SELECT saldo FROM tb_extrato WHERE fk_id_conta = ? ORDER BY id_extrato DESC LIMIT 1");
            $stmt->bindValue(1, $idConta, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function debitarValor($idConta, $dataDebito, $movimentacao, $categoria, $novoValor) {
        if (!empty($idConta) && !empty($dataDebito) && !empty($movimentacao) && !empty($categoria) && !empty($novoValor)) {
            $saldo = $this->verSaldoAtual($idConta);
            foreach ($saldo as $item) {
                $saldo = $item;
            }
            if ($saldo < $novoValor) {
                return 0;
            } else {
                $novoSaldo = $saldo - $novoValor;
                $mes = $this->verificaMes();
                $checkCategoria = $this->checkCategoria();
                foreach ($checkCategoria as $linha) {
                    $linha['id_categoria'];
                    if ($linha['id_categoria'] == $categoria) {
                        $despFixa = 'S';
                    } else {
                        $despFixa = 'N';
                    }
                }
                $stmt = $this->db->prepare("INSERT INTO tb_extrato (data_movimentacao, mes, tipo_operacao, movimentacao, quantidade, valor, saldo, fk_id_categoria, fk_id_conta, despesa_fixa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->bindValue(1, $dataDebito, PDO::PARAM_STR);
                $stmt->bindValue(2, $mes, PDO::PARAM_STR);
                $stmt->bindValue(3, 'Débito', PDO::PARAM_STR);
                $stmt->bindValue(4, $movimentacao, PDO::PARAM_STR);
                $stmt->bindValue(5, 1, PDO::PARAM_INT);
                $stmt->bindValue(6, $novoValor, PDO::PARAM_STR);
                $stmt->bindValue(7, $novoSaldo, PDO::PARAM_STR);
                $stmt->bindValue(8, $categoria, PDO::PARAM_INT);
                $stmt->bindValue(9, $idConta, PDO::PARAM_INT);
                $stmt->bindValue(10, $despFixa, PDO::PARAM_STR);
                $stmt->execute();
                return 1;
            }
        }
    }
    
    public function creditarValor($idConta, $dataCredito, $movimentacao, $categoria, $novoValor) {
        if (!empty($idConta) && !empty($dataCredito) && !empty($movimentacao) && !empty($categoria) && !empty($novoValor)) {
            
            $saldo = $this->verSaldoAtual($idConta);
                foreach ($saldo as $item) {
                    $saldo = $item;
                }
                $novoSaldo = $saldo + $novoValor;
                $mes = $this->verificaMes();
                $checkCategoria = $this->checkCategoria();
                foreach ($checkCategoria as $linha) {
                    $linha['id_categoria'];
                    if ($linha['id_categoria'] == $categoria) {
                        $despFixa = 'S';
                    } else {
                        $despFixa = 'N';
                    }
                }
            $stmt = $this->db->prepare("INSERT INTO tb_extrato (data_movimentacao, mes, tipo_operacao, movimentacao, quantidade, valor, saldo, fk_id_categoria, fk_id_conta, despesa_fixa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $dataCredito, PDO::PARAM_STR);
            $stmt->bindValue(2, $mes, PDO::PARAM_STR);
            $stmt->bindValue(3, 'Crédito', PDO::PARAM_STR);
            $stmt->bindValue(4, $movimentacao, PDO::PARAM_STR);
            $stmt->bindValue(5, 1, PDO::PARAM_INT);
            $stmt->bindValue(6, $novoValor, PDO::PARAM_STR);
            $stmt->bindValue(7, $novoSaldo, PDO::PARAM_STR);
            $stmt->bindValue(8, $categoria, PDO::PARAM_INT);
            $stmt->bindValue(9, $idConta, PDO::PARAM_INT);
            $stmt->bindValue(10, $despFixa, PDO::PARAM_STR);
            $stmt->execute();
            return 1;
        }
    }
    
    public function creditarPgto($idConta, $dataCredito, $movimentacao, $categoria, $novoValor) {
        if (!empty($idConta) && !empty($dataCredito) && !empty($movimentacao) && !empty($categoria) && !empty($novoValor)) {
            $stmt = $this->db->prepare("INSERT INTO tb_pgto_agendado (data_pagamento, movimentacao, valor, pago, fk_id_categoria, "
                  . "fk_id_conta) VALUES (?, ?, ?, ?, ?, ?)");
            $stmt->bindValue(1, $dataCredito, PDO::PARAM_STR);
            $stmt->bindValue(2, $movimentacao, PDO::PARAM_STR);
            $stmt->bindValue(3, $novoValor, PDO::PARAM_STR);
            $stmt->bindValue(4, 'N', PDO::PARAM_STR);
            $stmt->bindValue(5, $categoria, PDO::PARAM_INT);
            $stmt->bindValue(6, $idConta, PDO::PARAM_INT);
            $stmt->execute();
            return 1;
        }
    }

    public function verificaMes() {
        date_default_timezone_set('America/Sao_Paulo');
        $mesAtual = date("m");
        switch ($mesAtual) {
            case '01':
                $mesAtual = 'Janeiro';
                break;
            case '02':
                $mesAtual = 'Fevereiro';
                break;
            case '03':
                $mesAtual = 'Março';
                break;
            case '04':
                $mesAtual = 'Abril';
                break;
            case '05':
                $mesAtual = 'Maio';
                break;
            case '06':
                $mesAtual = 'Junho';
                break;
            case '07':
                $mesAtual = 'Julho';
                break;
            case '08':
                $mesAtual = 'Agosto';
                break;
            case '09':
                $mesAtual = 'Setembro';
                break;
            case '10':
                $mesAtual = 'Outubro';
                break;
            case '11':
                $mesAtual = 'Novembro';
                break;
            case '12':
                $mesAtual = 'Dezembro';
                break;
        }
        return $mesAtual;
    }

    public function checkCategoria() {
        $stmt = $this->db->query("SELECT * FROM tb_categoria WHERE id_categoria IN (5,6,11,18,19,22,25,31,37,42)");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getLastDebito($idConta) {
        $stmt = $this->db->prepare("SELECT Ext.data_movimentacao AS 'DatMov', Ext.movimentacao AS 'Mov', Cat.nome_categoria AS 'Cat', Ext.valor AS 'Val' FROM tb_extrato AS Ext, tb_categoria AS Cat WHERE Ext.fk_id_categoria = Cat.id_categoria AND Ext.fk_id_conta = ? ORDER BY id_extrato DESC LIMIT 1");
        $stmt->bindValue(1, $idConta, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getLastPgtoAgendado($idConta) {
        $stmt = $this->db->prepare("SELECT pgag.id_pgto_agendado AS 'idpgag', pgag.data_pagamento AS 'data', pgag.movimentacao AS "
              . "'mov', pgag.valor AS 'valor', cat.nome_categoria AS 'cat' FROM tb_pgto_agendado AS pgag, tb_categoria AS cat WHERE "
              . "pgag.fk_id_categoria = cat.id_categoria AND pgag.fk_id_conta = ? ORDER BY id_pgto_agendado DESC LIMIT 1");
        $stmt->bindValue(1, $idConta, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getConta($idUser, $idConta) {
        if (!empty($idUser) && !empty($idConta)) {
            $stmt = $this->db->prepare("SELECT tb_conta.id_conta AS 'IdConta', tb_conta.codigo_agencia AS 'CodAgencia', tb_banco.nome_banco  AS 'NomeBanco', tb_conta.digito_verificador_agencia AS 'DigVerAgencia', tb_tipo_conta.tipo_conta AS 'TipoConta', tb_conta.numero_conta AS 'NumeroConta', tb_conta.digito_verificador_conta AS 'DigVerConta', tb_conta.codigo_operacao AS 'CodOperacao' FROM tb_conta LEFT JOIN tb_banco ON (tb_conta.fk_cod_banco = tb_banco.cod_banco) LEFT JOIN tb_tipo_conta ON (tb_conta.fk_tipo_conta = tb_tipo_conta.id_tipo_conta) WHERE tb_conta.fk_id_usuario = ? AND tb_conta.id_conta = ? ORDER BY tb_conta.id_conta DESC");
            $stmt->bindValue(1, $idConta, PDO::PARAM_INT);
            $stmt->bindValue(2, $idUser, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    public function getContasAgendadas($idConta) {
        $stmt = $this->db->prepare("SELECT pgag.id_pgto_agendado AS 'idpgag', pgag.data_pagamento AS 'data', pgag.movimentacao "
              . "AS 'mov', pgag.valor AS 'valor', pgag.pago AS 'pago' FROM tb_pgto_agendado AS pgag WHERE pgag.fk_id_conta = ? "
              . "ORDER BY data_pagamento ASC");
        $stmt->bindValue(1, $idConta, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);       
    }
    
    public function verificaPagamentoAgendado () {
        $dados = array();
        date_default_timezone_set('America/Sao_Paulo');
        $dataPagamento = date("Y-m-d"); 
        $stmtSelect = $this->db->prepare("SELECT * FROM tb_pgto_agendado WHERE data_pagamento = ? ORDER BY data_pagamento");
        $stmtSelect->bindValue(1, $dataPagamento, PDO::PARAM_INT);
        $stmtSelect->execute();
        $dados = $stmtSelect->fetchALL(PDO::FETCH_ASSOC);
        
        if (!empty($dados)) {
            foreach ($dados as $value) {
                $saldo = $this->verSaldoAtual($_SESSION['conta']['idConta']);
                if ($saldo['saldo'] < $value['valor']) {
                    return 0;
                } else { 
                    $novoSaldo = $saldo - $value['valor'];
                    $mes = $this->verificaMes();
                    $checkCategoria = $this->checkCategoria();
                    foreach ($checkCategoria as $linha) {
                        $linha['id_categoria'];
                        if ($linha['id_categoria'] == $value['fk_id_categoria']) {
                            $despFixa = 'S';
                        } else {
                            $despFixa = 'N';
                        }
                    }
                    if ($value['pago'] == 'Não') {
                        $stmt = $this->db->prepare("INSERT INTO tb_extrato (data_movimentacao, mes, tipo_operacao, movimentacao, quantidade,"
                              . " valor, saldo, fk_id_categoria, fk_id_conta, despesa_fixa) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                        $stmt->bindValue(1, $value['data_pagamento'], PDO::PARAM_STR);
                        $stmt->bindValue(2, $mes, PDO::PARAM_STR);
                        $stmt->bindValue(3, 'Débito', PDO::PARAM_STR);
                        $stmt->bindValue(4, $value['movimentacao'], PDO::PARAM_STR);
                        $stmt->bindValue(5, 1, PDO::PARAM_INT);
                        $stmt->bindValue(6, $value['valor'], PDO::PARAM_STR);
                        $stmt->bindValue(7, $novoSaldo, PDO::PARAM_STR);
                        $stmt->bindValue(8, $value['fk_id_categoria'], PDO::PARAM_INT);
                        $stmt->bindValue(9, $value['fk_id_conta'], PDO::PARAM_INT);
                        $stmt->bindValue(10, $despFixa, PDO::PARAM_STR);
                        $stmt->execute();

                        $stmtUpdate = $this->db->prepare("UPDATE tb_pgto_agendado SET pago = 'Sim' WHERE id_pgto_agendado = ?");
                        $stmtUpdate->bindValue(1, $value['id_pgto_agendado'], PDO::PARAM_INT);
                        $stmtUpdate->execute();

                        if (!$stmtUpdate->execute()) {
                            return false;
                        } else {
                            return true;
                        }
                    }                
                }
            
            }
        } else {
            return 0;
        }

    }

}
