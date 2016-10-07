
	<aside class="row body_cadastro_conta_cadastrada col-md-12 col-lg-12 col-sm-10 col-xs-10">
		<form method="POST" action="" id="form_cadastro_conta" >
            <div class="panel panel-info" id="panel_cadastro">
                <div class="panel-heading" id="panel_heading_cadastro">
                    <h3 class="panel-title">Cadastro de Conta</h3>
                </div>
                <div class="panel-body">

                	<div class="form-group form-group-sm div_cad_conta_esq">
	                    <div class="form-group form-group-sm">
	                        <label for="nome_banco" class="control-label">Nome Banco:</label>
   							<input type="text" name="dig_agencia" id="dig_agencia" class="form-control input-sm" readonly="true" value="<?php echo $retorno['NomeBanco'] ?>"/>
	                    </div>  
			    		<div class="form-group form-group-sm">
	                        <label for="dig_agencia" class="control-label">Dígito Verificador da Agência:</label>
							<input type="text" name="dig_agencia" id="dig_agencia" class="form-control input-sm" readonly="true" value="<?php echo $retorno['DigVerAgencia'] ?>"/>
	                    </div>
	                    <div class="form-group form-group-sm">
	                        <label for="num_conta" class="control-label">Número da Conta:</label>
	                        <input type="text" name="dig_agencia" id="dig_agencia" class="form-control input-sm" readonly="true" value="<?php echo $retorno['NumeroConta'] ?>"/>
	                    </div>
	                    <div class="form-group form-group-sm">
	                        <label for="cod_operacao" class="control-label">Código da Operação:</label>
	                        <input type="text" name="dig_agencia" id="dig_agencia" class="form-control input-sm" readonly="true" value="<?php echo $retorno['CodOperacao'] ?>"/>
	                    </div>  
                    </div> 
                    
                	<div class="form-group form-group-sm div_cad_conta_dir">
                    	<div class="form-group form-group-sm">
                        	<label for="cod_agencia" class="control-label">Código da Agência:</label>
							<input type="text" name="dig_agencia" id="dig_agencia" class="form-control input-sm" readonly="true" value="<?php echo $retorno['CodAgencia'] ?>"/>
		    			</div>
       	             	<div class="form-group form-group-sm">
	                        <label for="tipo_conta" class="control-label">Tipo de Conta:</label>
							<input type="text" name="dig_agencia" id="dig_agencia" class="form-control input-sm" readonly="true" value="<?php echo $retorno['TipoConta'] ?>"/>
	                    </div> 
	                    <div class="form-group form-group-sm">
	                        <label for="dig_conta" class="control-label">Dígito Verificador da Conta:</label>
	                        <input type="text" name="dig_agencia" id="dig_agencia" class="form-control input-sm" readonly="true" value="<?php echo $retorno['DigVerConta'] ?>"/>
	                    </div>
	                    <div class="form-group form-group-sm">
	                        <label for="dig_conta" class="control-label">Data de Cadastro:</label>
	                        <input type="text" name="dig_agencia" id="dig_agencia" class="form-control input-sm" readonly="true" value="<?php echo $retorno['DataCadastro'] ?>"/>
	                    </div>
                    </div>

		        	<div class="form-group div_button">
		            	<a class="btn btn-primary" style="height: 35px" href="/home" title="Fazer Login">Página Inicial</a>
		            	<?php echo !empty($msg_sucesso) ? $msg_sucesso : "" ?>
		            </div>
                </div>

            </div>


        </form>
	</aside>