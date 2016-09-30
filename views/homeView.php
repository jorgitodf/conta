	
	<aside class="row body_home col-md-12 col-lg-12 col-sm-10 col-xs-10">
	<?php if (isset($erroConta)): ?>
	<?php echo "<h3> {$erroConta} </h3>"; ?>
	<?php else: ?>
	<form class="form-horizontal" method="POST" action="/conta/ver" id="form_home">
	<div class="panel panel-info" id="panel_home">
        <div class="panel-heading" id="panel_heading_cadastro">
            <h3 class="panel-title">Contas Cadastradas</h3>
        </div>
        <?php if(isset($_SESSION['conta'])): ?>
        <div class="panel-body">
			<div class="radio">
			  <label>
			    <input type="radio" name="radio_conta" id="radio_conta" checked="checked" value="">
				<?php echo "<span class='tipo_conta_home'>{$_SESSION['conta']['TipoConta']}</span> - <span class='num_conta_home'>Número:</span> {$_SESSION['conta']['numConta']}-{$_SESSION['conta']['DigVerConta']} - <span class='ag_conta_home'>Agência:</span> {$_SESSION['conta']['codConta']} - <span class='nome_banco_home'>Banco:</span> {$_SESSION['conta']['nomeBanco']}";  ?>  
			  </label>
			</div>
		</div>	
		<div class="div_button_home">
        	<a class="btn btn-primary" style="height: 35px" href="/conta/trocar" title="Trocar de Conta">Trocar de Conta</a>
        </div>
		<?php else: ?>
        <div class="panel-body">
        	<?php if(!empty($contas)): ?>
			<?php foreach ($contas as $conta): ?>
				<div class="radio">
				  <label>
				    <input type="radio" name="radio_conta" id="radio_conta" checked="checked" value="<?php echo $conta['IdConta']; ?>">
				  	<?php echo "<span class='tipo_conta_home'>{$conta['TipoConta']}</span> - <span class='num_conta_home'>Número:</span> {$conta['NumeroConta']}-{$conta['DigVerConta']} - <span class='ag_conta_home'>Agência:</span> {$conta['CodAgencia']} - <span class='nome_banco_home'>Banco:</span> {$conta['NomeBanco']}";  ?>  
				  </label>
				</div>
			<?php endforeach; ?>
			<?php else: ?>
			<?php echo ""; ?>
			<?php endif; ?>
		</div>
		<div class="div_button_home">
        	<button type="submit" class="btn btn-primary">Acessar</button>
        </div>
		<?php endif; ?>

	</div>	
	</form>	
	<?php endif; ?>
	</aside>
	