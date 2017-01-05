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
    
    public function getCartaoByDataPgtoFatura($idCartao = null, $idUser = null) {
        if ($idCartao == null && $idUser == null) {
            $stmt = $this->db->query("SELECT fat.id_fatura_cartao as id, DATE_FORMAT(fat.data_vencimento_fatura,'%d/%m/%Y') as data, 
                car.numero_cartao as num, band.bandeira as bandeira, ban.nome_banco as nome FROM tb_fatura_cartao as fat JOIN 
                tb_cartao_credito as car ON (fat.fk_id_cartao_credito = car.id_cartao_credito) JOIN tb_banco as ban ON (ban.cod_banco = 
                car.fk_cod_banco) JOIN tb_bandeira_cartao as band ON (band.id_bandeira_cartao = car.fk_id_bandeira_cartao) WHERE fat.pago
                = 'N'");
        } else {
            $stmt = $this->db->prepare("SELECT fat.id_fatura_cartao as id, car.numero_cartao as num, "
                . "DATE_FORMAT(fat.data_vencimento_fatura,'%d/%m/%Y') as data, band.bandeira as bandeira, ban.nome_banco as nome, "
                . "fat.encargos as encargos, fat.protecao_premiada as protecao, fat.anuidade as anuidade, "
                . "fat.restante_fatura_anterior as restante, fat.valor_total_fatura as valor_total FROM tb_fatura_cartao as fat "
                . "JOIN tb_cartao_credito as car ON (fat.fk_id_cartao_credito = car.id_cartao_credito) JOIN tb_banco as ban "
                . "ON (ban.cod_banco = car.fk_cod_banco) JOIN tb_bandeira_cartao as band ON (band.id_bandeira_cartao = "
                . "car.fk_id_bandeira_cartao) WHERE fat.pago = 'N' AND fat.fk_id_cartao_credito = ? AND car.fk_id_usuario = ?");
            $stmt->bindValue(1, $idCartao, PDO::PARAM_INT);
            $stmt->bindValue(2, $idUser, PDO::PARAM_INT);
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getItensDespesaFaturaByIdFaturaCartao($idFaturaCartao) {
        if (!empty($idFaturaCartao)) {
            $stmt = $this->db->prepare("SELECT idf.data_compra as data, df.descricao as descricao, idf.parcela as parcela, 
                idf.valor_compra as valor FROM tb_item_despesa_fatura as idf LEFT JOIN tb_despesa_fatura as df ON 
                (idf.fk_id_despesa_fatura = df.id_despesa_fatura) LEFT JOIN tb_fatura_cartao as fc ON 
                (idf.fk_id_fatura_cartao = fc.id_fatura_cartao) AND idf.fk_id_fatura_cartao = ?");
            $stmt->bindValue(1, $idFaturaCartao, PDO::PARAM_INT);
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
    
    public function cadastrarDespesaFaturaCartaoCredito($idFaturaCartao,$descricao,$dtCompra,$valor,$parcela) {
        if (!empty($idFaturaCartao) && !empty($descricao) && !empty($dtCompra) && !empty($valor) && isset($parcela)) {
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("INSERT INTO tb_despesa_fatura (descricao) VALUES (?)");
                $stmt->bindValue(1, $descricao, PDO::PARAM_STR);
                $stmt->execute();
                $idDespesa = $this->db->lastInsertId();
                
                $stmt = $this->db->prepare("INSERT INTO tb_item_despesa_fatura (data_compra, valor_compra, parcela, fk_id_despesa_fatura,"
                    . " fk_id_fatura_cartao) VALUES (?, ?, ?, ?, ?)");
                $stmt->bindValue(1, $dtCompra, PDO::PARAM_STR);
                $stmt->bindValue(2, $valor, PDO::PARAM_INT);
                $stmt->bindValue(3, !empty($parcela) ? $parcela : null, PDO::PARAM_STR);
                $stmt->bindValue(4, $idDespesa, PDO::PARAM_INT);
                $stmt->bindValue(5, $idFaturaCartao, PDO::PARAM_INT);
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
