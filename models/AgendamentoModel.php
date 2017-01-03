<?php

class AgendamentoModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getAllPgamentosAgendados($offset) {
        $stmt = $this->db->prepare("SELECT pgto.id_pgto_agendado as id, DATE_FORMAT(pgto.data_pagamento,'%d/%m/%Y') as data_pg, 
            lower(movimentacao) as mov, Replace(concat('R$ ', Format(pgto.valor, 2)),'.',',') as valor, pgto.pago as pg, 
            cat.nome_categoria as categoria FROM tb_pgto_agendado as pgto JOIN tb_categoria as cat ON (pgto.fk_id_categoria = 
            cat.id_categoria) ORDER BY pgto.data_pagamento ASC LIMIT $offset, 15");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getPagamentoAgendado($id) {
        if (!empty($id)) {
            $stmt = $this->db->prepare("SELECT * FROM tb_pgto_agendado WHERE id_pgto_agendado = ?");
            $stmt->bindValue(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    public function verificaContaUsuarioLogadoExiste($idConta, $idUser) {
        if ((isset($idConta) && !empty($idConta)) && (isset($idUser) && !empty($idUser))) {
            $stmt = $this->db->prepare("SELECT id_conta as idConta, fk_id_usuario as idUser FROM conta.tb_conta WHERE id_conta = ?"
                . " AND fk_id_usuario = ?");
            $stmt->bindValue(1, $idConta, PDO::PARAM_INT);
            $stmt->bindValue(2, $idUser, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
        
    }
    
    public function alterarPgtoAgendado($idConta,$idPgtoAgendado,$dtPgto,$movPgto,$categoriaPgto,$valorPgto) {
        if (!empty($idConta) && !empty($idPgtoAgendado) && !empty($dtPgto) && !empty($movPgto) && !empty($categoriaPgto) && !empty($valorPgto)) {
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("UPDATE tb_pgto_agendado SET data_pagamento = ?, movimentacao = ?,"
                    . " valor = ?, fk_id_categoria = ?, fk_id_conta = ? WHERE id_pgto_agendado = ?");
                $stmt->bindValue(1, $dtPgto, PDO::PARAM_STR);
                $stmt->bindValue(2, $movPgto, PDO::PARAM_STR);
                $stmt->bindValue(3, $valorPgto, PDO::PARAM_INT);
                $stmt->bindValue(4, (int)$categoriaPgto, PDO::PARAM_INT);
                $stmt->bindValue(5, (int)$idConta, PDO::PARAM_INT);
                $stmt->bindValue(6, (int)$idPgtoAgendado, PDO::PARAM_INT);
                $stmt->execute();
                $this->db->commit();
                return true;
            } catch (PDOException $exc) {
                $this->db->rollback();
                throw new Exception('ERRO: '.$exc->getMessage());
                return false;
            }
        } else {
            throw new Exception("ERRO: Possui dados vazios.");
            return false;
        }
    }
    
    public function cadastrarPgtoAgendado($idConta,$dtPgto,$movPgto,$categoriaPgto,$valorPgto) {
        if (!empty($idConta) && !empty($dtPgto) && !empty($movPgto) && !empty($categoriaPgto) && !empty($valorPgto)) {
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("INSERT INTO tb_pgto_agendado (data_pagamento, movimentacao, valor, pago, "
                    ."fk_id_categoria, fk_id_conta) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bindValue(1, $dtPgto, PDO::PARAM_STR);
                $stmt->bindValue(2, $movPgto, PDO::PARAM_STR);
                $stmt->bindValue(3, $valorPgto, PDO::PARAM_STR);
                $stmt->bindValue(4, 'Não', PDO::PARAM_STR);
                $stmt->bindValue(5, $categoriaPgto, PDO::PARAM_INT);
                $stmt->bindValue(6, $idConta, PDO::PARAM_INT);
                $stmt->execute();
                $this->db->commit();
                return true;
            } catch (PDOException $exc) {
                $this->db->rollback();
                throw new Exception('ERRO: '.$exc->getMessage());
                return false;
            }
        } else {
            throw new Exception("ERRO: Possui dados vazios.");
            return false;
        }
    }
    
    public function deletarPgtoAgendado($id) {
        if (!empty($id)) {
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("DELETE FROM tb_pgto_agendado WHERE id_pgto_agendado = ?");
                $stmt->bindValue(1, $id, PDO::PARAM_STR);
                $stmt->execute();
                $this->db->commit();
                return true;
            } catch (PDOException $exc) {
                $this->db->rollback();
                printf($exc);
                return false;
            }
        }
        
    }
    
    public function getCount() {
        $r = 0;
        $stmt = $this->db->prepare("SELECT COUNT(*) as c FROM tb_pgto_agendado");
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        $r = $row['c'];
        return $r;
    }
}
