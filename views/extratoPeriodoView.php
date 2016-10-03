
	<aside class="body_extrato_periodo col-md-12 col-lg-12 col-sm-12 col-xs-12">
	<form method="POST" action="/extrato" id="" >
		<div class="panel panel-info" id="panel_extrato_periodo">
			<div class="panel-heading" id="panel_heading_cadastro">
				<h3 class="panel-title">Extrato por Período</h3>
			</div>
			<div class="panel-body">
				<div class="form-group form-group-sm div_data_inicial">
					<label for="data_inicio" class="control-label">Início:</label>
					<input type="date" name="data_inicio" id="data_inicio" class="form-control input-sm" value="<?php echo !empty($data_inicio) ? $data_inicio : '' ; ?>"/>
				</div>
				<div class="form-group form-group-sm div_data_final">
					<label for="data_final" class="control-label">Final:</label>
					<input type="date" name="data_final" id="data_final" class="form-control input-sm" value="<?php echo !empty($data_final) ? $data_final : '' ; ?>"/>
				</div>
			</div>
        	<div class="form-group form-group-sm btn_extrato">
            	<button type="submit" class="btn btn-primary">Verificar</button>
            </div>
         	<div class="form-group form-group-sm div_erro_extrato">
                <?php echo !empty($erroDataInicial) ? $erroDataInicial : "" ?>
            	<?php echo !empty($erroDataFinal) ? $erroDataFinal : "" ?>
            </div>           
		</div>
	</form>	
	</aside>
	