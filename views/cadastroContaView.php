
	<aside class="row body_cadastro_conta col-md-12 col-lg-12 col-sm-10 col-xs-10">
		<form method="POST" action="/conta/salvar" id="form_cadastro_conta">
            <div class="panel panel-info" id="panel_cadastro">
                <div class="panel-heading" id="panel_heading_cadastro">
                    <h3 class="panel-title">Cadastro de Conta</h3>
                </div>
                <div class="panel-body">
                
                    <div class="form-group form-group-sm">
                        <label for="nome_banco" class="control-label">Nome Banco:</label>
                        <select class="form-control input-sm" name="nome_banco" id="nome_banco" >
                            <option></option>
                            <?php foreach ($bancos as $banco): ?> 
                                <option <?php echo (isset($nome['nome_banco']) && $banco['cod_banco'] == $nome['nome_banco'] ? 'selected="selected"' : '') ?> value="<?php echo $banco['cod_banco']; ?>"><?php echo $banco['nome_banco']; ?> </option>
                            <?php endforeach; ?>
                        </select>    
                        <?php echo !empty($erroOexpedidor) ? $erroOexpedidor : "" ?>
                    </div>                
                
                    <div class="form-group form-group-sm">
                        <label for="tipo_conta" class="control-label">Tipo de Conta:</label>
                        <select class="form-control input-sm" name="tipo_conta" id="tipo_conta" >
                            <option value='1'>Conta Corrente</option>
                            <option value='2'>Conta Poupança</option>
                            <option value='3'>Conta Salário</option>
                            <!-- <?php foreach ($orgaosExpedidores as $orgaosExpedidor): ?> -->
                                <option <!-- <?php echo (isset($nome['orgao_expedidor']) && $orgaosExpedidor['idorgao_expedidores'] == $nome['orgao_expedidor'] ? 'selected="selected"' : '') ?> value="<?php echo $orgaosExpedidor['idorgao_expedidores']; ?>"><?php echo $orgaosExpedidor['orgao_expedidor']; ?> --> </option>
                            <!-- <?php endforeach; ?>  -->
                        </select>
                        <?php echo !empty($erroOexpedidor) ? $erroOexpedidor : "" ?>
                    </div>
                    
                    <div class="form-group form-group-sm">
                        <label for="cod_agencia" class="control-label">Código da Agência:</label>
                        <input type="text" name="cod_agencia" id="cod_agencia" class="form-control input-sm" value="<?php echo !empty($codAgencia) ? $codAgencia : '' ; ?>"/>
                        <?php echo !empty($erroCodAgencia) ? $erroCodAgencia : "" ?>
                    </div>
                    
                    <div class="form-group form-group-sm">
                        <label for="dig_agencia" class="control-label">Dígito Verificador da Agência:</label>
                        <input type="text" name="dig_agencia" id="dig_agencia" class="form-control input-sm" value="<?php echo !empty($digAgencia) ? $digAgencia : '' ; ?>"/>
                        <?php echo !empty($erroDigAgencia) ? $erroDigAgencia : "" ?>
                    </div>
                    
                    <div class="form-group form-group-sm">
                        <label for="num_conta" class="control-label">Número da Conta:</label>
                        <input type="text" name="num_conta" id="num_conta" class="form-control input-sm" value="<?php echo !empty($numConta) ? $numConta : '' ; ?>"/>
                        <?php echo !empty($erroNumConta) ? $erroNumConta : "" ?>
                    </div>
                    
                    <div class="form-group form-group-sm">
                        <label for="dig_conta" class="control-label">Dígito Verificador da Agência:</label>
                        <input type="text" name="dig_conta" id="dig_conta" class="form-control input-sm" value="<?php echo !empty($digConta) ? $digConta : '' ; ?>"/>
                        <?php echo !empty($erroDigConta) ? $erroDigConta : "" ?>
                    </div>
                    
                    <div class="form-group form-group-sm">
                        <label for="cod_operacao" class="control-label">Código da Operação:</label>
                        <input type="text" name="cod_operacao" id="cod_operacao" class="form-control input-sm" value="<?php echo !empty($codOperacao) ? $codOperacao : '' ; ?>"/>
                        <?php echo !empty($erroCodOperacao) ? $erroCodOperacao : "" ?>
                    </div>

                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        
                        
                    </div>
                </div>
            </div>

        </form>
	</aside>