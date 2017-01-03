
<aside class="container-fluid body_debito col-sm-12 col-lg-12">
    <div class="row-fluid" id="div_row_form_debitar">
        <form method="POST" action="/conta/debitar" id="form_cad_debito" >
            <div class="panel panel-primary" id="div_panel_form_debitar">
                <div class="panel-heading">
                    <h3 class="panel-title">Débito</h3>
                </div> 
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="form-group form-group-sm" id="div_data_debito">
                            <label for="data_debito" class="control-label">Data:</label>
                            <input type="date" name="data_debito" id="data_debito" disabled="disabled" class="form-control input-sm" />
                        </div> 
                        <div class="form-group form-group-sm" id="div_mov_debito">
                            <label for="movimentacao" class="control-label">Movimentação:</label>
                            <input type="text" name="movimentacao" id="movimentacao" disabled="disabled" class="form-control input-sm" />
                        </div>
                        <div class="both"></div>
                    </div>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm" id="div_cat_debito">
                            <label for="nome_categoria" class="control-label">Categoria:</label>
                            <select class="form-control input-sm" name="nome_categoria" disabled="disabled" id="nome_categoria" >
                                <option></option>
                                <?php foreach ($categorias as $categoria): ?> 
                                    <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nome_categoria']; ?> </option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                        <div class="form-group form-group-sm" id="div_valor_debito">
                            <label for="valor" class="control-label">Valor:</label>
                            <input type="text" name="valor" id="valor" class="form-control input-sm" disabled="disabled" value="<?php echo!empty($valor) ? $valor : ''; ?>"/>
                            <input type="hidden" name="idConta" value="<?php echo $idConta; ?>"/>
                        </div> 
                        <div class="both"></div>
                    </div><br/> 
                    <div class="row-fluid">
                        <div class="form-group div_button_debito">
                            <button type="button" id="btn_novo_debito" class="btn btn-primary">Novo</button>
                            <button type="submit" id="btn_salvar_debito" class="btn btn-primary" disabled="disabled">Debitar</button>
                        </div>
                        <div class="form-group" id="div_msgs_error_debito">
                            <div class="retorno"></div>
                        </div>
                        <div class="both"></div>
                    </div>
               </div>         
            </div>
        </form>
    </div>
</aside>