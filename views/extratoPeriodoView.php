
<aside class="container col-sm-12 col-md-12 col-lg-12">
    <div class="row-fluid" id="div_row_form_extrato_periodo">
        <form method="POST" action="/extrato" id="form_extrato_periodo" >
            <div class="panel panel-primary" id="panel_extrato_periodo">
                <div class="panel-heading" id="panel_heading_cadastro">
                    <h3 class="panel-title">Extrato por Período</h3>
                </div>
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-6 col-md-6 col-lg-6" id="">
                            <label for="data_inicio" class="control-label">Início:</label>
                            <input type="date" name="data_inicio" id="data_inicio" class="form-control input-sm" value="<?php echo!empty($data_inicio) ? $data_inicio : ''; ?>"/>
                        </div>
                        <div class="form-group form-group-sm col-sm-6 col-md-6 col-lg-6">
                            <label for="data_final" class="control-label">Final:</label>
                            <input type="date" name="data_final" id="data_final" class="form-control input-sm" value="<?php echo!empty($data_final) ? $data_final : ''; ?>"/>
                        </div>
                    </div>
                    <div class="both"></div><br/>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-6 col-lg-6" id="">
                            <button type="submit" class="btn btn-primary">Verificar</button>
                        </div>  
                        <div class="form-group form-group-sm col-sm-6 col-lg-6" id="">
                            <div class="retorno"></div>
                            <div id="div_panel_tabela_extrato"></div>
                        </div>
                    </div>      
                </div>    
            </div>
        </form>
    </div>
</aside>
