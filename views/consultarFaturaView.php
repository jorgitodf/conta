
<aside class="container-fluid col-md-12 col-lg-12 col-sm-12" id="aside_consultar_fatura">
    <div class="row-fluid col-md-6 col-lg-6 col-sm-6" id="div_row_consultar_fatura">
        <form method="POST" action="/cartao/consultarfatura" id="form_consultar_fatura">
            <div class="panel panel-primary" id="div_panel_form_consultar_fatura">
                <div class="panel-heading">
                    <h3 class="panel-title">Consultar Fatura Cartão de Crédito</h3>
                </div> 
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="form-group form-group-sm" id="">
                            <label for="fatura" class="control-label">Fatura:</label>
                            <select class="form-control input-sm" name="fatura" id="" >
                                <option></option>
                                <?php foreach ($fatura as $value): ?> 
                                    <option value="<?php echo $value['id']; ?>">Número: <?php echo wordwrap($value['num'], 4, '.', true); ?>  -  Data de Vencimento: <?php echo $value['data']; ?> - <?php echo $value['band']; ?> - <?php echo $value['nome']; ?></option>
                                <?php endforeach; ?>
                            </select>  
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="form-group div_button_form">
                            <button type="submit" id="btn_buscar_fatura" class="btn btn-primary">Buscar</button>
                        </div>
                        <div class="form-group" id="div_msg_error_buscar_fatura">
                            <div class="retorno">
                                <span class="msg_error_sem_ajax"><?php echo !empty($erroFat) ? $erroFat : ""; ?></span>
                            </div>
                        </div>
                    </div>
                </div>    
            </div>    
        </form>
    </div>
</aside>