
<aside class="container col-sm-12 col-lg-12">
    <div class="row-fluid" id="div_row_form_agendar_pagamento">
        <form method="POST" action="/agendamento/alterar" id="form_editar_agendamento_debito" >
            <div class="panel panel-primary" id="div_panel_form_agendar_pagamento">
                <div class="panel-heading">
                    <h3 class="panel-title">Alteração de Pagamento Agendado</h3>
                </div>
                <div class="panel-body">	
                    <div class="row-fluid">
                        <?php isset($pagamento) ? $pagamento : ""; ?>
                        <div class="form-group form-group-sm" id="div_data_pgto">
                            <label for="data_pgto" class="control-label">Data:</label>
                            <input type="date" name="data_pgto" id="data_pgto" disabled="disabled" class="form-control input-sm" value="<?php echo $pagamento['data_pagamento']; ?>"/>
                        </div> 
                        <div class="form-group form-group-sm" id="div_mov_pgto">
                            <label for="mov_pgto" class="control-label">Movimentação:</label>
                            <input type="text" name="mov_pgto" id="mov_pgto" disabled="disabled" class="form-control input-sm" value="<?php echo $pagamento['movimentacao']; ?>"/>
                        </div>
                        <input type="hidden" name="idConta" value="<?php echo $idConta; ?>"/>
                        <input type="hidden" name="idPgtoAgendado" value="<?php echo $pagamento['id_pgto_agendado']; ?>"/>
                        <div class="both"></div>
                    </div>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm" id="div_cat_pgto">
                            <label for="categoria_pgto" class="control-label">Categoria:</label>
                            <select class="form-control input-sm" name="categoria_pgto" disabled="disabled" id="categoria_pgto" >
                                <?php foreach ($categorias as $categoria): ?> 
                                    <option <?php echo ($categoria['id_categoria']==$pagamento['fk_id_categoria'] ? 'selected="selected"':'') ?> value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nome_categoria']; ?> </option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                        <div class="form-group form-group-sm" id="div_valor_pgto">
                            <label for="valor_pgto" class="control-label">Valor:</label>
                            <input type="text" name="valor_pgto" id="valor_pgto" disabled="disabled" class="form-control input-sm" value="<?php echo number_format($pagamento['valor'], 2, ',', '.'); ?>"/>
                        </div> 
                        <div class="both"></div>
                    </div><br>
                    <div class="row-fluid">
                        <div class="form-group" id="div_btn_agendar">
                            <button type="button" id="btn_editar_pgto_agendado" class="btn btn-primary">Editar</button>
                            <button type="submit" id="btn_salvar_pgto_agendado" class="btn btn-primary" disabled="disabled">Salvar</button>
                            <a class="btn btn-primary" href="/agendamento" title="Listar">Listar</a>
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