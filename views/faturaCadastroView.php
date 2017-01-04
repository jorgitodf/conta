
<aside class="container col-sm-12 col-lg-12">
    <div class="row-fluid col-sm-5 col-md-5 col-lg-5" id="div_row_form_cad_fatura_cartao_credito">
        <form method="POST" action="/cartao/fatura" id="form_cadastro_fatura_cartao_credito" >
            <div class="panel panel-primary" id="div_panel_form_cad_fatura_carta_credito">
                <div class="panel-heading">
                    <h3 class="panel-title">Cadastro de Fatura de Cartão de Crédito</h3>
                </div>
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <label for="cartao" class="control-label">Cartão de Crédito:</label>
                            <select class="form-control input-sm" name="cartao" id="cartao" disabled="disabled">
                                <option></option>
                                <?php foreach ($cartao as $value): ?> 
                                    <option value="<?php echo $value['id']; ?>"><?php echo wordwrap($value['num'], 4, '.', true); ?> - <?php echo $value['nome']; ?></option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                    </div>   
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-8 col-md-8 col-lg-8" id="">
                            <label for="data_pagto" class="control-label">Data de Pagamento:</label>
                            <input type="date" name="data_pagto" id="data_pagto" class="form-control input-sm" disabled="disabled"/>
                        </div>
                        <input type="hidden" name="idUser" value="<?php echo $idUser; ?>"/>
                    </div> 
                    <div class="both"></div><br/>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <button type="button" id="btn_nova_fatura" class="btn btn-primary">Novo</button>
                            <button type="submit" id="btn_salvar_nova_fatura" class="btn btn-primary" disabled="disabled">Salvar</button>
                            <a class="btn btn-primary" id="btn_debitar_fatura" href="/cartao/debitarfatura" disabled="disabled" title="Debitar">Debitar</a>
                        </div>
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="div_msgs_error_cad_fatura">
                            <div class="retorno"></div>
                        </div>
                        <div class="both"></div>
                    </div>
                </div>    
            </div>
        </form>
    </div>
</aside>