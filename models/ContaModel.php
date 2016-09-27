<?php

class ContaModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function verificaConta($idUser) {
    	if (isset($idUser) && !empty($idUser)) {
			$stmt = $this->db->prepare("SELECT tb_conta.id_conta AS 'IdConta', tb_conta.codigo_agencia AS 'CodAgencia', tb_banco.nome_banco  AS 'NomeBanco', tb_conta.digito_verificador_agencia AS 'DigVerAgencia', tb_tipo_conta.tipo_conta AS 'TipoConta', tb_conta.numero_conta AS 'NumeroConta', tb_conta.digito_verificador_conta AS 'DigVerConta', tb_conta.codigo_operacao AS 'CodOperacao', date_format(tb_conta.data_cadastro, '%d/%m/%Y') AS 'DataCadastro' FROM tb_conta LEFT JOIN tb_banco ON (tb_conta.fk_cod_banco = tb_banco.cod_banco) LEFT JOIN tb_tipo_conta ON (tb_conta.fk_tipo_conta = tb_tipo_conta.id_tipo_conta) WHERE tb_conta.fk_id_usuario = ? ORDER BY tb_conta.id_conta DESC");
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
		
		$nomeBanco  = filter_var($nomeBanco);
		$codAgencia = filter_var($codAgencia);
		$tipoConta = filter_var($tipoConta);
		$numConta = filter_var($numConta);
		$digConta = filter_var($digConta);
		$idUser = filter_var($idUser);
		date_default_timezone_set('America/Sao_Paulo'); 
		$dataCadastro = date("Y-m-d H:i:s");
		
		$statement->bindParam(':codigo_agencia',  $codAgencia);
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
			$stmt->bindValue(2, "2016-06-01");
			$stmt->bindValue(3, "2016-06-31");
			$stmt->execute();	
			return $stmt->fetchAll(PDO::FETCH_ASSOC);
		}
	}
    
}    