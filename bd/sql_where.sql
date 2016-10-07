SELECT Ext.mes, Ext.movimentacao AS 'Mov', Cat.nome_categoria AS 'Cat', Ext.tipo_operacao AS 'Op', SUM(Ext.valor) AS 'Val'
 FROM tb_extrato AS Ext
 LEFT JOIN tb_categoria AS Cat
 ON (Ext.fk_id_categoria = Cat.id_categoria)
 WHERE Ext.fk_id_conta = 1 AND Ext.movimentacao LIKE '%Gasolina' 
 AND Ext.data_movimentacao BETWEEN '2012-01-01' AND '2012-12-31' 
 GROUP BY Ext.mes ORDER BY Ext.id_extrato;
 
 SELECT Ext.mes, Ext.movimentacao AS 'Mov', Cat.nome_categoria AS 'Cat', Ext.tipo_operacao AS 'Op', Ext.valor AS 'Val', 
Ext.saldo AS 'Sal', Ext.despesa_fixa AS 'Dp'
 FROM tb_extrato AS Ext
 LEFT JOIN tb_categoria AS Cat
 ON (Ext.fk_id_categoria = Cat.id_categoria)
 WHERE Ext.fk_id_conta = 1 AND Ext.movimentacao LIKE 'Gasolina' 
 AND Ext.data_movimentacao BETWEEN '2012-01-01' AND '2012-12-31' 
 GROUP BY Ext.mes;
 
SELECT Ext.data_movimentacao AS 'DatMov', Ext.movimentacao AS 'Mov', Cat.nome_categoria AS 'Cat', Ext.tipo_operacao AS 'Op', Ext.valor AS 'Val', 
Ext.saldo AS 'Sal', Ext.despesa_fixa AS 'Dp'
 FROM tb_extrato AS Ext, tb_categoria AS Cat
 WHERE Ext.fk_id_categoria = Cat.id_categoria
 AND Ext.fk_id_conta = 1 AND Ext.data_movimentacao BETWEEN '2012-01-01' AND '2016-01-31';
 
SHOW INDEX FROM tb_extrato;

SHOW INDEX FROM tb_categoria;