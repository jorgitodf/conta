
<aside class="container col-sm-12 col-lg-12">
    <div class="row-fluid" id="div_row_form_agendar_pagamento">
        <form method="POST" action="/agendamento/agendar" id="form_cad_agendamento_debito" >
            <div class="panel panel-primary" id="div_panel_form_agendar_pagamento">
                <div class="panel-heading">
                    <h3 class="panel-title">Agendamento de Pagamento</h3>
                </div>
                <div class="panel-body">	
                    <div class="row-fluid">
                        <div class="form-group form-group-sm" id="div_data_pgto">
                            <label for="data_pgto" class="control-label">Data:</label>
                            <input type="date" name="data_pgto" id="data_pgto" disabled="disabled" class="form-control input-sm"/>
                        </div> 
                        <div class="form-group form-group-sm" id="div_mov_pgto">
                            <label for="mov_pgto" class="control-label">Movimentação:</label>
                            <input type="text" name="mov_pgto" id="mov_pgto" disabled="disabled" class="form-control input-sm" />
                        </div>
                        <input type="hidden" name="idConta" value="<?php echo $idConta; ?>"/>
                        <input type="hidden" name="idUser" value="<?php echo $idUser; ?>"/>
                        <div class="both"></div>
                    </div>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm" id="div_cat_pgto">
                            <label for="categoria_pgto" class="control-label">Categoria:</label>
                            <select class="form-control input-sm" name="categoria_pgto" disabled="disabled" id="categoria_pgto" >
                                <option></option>
                                <?php foreach ($categorias as $categoria): ?> 
                                    <option value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nome_categoria']; ?> </option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                        <div class="form-group form-group-sm" id="div_valor_pgto">
                            <label for="valor_pgto" class="control-label">Valor:</label>
                            <input type="text" name="valor_pgto" id="valor_pgto" disabled="disabled" class="form-control input-sm" />
                        </div> 
                        <div class="both"></div>
                    </div><br>
                    <div class="row-fluid">
                        <div class="form-group" id="div_btn_agendar">
                            <button type="button" id="btn_novo_agendamento" class="btn btn-primary">Novo</button>
                            <button type="submit" id="btn_salvar_agendamento" class="btn btn-primary" disabled="disabled">Agendar</button>
                        </div>
                        <div class="form-group" id="div_msgs_error">
                            <div id="retorno"></div>
                        </div>
                        <div class="both"></div>
                    </div>
                </div>
            </div>
        </form>	
    </div>
</aside>