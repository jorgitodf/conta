
<aside class="body_relatorio_movimentacao col-sm-12 col-lg-12">
    <div id="div_form_debito">
        <form method="POST" action="/relatorio" id="" >
            <div class="panel panel-primary" id="">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">Relatório de Movimentação por Período</h3>
                </div>
                <div class="panel-body">
                    <input type="hidden" name="idConta" value="<?php echo $idConta; ?>"/>
                    <input type="hidden" name="idUser" value="<?php echo $idUser; ?>"/>
                    <div class="form-group form-group-sm div_data_inicial_relatorio">
                        <label for="data_inicial" class="control-label">Data Inicial:</label>
                        <input type="date" name="data_inicial" id="data_inicial" class="form-control input-sm" value="<?php echo !empty($data_inicial) ? $data_inicial : ""; ?>"/>
                    </div> 
                    <div class="form-group form-group-sm div_data_inicial_relatorio_erro">
                        <?php echo !empty($erroDataInicial) ? $erroDataInicial : ""; ?>
                    </div>
                    <div class="form-group form-group-sm div_data_final_relatorio">
                        <label for="data_final" class="control-label">Data Final:</label>
                        <input type="date" name="data_final" id="data_final" class="form-control input-sm" value="<?php echo !empty($data_final) ? $data_final : ""; ?>"/>
                    </div>   
                    <div class="form-group form-group-sm div_data_inicial_relatorio_erro">
                        <?php echo !empty($erroDataFinal) ? $erroDataFinal : ""; ?>
                    </div> 
                    <div class="form-group form-group-sm div_movimentacao_relatorio">
                        <label for="movimentacao_relatorio" class="control-label">Movimentação:</label>
                        <input type="text" name="movimentacao_relatorio" id="movimentacao_relatorio" class="form-control input-sm" value="<?php echo !empty($movimentacao_relatorio) ? $movimentacao_relatorio : ""; ?>"/>
                    </div>
                    <div class="form-group form-group-sm div_movimentacao_relatorio_erro">
                        <?php echo !empty($erroMovimentacao) ? $erroMovimentacao : ""; ?>
                    </div> 
                    <div class="form-group div_button_relatorio_movimentacao">
                        <button type="submit" class="btn btn-primary">Verificar</button>
                    </div>
                </div>
            </div>       
        </form>
    </div>
</aside>