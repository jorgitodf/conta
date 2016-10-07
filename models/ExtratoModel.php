<?php

class ExtratoModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function verExtratoPeriodo($id_conta, $data_inicial, $data_final) {
        if ((isset($id_conta) && !empty($id_conta)) && (isset($data_inicial) && !empty($data_inicial)) && (isset($data_final) && !empty($data_final))) {
            $stmt = $this->db->prepare("SELECT Ext.data_movimentacao AS 'DatMov', Ext.movimentacao AS 'Mov', Cat.nome_categoria "
                  . "AS 'Cat', Ext.tipo_operacao AS 'Op', Ext.valor AS 'Val', Ext.saldo AS 'Sal', Ext.despesa_fixa AS 'Dp' FROM "
                  . "tb_extrato AS Ext LEFT JOIN tb_categoria AS Cat ON (Ext.fk_id_categoria = Cat.id_categoria) WHERE "
                  . "Ext.fk_id_conta = ? AND Ext.data_movimentacao BETWEEN ? AND ?");
            $stmt->bindValue(1, $id_conta, PDO::PARAM_INT);
            $stmt->bindValue(2, $data_inicial, PDO::PARAM_STR);
            $stmt->bindValue(3, $data_final, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
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

}
