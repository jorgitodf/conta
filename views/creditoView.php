
<aside class="container-fluid body_debito col-sm-12 col-md-12 col-lg-12">
    <div class="row-fluid" id="div_row_form_creditar">
        <form method="POST" action="/conta/creditar" id="form_cad_credito" >
            <div class="panel panel-primary" id="div_panel_form_creditar">
                <div class="panel-heading">
                    <h3 class="panel-title">Crédito</h3>
                </div> 
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-6 col-md-6 col-lg-6" id="div_data_credito">
                            <label for="data_credito" class="control-label">Data:</label>
                            <input type="date" name="data_credito" id="data_credito" disabled="disabled" class="form-control input-sm" />
                        </div> 
                        <div class="form-group form-group-sm col-sm-6 col-md-6 col-lg-6" id="div_mov_credito">
                            <label for="mov_cred" class="control-label">Movimentação:</label>
                            <input type="text" name="mov_cred" id="mov_cred" disabled="disabled" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="both"></div>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-6 col-md-6 col-lg-6" id="div_cat_credito">
                            <label for="nome_cat_cre" class="control-label">Categoria:</label>
                            <select class="form-control input-sm" name="nome_cat_cre" disabled="disabled" id="nome_cat_cre" >
                                <option></option>
                                <?php foreach ($categorias as $categoria): ?> 
                                    <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nome_categoria']; ?> </option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                        <div class="form-group form-group-sm col-sm-6 col-md-6 col-lg-6" id="div_valor_credito">
                            <label for="valor_cre" class="control-label">Valor:</label>
                            <input type="text" name="valor_cre" id="valor_cre" class="form-control input-sm" disabled="disabled" />
                            <input type="hidden" name="idConta" value="<?php echo $idConta; ?>"/>
                        </div> 
                        <div class="both"></div>
                    </div><br/> 
                    <div class="row-fluid col-sm-12 col-md-12 col-lg-12">
                        <div class="form-group div_button_credito">
                            <button type="button" id="btn_novo_credito" class="btn btn-primary">Novo</button>
                            <button type="submit" id="btn_salvar_credito" class="btn btn-primary" disabled="disabled">Creditar</button>
                        </div>
                        <div class="form-group" id="div_msgs_error_credito">
                            <div class="retorno"></div>
                        </div>
                    </div>
                </div>    
            </div>
        </form>
    </div>
</aside>