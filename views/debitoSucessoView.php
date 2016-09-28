
	<aside class="row body_debito col-sm-12 col-lg-12">
	<div id="div_form_debito">

		<div class="panel panel-primary" id="">
			<div class="panel-heading">
	            <h3 class="panel-title">Débito</h3>
	        </div>
	        <div class="panel-body">	
	        	<?php foreach($last_debito as $deb): ?>
	        	<div class="form-group form-group-sm">
                    <div class="form-group form-group-sm">
                        <label for="data_debito" class="control-label">Data:</label>
  						<input type="text" name="data_debito" id="data_debito" class="form-control input-sm" readonly="true" value="<?php echo date("d/m/Y", strtotime($deb['DatMov'])); ?>"/>
                    </div> 
                     
		    		<div class="form-group form-group-sm">
                        <label for="movimentacao" class="control-label">Movimentação:</label>
                        <input type="text" name="movimentacao" id="movimentacao" class="form-control input-sm" readonly="true" value="<?php echo $deb['Mov']; ?>"/>
                    </div>
                    
                    <div class="form-group form-group-sm">
                        <label for="nome_categoria" class="control-label">Categoria:</label>
                        <input type="text" name="nome_categoria" id="nome_categoria" class="form-control input-sm" readonly="true" value="<?php echo $deb['Cat']; ?>"/>
                    </div>
                    
                    <div class="form-group form-group-sm">
                        <label for="valor" class="control-label">Valor:</label>
                        <input type="text" name="valor" id="valor" class="form-control input-sm" readonly="true" value="<?php echo $deb['Val']; ?>"/>
                    </div>  
                </div> 
				<?php endforeach; ?>
	        	<div class="form-group div_button_debito col-sm-12">
                    <a class="btn btn-primary" style="height: 35px" href="/conta/extrato/<?php echo $idConta; ?>" title="Ver Extrato">Ver Extrato</a>
                    <?php echo !empty($msg_sucesso) ? $msg_sucesso : "" ?>
                    
	            </div>
			</div>
		</div>

	</div>
	</aside>