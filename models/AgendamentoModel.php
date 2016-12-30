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

}
