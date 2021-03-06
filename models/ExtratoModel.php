<?php

class ExtratoModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function verExtratoPeriodo($id_conta, $data_inicial, $data_final) {
        if ((isset($id_conta) && !empty($id_conta)) && (isset($data_inicial) && !empty($data_inicial)) && (isset($data_final) && !empty($data_final))) {
            $stmt = $this->db->prepare("SELECT * FROM conta.vw_extrato AS ext WHERE ext.idconta = ? "
                  . "AND ext.DatMov BETWEEN ? AND ?");
            $stmt->bindValue(1, $id_conta, PDO::PARAM_INT);
            $stmt->bindValue(2, $data_inicial, PDO::PARAM_STR);
            $stmt->bindValue(3, $data_final, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    public function listarConsultaGastosPorPeriodo($dataInicial, $dataFinal, $idConta) {
        if (!empty($dataInicial) && !empty($dataFinal) && !empty($idConta)) {
            try {
                $stmt = $this->db->prepare("SELECT DATE_FORMAT(data_movimentacao,'%d/%m/%Y') as data, "
                      . "fncTraduzDiaSemana(DATE_FORMAT(data_movimentacao,'%W')) as dia, movimentacao as mov, valor as val "
                      . "FROM tb_extrato WHERE data_movimentacao BETWEEN ? AND ? AND fk_id_conta = ?");
                $stmt->bindValue(1, $dataInicial, PDO::PARAM_STR);
                $stmt->bindValue(2, $dataFinal, PDO::PARAM_STR);
                $stmt->bindValue(3, $idConta, PDO::PARAM_INT);
                $stmt->execute();
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
                $stmt->closeCursor();
                return $result;
            } catch (PDOException $exc) {
                throw new Exception('ERRO: '.$exc->getMessage());
                return false;
            }
        } else {
            throw new Exception("ERRO: Possui dados vazios.");
            return false;
        }
    }
          
    
    public function listarMovimentacaoPeriodo($data) {
        if (isset($data) && !empty($data)) {
            $stmt = $this->db->prepare("SELECT ext.movimentacao AS 'mov', ext.mes AS 'mes', extract(year from ext.data_movimentacao) "
                  . "AS 'ano', SUM(ext.valor) AS 'val', cat.nome_categoria AS 'cat' FROM tb_extrato AS ext LEFT JOIN tb_categoria"
                  . " AS cat ON (ext.fk_id_categoria = cat.id_categoria) WHERE ext.fk_id_conta = ? AND ext.movimentacao LIKE "
                  . "? AND ext.data_movimentacao BETWEEN ? AND ? GROUP BY ext.mes ORDER BY ext.data_movimentacao");
            $movimentacao = "%{$data['movimentacao']}%";
            $stmt->bindValue(1, $data['idConta'], PDO::PARAM_INT);
            $stmt->bindValue(2, $movimentacao, PDO::PARAM_STR);
            $stmt->bindValue(3, $data['dataInicial'], PDO::PARAM_STR);
            $stmt->bindValue(4, $data['dataFinal'], PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }
    
    public function listarRelatorioGeralGasto($movimentacao, $idConta) {
        $dados = array();
        if ((isset($movimentacao) && !empty($movimentacao)) && (isset($idConta) && !empty($idConta))) {
            foreach ($this->listarAnoExtrato() as $value) {
                $stmt = $this->db->prepare("SELECT ext.mes AS 'mes', extract(year from ext.data_movimentacao) AS 'ano', SUM(ext.valor)"
                    . " AS 'val' FROM tb_extrato AS ext LEFT JOIN tb_categoria AS cat ON (ext.fk_id_categoria = cat.id_categoria)"
                    . " WHERE ext.fk_id_conta = ? AND ext.movimentacao LIKE ? AND ext.data_movimentacao "
                    . "BETWEEN '{$value['ano']}-01-01' AND '{$value['ano']}-12-31' GROUP BY ext.mes ORDER BY ext.data_movimentacao");
                $movimentacao = "%{$movimentacao}%";
                $stmt->bindValue(1, $idConta, PDO::PARAM_INT);
                $stmt->bindValue(2, $movimentacao, PDO::PARAM_STR);
                $stmt->execute();
                $dados["ano{$value['ano']}"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        return $dados;
        }
    }
    
    public function listarRelatorioGastoPorCategoria($categoria, $idUser, $idConta, $ano) {
        $dados = array();
        if ((isset($categoria) && !empty($categoria)) && (isset($idUser) && !empty($idUser)) && 
                (isset($idConta) && !empty($idConta)) && (isset($ano) && !empty($ano))) {
            foreach ($this->listarMesAno() as $value) {
                $stmt = $this->db->prepare("SELECT DATE_FORMAT(ext.data_movimentacao, '%d/%m/%Y') as data, ext.movimentacao as mov,"
                    . " ext.valor as val, cat.nome_categoria as cat FROM tb_extrato as ext JOIN tb_categoria as cat ON "
                    . "(ext.fk_id_categoria = cat.id_categoria) WHERE ext.fk_id_conta = ? AND cat.id_categoria = ? AND "
                    . "ext.data_movimentacao BETWEEN '{$ano}-{$value['mes_num']}-01' AND '{$ano}-{$value['mes_num']}-31' ORDER BY ext.data_movimentacao");
                $stmt->bindValue(1, $idConta, PDO::PARAM_INT);
                $stmt->bindValue(2, $categoria, PDO::PARAM_INT);
                $stmt->execute();
                $dados["{$value['mes_nome']}{$ano}"] = $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        return $dados;    
        }
    }


    public function listarAnoExtrato() {
        $stmt = $this->db->prepare("SELECT distinct extract(year from data_movimentacao) AS 'ano' FROM tb_extrato ORDER BY ano ASC");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function listarMesAno() {
        $stmt = $this->db->prepare("SELECT mes_num, mes_nome FROM tb_mes");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
