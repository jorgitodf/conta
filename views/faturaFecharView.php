
<aside class="container col-sm-12 col-lg-12">
    <div class="row-fluid col-sm-10 col-md-10 col-lg-10" id="div_row_form_fecha_fatura_cartao_credito">
        <form method="POST" action="/cartao/fecharfatura" id="form_buscar_fatura_fechar" >
            <div class="panel panel-primary" id="">
                <div class="panel-heading">
                    <h3 class="panel-title">Fechamento de Fatura de Cartão de Crédito para Pagamento</h3>
                </div>
                <div class="panel-body" id="panel_body_fatura"> 
                    <?php if (!isset($fatura)): ?>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <label for="cartao_fat" class="control-label">Cartão de Crédito / Data de Pagamento:</label>
                            <select class="form-control input-sm" name="cartao_fat" id="cartao_fat">
                                <option></option>
                                <?php foreach ($cartao as $value): ?> 
                                    <option value="<?php echo $value['id']; ?>">Data de Vencimento: <?php echo $value['data']; ?> - <?php echo wordwrap($value['num'], 4, '.', true); ?> - <?php echo $value['bandeira']; ?> - <?php echo $value['nome']; ?></option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <button type="submit" id="btn_fechar_fatura_buscar" class="btn btn-primary">Buscar</button>
                        </div>
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="div_msgs_error_lan_fatura">
                            <div class="retorno"></div>
                        </div>
                    </div>
                    <?php else: ?>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-3 col-md-3 col-lg-3" id="">
                            <label for="num_cartao" class="control-label">Número do Cartão:</label>
                            <input type="text" name="num_cartao" id="num_cartao" class="form-control input-sm" readonly="true" value="<?php echo $fatura[0]['num']; ?>"/>
                        </div>
                        <div class="form-group form-group-sm col-sm-3 col-md-3 col-lg-3" id="">
                            <label for="nome_banco" class="control-label">Banco:</label>
                            <input type="text" name="nome_banco" id="nome_banco" class="form-control input-sm" readonly="true" value="<?php echo $fatura[0]['nome']; ?>"/>
                        </div>
                        <div class="form-group form-group-sm col-sm-3 col-md-3 col-lg-3" id="">
                            <label for="nome_bandeira" class="control-label">Bandeira:</label>
                            <input type="text" name="nome_bandeira" id="nome_bandeira" class="form-control input-sm" readonly="true" value="<?php echo $fatura[0]['bandeira']; ?>"/>
                        </div>
                        <div class="form-group form-group-sm col-sm-3 col-md-3 col-lg-3" id="">
                            <label for="dt_vencimento" class="control-label">Data de Vencimento:</label>
                            <input type="text" name="dt_vencimento" id="dt_vencimento" class="form-control input-sm" readonly="true" value="<?php echo $fatura[0]['data']; ?>"/>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
            </div>    
        </form>
    </div>
</aside>