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
    
    public function pagarFatura($array, $idFaturaCartao = null) {
        if (isset($array) && $idFaturaCartao != null) {
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("UPDATE conta.tb_fatura_cartao SET encargos = ?, protecao_premiada = ?,"
                    . " iof = ?, anuidade = ?, restante_fatura_anterior = ?, pago = ?, juros = ?, valor_total_fatura = ?,"
                    . "valor_pago = ? WHERE id_fatura_cartao = ?");
                $stmt->bindValue(1, !empty($array['encargos']) ? $array['encargos'] : 0.00, PDO::PARAM_INT);
                $stmt->bindValue(2, !empty($array['protecao']) ? $array['protecao'] : 0.00, PDO::PARAM_INT);
                $stmt->bindValue(3, !empty($array['iof']) ? $array['iof'] : 0.00, PDO::PARAM_INT);
                $stmt->bindValue(4, !empty($array['anuidade']) ? $array['anuidade'] : 0.00, PDO::PARAM_INT);
                $stmt->bindValue(5, !empty($array['restante']) ? $array['restante'] : null, PDO::PARAM_INT);
                $stmt->bindValue(6, 'S', PDO::PARAM_STR);
                $stmt->bindValue(7, !empty($array['juros']) ? $array['juros'] : null, PDO::PARAM_INT);
                $stmt->bindValue(8, !empty($array['totalgeral']) ? $array['totalgeral'] : null, PDO::PARAM_INT);
                $stmt->bindValue(9, !empty($array['valor_pagar']) ? $array['valor_pagar'] : null, PDO::PARAM_INT);
                $stmt->bindValue(10, $idFaturaCartao, PDO::PARAM_INT);
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
    
    public function getCartaoByDataPgtoFatura() {
        $stmt = $this->db->query("SELECT fat.id_fatura_cartao as id, DATE_FORMAT(fat.data_vencimento_fatura,'%d/%m/%Y') as data,"
            . " car.numero_cartao as num, band.bandeira as bandeira, ban.nome_banco as nome, fat.fk_id_cartao_credito as cardid"
            . " FROM tb_fatura_cartao as fat JOIN tb_cartao_credito as car ON (fat.fk_id_cartao_credito = "
            . "car.id_cartao_credito) JOIN tb_banco as ban ON (ban.cod_banco = car.fk_cod_banco) JOIN tb_bandeira_cartao as "
            . "band ON (band.id_bandeira_cartao = car.fk_id_bandeira_cartao) WHERE fat.pago = 'N'");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getFaturaByIdConsulta($idUser) {
        if (!empty($idUser) && is_numeric($idUser)) {
            $stmt = $this->db->prepare("SELECT fat.id_fatura_cartao as id, cc.numero_cartao as num, DATE_FORMAT"
                  . "(fat.data_vencimento_fatura,'%d/%m/%Y') as data, ban.bandeira as band, bc.nome_banco as nome FROM tb_fatura_cartao "
                  . "as fat JOIN tb_cartao_credito as cc ON (fat.fk_id_cartao_credito = cc.id_cartao_credito) JOIN "
                  . "tb_bandeira_cartao as ban ON (ban.id_bandeira_cartao = cc.fk_id_bandeira_cartao) JOIN tb_banco as bc "
                  . "ON (bc.cod_banco = cc.fk_cod_banco) WHERE cc.fk_id_usuario = 1 ORDER BY fat.id_fatura_cartao, "
                  . "fat.data_vencimento_fatura ASC");
            $stmt->bindValue(1, $idUser, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getValorFaturaMesAnterior($idCart) {
        if (!empty($idCart) && is_numeric($idCart)) {
            $mesAtual = $this->verificaMesNumerico();
            if ($mesAtual == 12) {
                $mesAnterior = $mesAtual - 11;
            } else {
                $mesAnterior = $mesAtual - 1;
            }
            $anoMes = "2017-$mesAnterior";
            
            $stmt = $this->db->prepare("SELECT valor_total_fatura as valtotal, valor_pago as valpgo FROM conta.tb_fatura_cartao "
                  . "WHERE fk_id_cartao_credito = ? AND ano_mes_ref = ?");
            $stmt->bindValue(1, $idCart, PDO::PARAM_INT);
            $stmt->bindValue(2, $anoMes, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function getFaturaById($idFaturaCartao, $idUser = null) {
        if ((isset($idFaturaCartao) && is_numeric($idFaturaCartao)) && (isset($idUser) && is_numeric($idUser))) {
            $stmt = $this->db->prepare("SELECT fat.id_fatura_cartao as id, car.numero_cartao as num, "
                  . "DATE_FORMAT(fat.data_vencimento_fatura,'%d/%m/%Y') as data, band.bandeira as bandeira, "
                  . "ban.nome_banco as nome, fat.encargos as encargos, fat.protecao_premiada as protecao, fat.anuidade as anuidade,"
                  . "fat.restante_fatura_anterior as restante, fat.valor_total_fatura as valor_total, car.id_cartao_credito as idCartao FROM tb_fatura_cartao as fat "
                  . "JOIN tb_cartao_credito as car ON (fat.fk_id_cartao_credito = car.id_cartao_credito) JOIN tb_banco as ban ON "
                  . "(ban.cod_banco = car.fk_cod_banco) JOIN tb_bandeira_cartao as band ON (band.id_bandeira_cartao = "
                  . "car.fk_id_bandeira_cartao) WHERE fat.pago = 'N' AND fat.id_fatura_cartao = ? AND car.fk_id_usuario = ?");
            $stmt->bindValue(1, $idFaturaCartao, PDO::PARAM_INT);
            $stmt->bindValue(2, $idUser, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } elseif (isset($idFaturaCartao) && is_numeric($idFaturaCartao)) {
            $stmt = $this->db->prepare("SELECT fat.id_fatura_cartao as id, car.numero_cartao as num, "
                  . "DATE_FORMAT(fat.data_vencimento_fatura,'%d/%m/%Y') as data, band.bandeira as bandeira, ban.nome_banco "
                  . "as nome, fat.encargos as encargos, fat.iof as iof, fat.protecao_premiada as protecao, fat.juros as juros, "
                  . "fat.anuidade as anuidade, fat.restante_fatura_anterior as restante, fat.valor_total_fatura as valor_total, "
                  . "fat.valor_pago as val_pgo FROM tb_fatura_cartao as fat JOIN tb_cartao_credito as car ON "
                  . "(fat.fk_id_cartao_credito = car.id_cartao_credito) JOIN tb_banco as ban ON (ban.cod_banco = "
                  . "car.fk_cod_banco) JOIN tb_bandeira_cartao as band ON (band.id_bandeira_cartao = car.fk_id_bandeira_cartao) "
                  . "WHERE fat.id_fatura_cartao = ?");
            $stmt->bindValue(1, $idFaturaCartao, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        
    }
    
    public function getItensDespesaFaturaByIdFaturaCartao($idFaturaCartao) {
        if (!empty($idFaturaCartao)) {
            $stmt = $this->db->prepare("SELECT idf.data_compra as data, df.descricao as descricao, idf.parcela as parcela, 
                idf.valor_compra as valor FROM tb_item_despesa_fatura as idf JOIN tb_despesa_fatura as df ON 
                (idf.fk_id_despesa_fatura = df.id_despesa_fatura) JOIN tb_fatura_cartao as fc ON 
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
            $anoMes = ConstructHelper::transformaAnoMes($data_pagto);
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("INSERT INTO tb_fatura_cartao (data_vencimento_fatura, pago, fk_id_cartao_credito, "
                    . "ano_mes_ref) VALUES (?, ?, ?, ?)");
                $stmt->bindValue(1, $data_pagto, PDO::PARAM_STR);
                $stmt->bindValue(2, "N", PDO::PARAM_STR);
                $stmt->bindValue(3, $cartao, PDO::PARAM_INT);
                $stmt->bindValue(4, $anoMes, PDO::PARAM_STR);
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
    
    public function agendarPagamento($idFaturaCartao, $idConta) {
        if (!empty($idFaturaCartao) && !empty($idConta)) {
            $dados = array();
            date_default_timezone_set('America/Sao_Paulo');
            $ano = date("Y");
            $mes = date("m");
            $dataPagamento = "{$ano}-{$mes}-08";
                $stmt = $this->db->prepare("SELECT valor_pago, fk_id_cartao_credito FROM tb_fatura_cartao WHERE id_fatura_cartao = ?");
                $stmt->bindValue(1, $idFaturaCartao, PDO::PARAM_INT);
                $stmt->execute();
                $dados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($dados[0]['fk_id_cartao_credito'] == 1) {
                $movPgto = 'CARTÃO VOTORANTIM';
            } elseif ($dados[0]['fk_id_cartao_credito'] == 2) {
                $movPgto = 'CARTÃO CEF';
            }
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("INSERT INTO tb_pgto_agendado (data_pagamento, movimentacao, valor, pago, "
                    ."fk_id_categoria, fk_id_conta) VALUES (?, ?, ?, ?, ?, ?)");
                $stmt->bindValue(1, $dataPagamento, PDO::PARAM_STR);
                $stmt->bindValue(2, $movPgto, PDO::PARAM_STR);
                $stmt->bindValue(3, $dados[0]['valor_pago'], PDO::PARAM_STR);
                $stmt->bindValue(4, 'Não', PDO::PARAM_STR);
                $stmt->bindValue(5, 6, PDO::PARAM_INT);
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


    public function verificaMesNumerico() {
        date_default_timezone_set('America/Sao_Paulo');
        $mesAtual = date("m");
        switch ($mesAtual) {
            case '01':
                $mesAtual = 1;
                break;
            case '02':
                $mesAtual = 2;
                break;
            case '03':
                $mesAtual = 3;
                break;
            case '04':
                $mesAtual = 4;
                break;
            case '05':
                $mesAtual = 5;
                break;
            case '06':
                $mesAtual = 6;
                break;
            case '07':
                $mesAtual = 7;
                break;
            case '08':
                $mesAtual = 8;
                break;
            case '09':
                $mesAtual = 9;
                break;
            case '10':
                $mesAtual = 10;
                break;
            case '11':
                $mesAtual = 11;
                break;
            case '12':
                $mesAtual = 12;
                break;
        }
        return $mesAtual;
    }

}
