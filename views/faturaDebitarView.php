
<aside class="container col-sm-12 col-lg-12">
    <div class="row-fluid col-sm-6 col-md-6 col-lg-6" id="div_row_form_deb_fatura_cartao_credito">
        <form method="POST" action="/cartao/debitarfatura" id="form_deb_fatura_cartao_credito" >
            <div class="panel panel-primary" id="div_panel_form_deb_fatura_carta_credito">
                <div class="panel-heading">
                    <h3 class="panel-title">Lançamento de Débito em Fatura de Cartão de Crédito</h3>
                </div>
                <div class="panel-body" id="panel_body_fatura"> 
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <label for="cartao_fat" class="control-label">Cartão de Crédito / Data de Pagamento:</label>
                            <select class="form-control input-sm" name="cartao_fat" id="cartao_fat" disabled="disabled">
                                <option></option>
                                <?php foreach ($cartao as $value): ?> 
                                    <option value="<?php echo $value['id']; ?>">Data de Vencimento: <?php echo $value['data']; ?> - <?php echo wordwrap($value['num'], 4, '.', true); ?> - <?php echo $value['bandeira']; ?> - <?php echo $value['nome']; ?></option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-5 col-md-5 col-lg-5" id="">
                            <label for="data_compra" class="control-label">Data da Compra:</label>
                            <input type="date" name="data_compra" id="data_compra" class="form-control input-sm" disabled/>
                        </div>
                        <div class="form-group form-group-sm col-sm-7 col-md-7 col-lg-7" id="">
                            <label for="descricao" class="control-label">Descrição:</label>
                            <input type="text" name="descricao" id="descricao" class="form-control input-sm" disabled/>
                        </div>
                    </div> 
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-5 col-md-5 col-lg-5" id="">
                            <label for="valor_compra_fatura" class="control-label">Valor da Compra:</label>
                            <input type="text" name="valor_compra_fatura" id="valor_compra_fatura" class="form-control input-sm" disabled/>
                        </div>
                        <div class="form-group form-group-sm col-sm-7 col-md-7 col-lg-7" id="">
                            <label for="parcela" class="control-label">Parcela:</label>
                            <input type="text" name="parcela" id="parcela" class="form-control input-sm" disabled/>
                        </div>
                    </div><div class="both"></div><br/>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <button type="button" id="btn_nova_lanc_fatura" class="btn btn-primary">Novo</button>
                            <button type="submit" id="btn_salvar_novo_lanc_fatura" class="btn btn-primary" disabled>Salvar</button>
                        </div>
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="div_msgs_error_lan_fatura">
                            <div class="retorno"></div>
                        </div>
                    </div>
                </div>
            </div>    
        </form>
    </div>
</aside>