<?php

class AgendamentoModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPgamentosAgendados() {
        $stmt = $this->db->prepare("SELECT pgto.id_pgto_agendado as id, DATE_FORMAT(pgto.data_pagamento,'%d/%m/%Y') as data_pg, 
            lower(movimentacao) as mov, Replace(concat('R$ ', Format(pgto.valor, 2)),'.',',') as valor, pgto.pago as pg, 
            cat.nome_categoria as categoria FROM tb_pgto_agendado as pgto JOIN tb_categoria as cat ON (pgto.fk_id_categoria = 
            cat.id_categoria)");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function verificaContaUsuarioLogadoExiste($idConta, $idUser) {
        if ((isset($idConta) && !empty($idConta)) && (isset($idUser) && !empty($idUser))) {
            $stmt = $this->db->prepare("SELECT id_conta as idConta, fk_id_usuario as idUser FROM conta.tb_conta WHERE id_conta = ?"
                . " AND fk_id_usuario = ?");
            $stmt->bindValue(1, $idConta, PDO::PARAM_INT);
            $stmt->bindValue(2, $idUser, PDO::PARAM_INT);
            $stmt->execute();
            print_r($stmt->fetch(PDO::FETCH_ASSOC));exit;
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
    }
}
