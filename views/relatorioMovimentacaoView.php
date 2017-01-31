
<aside class="container col-sm-12 col-md-12 col-lg-12" id="aside_consulta">
    <div class="row-fluid col-sm-6 col-md-6 col-lg-6" id="div_row_relatorio_periodo">
        <form method="POST" action="/relatorio/consultar" id="form_relatorio_periodo" >
            <div class="panel panel-primary" id="">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">Relatório de Movimentação por Período</h3>
                </div>
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-6 col-md-6 col-lg-6" id="">
                            <label for="data_inicial" class="control-label">Data Inicial:</label>
                            <input type="date" name="data_inicial" id="data_inicial" class="form-control input-sm"/>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-6 col-md-6 col-lg-6" id="">
                            <label for="data_final" class="control-label">Data Final:</label>
                            <input type="date" name="data_final" id="data_final" class="form-control input-sm"/>
                        </div>
                    </div>
                    <div class="both"></div><br/>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <button type="submit" id="btn_consultar_rel_preiodo" class="btn btn-primary">Consultar</button>
                        </div>
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="div_msgs_error_cad_fatura">
                            <div class="retorno"></div>
                        </div>
                    </div>
                </div>
            </div>       
        </form>
    </div>
</aside>