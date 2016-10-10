SELECT 
	Ext.movimentacao AS 'mov',
    Ext.mes AS 'mes',
    extract(year from ext.data_movimentacao) AS 'ano',
    SUM(Ext.valor) AS 'val',
    Cat.nome_categoria AS 'cat'    
FROM
    tb_extrato AS ext
        LEFT JOIN
    tb_categoria AS cat ON (ext.fk_id_categoria = cat.id_categoria)
WHERE
    ext.fk_id_conta = 1
        AND ext.movimentacao LIKE '%Gasolina%'
        AND ext.data_movimentacao BETWEEN '2016-01-01' AND '2016-12-31'
        AND ext.fk_id_conta = 1
GROUP BY ext.mes
ORDER BY ext.data_movimentacao;
 
SELECT ext.movimentacao AS 'mov', ext.mes AS 'mes', extract(year from ext.data_movimentacao) AS 'ano', ext.valor AS 'val' 
FROM tb_categoria AS cat 
JOIN tb_extrato AS ext ON (cat.id_categoria = ext.fk_id_categoria)
AND cat.nome_categoria LIKE '%Cartões%' AND ext.data_movimentacao BETWEEN '2016-01-01' AND '2016-03-31'
ORDER BY ext.data_movimentacao;

SELECT SUM(valor) AS 'val' FROM tb_extrato WHERE data_movimentacao BETWEEN '2016-01-01' AND '2016-01-31' AND movimentacao LIKE '%Gasolina%';

SELECT DISTINCT movimentacao FROM tb_extrato ORDER BY movimentacao ASC ;
 

 
