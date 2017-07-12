DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `fncTraduzDiaSemana`(data_movimentacao VARCHAR(10)) RETURNS varchar(14) CHARSET utf8
BEGIN
	DECLARE dia_semana varchar(14);
	IF data_movimentacao = 'Sunday ' THEN
		SET dia_semana = 'Domingo';
    ELSEIF data_movimentacao = 'Monday ' THEN   
		SET dia_semana = 'Segunda-Feira';
    ELSEIF data_movimentacao = 'Tuesday ' THEN   
		SET dia_semana = 'Terça-Feira';
    ELSEIF data_movimentacao = 'Wednesday ' THEN   
		SET dia_semana = 'Quarta-Feira';
    ELSEIF data_movimentacao = 'Thursday ' THEN   
		SET dia_semana = 'Quinta-Feira';
    ELSEIF data_movimentacao = 'Friday ' THEN   
		SET dia_semana = 'Sexta-Feira';
    ELSE
		SET dia_semana = 'Sábado';        
	END IF;
RETURN dia_semana;
END$$
DELIMITER ;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` FUNCTION `fncSubtracao`(valor1 DECIMAL(10,2), valor2 DECIMAL(10,2)) RETURNS decimal(10,2)
BEGIN
	DECLARE total DECIMAL(10,2);
    SET total = 0;
	SET total = valor1 - valor2;
	RETURN total;
END$$
DELIMITER ;

