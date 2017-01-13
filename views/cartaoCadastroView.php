
<aside class="container col-sm-12 col-md-12 col-lg-12">
    <div class="row-fluid" id="div_row_form_cad_carta_credito">
        <form method="POST" action="" id="form_cadastro_cartao_credito" >
            <div class="panel panel-primary" id="div_panel_form_cad_carta_credito">
                <div class="panel-heading">
                    <h3 class="panel-title">Cadastro de Cartão de Crédito</h3>
                </div>
                <div class="panel-body">	
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-6 col-lg-6" id="div_num_cartao">
                            <label for="num_cartao" class="control-label">Número do Cartão:</label>
                            <input type="text" name="num_cartao" id="num_cartao" disabled="disabled" class="form-control input-sm"/>
                        </div> 
                        <div class="form-group form-group-sm col-sm-6 col-lg-6" id="div_data_validade">
                            <label for="data_validade" class="control-label">Data de Validade:</label>
                            <input type="text" name="data_validade" id="data_validade" disabled="disabled" class="form-control input-sm" placeholder="MM/AAAA"/>
                        </div>
                        <div class="both"></div>
                        <input type="hidden" name="idUser" value="<?php echo $idUser; ?>"/>
                    </div>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-6 col-lg-6" id="">
                            <label for="bandeira" class="control-label">Bandeira:</label>
                            <select class="form-control input-sm" name="bandeira" disabled="disabled" id="bandeira" >
                                <option></option>
                                <?php foreach ($bandeiras as $value): ?> 
                                    <option value="<?php echo $value['id_bandeira_cartao']; ?>"><?php echo $value['bandeira']; ?> </option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                        <div class="form-group form-group-sm col-sm-6 col-lg-6" id="">
                            <label for="banco" class="control-label">Banco:</label>
                            <select class="form-control input-sm" name="banco" disabled="disabled" id="banco" >
                                <option></option>
                                <?php foreach ($bancos as $value): ?> 
                                    <option value="<?php echo $value['cod_banco']; ?>"><?php echo $value['nome_banco']; ?> </option>
                                <?php endforeach; ?>
                            </select>  
                        </div>                       
                    </div><br/>
                    <div class="both"></div><br/>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-6 col-lg-6" id="div_botoes_cart_cred">
                            <button type="button" id="btn_novo_cartao_credito" class="btn btn-primary">Novo</button>
                            <button type="submit" id="btn_salvar_cartao_credito" class="btn btn-primary" disabled="disabled">Salvar</button>
                        </div>
                        <div class="form-group form-group-sm col-sm-6 col-lg-6" id="div_msgs_error_cart_cred">
                            <div class="retorno"></div>
                        </div>
                        <div class="both"></div>
                    </div>
                </div>
            </div>
        </form>	
    </div>
</aside>