<?php

class CartaoModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public $numero_cartao;
    public $data_validade;
    public $fk_id_bandeira_cartao;
    public $fk_id_usuario;
    
    public function getBandeiras() {
        $stmt = $this->db->query("SELECT * FROM tb_bandeira_cartao ORDER BY bandeira ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getBancos() {
        $stmt = $this->db->query("SELECT * FROM tb_banco ORDER BY nome_banco ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCartaoByIdUser($idUser) {
        if (!empty($idUser) && is_numeric($idUser)) {
            $stmt = $this->db->prepare("SELECT cc.id_cartao_credito as id, cc.numero_cartao as num, ban.nome_banco as nome, "
                  . "cc.fk_id_usuario as iduser FROM tb_cartao_credito as cc JOIN tb_banco as ban ON (cc.fk_cod_banco = ban.cod_banco)"
                  . " WHERE cc.fk_id_usuario = ?");
            $stmt->bindValue(1, $idUser, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function cadastrarCartaoDebito($idUser,$numCartao,$dtValidade,$bandeira,$banco) {
        if (!empty($idUser) && !empty($numCartao) && !empty($dtValidade) && !empty($bandeira) && !empty($banco)) {
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("INSERT INTO tb_cartao_credito (numero_cartao, data_validade, fk_id_bandeira_cartao, "
                    . "fk_id_usuario, fk_cod_banco) VALUES (?, ?, ?, ?, ?)");
                $stmt->bindValue(1, $numCartao, PDO::PARAM_INT);
                $stmt->bindValue(2, $dtValidade, PDO::PARAM_STR);
                $stmt->bindValue(3, $bandeira, PDO::PARAM_INT);
                $stmt->bindValue(4, $idUser, PDO::PARAM_INT);
                $stmt->bindValue(5, $banco, PDO::PARAM_INT);
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
    
    
    public function cadastrarFaturaCartao($cartao, $data_pagto) {
        if (!empty($cartao) && !empty($data_pagto)) {
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("INSERT INTO tb_fatura_cartao (data_vencimento_fatura, pago, fk_id_cartao_credito) VALUES "
                      . "(?, ?, ?)");
                $stmt->bindValue(1, $data_pagto, PDO::PARAM_STR);
                $stmt->bindValue(2, "N", PDO::PARAM_STR);
                $stmt->bindValue(3, $cartao, PDO::PARAM_INT);
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

}
