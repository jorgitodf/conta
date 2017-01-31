CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `vw_extrato` AS select `ext`.`data_movimentacao` AS `DatMov`,`ext`.`movimentacao` AS `Mov`,`cat`.`nome_categoria` AS `Cat`,`ext`.`tipo_operacao` AS `Op`,`ext`.`valor` AS `Val`,`ext`.`saldo` AS `Sal`,`ext`.`despesa_fixa` AS `Dp`,`ext`.`fk_id_conta` AS `idconta` from (`tb_extrato` `ext` join `tb_categoria` `cat` on((`ext`.`fk_id_categoria` = `cat`.`id_categoria`)));