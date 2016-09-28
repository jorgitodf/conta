	
	<aside class="row body_home col-md-12 col-lg-12 col-sm-10 col-xs-10">
	<?php if (isset($erroConta)): ?>
	<?php echo "<h3> {$erroConta} </h3>"; ?>
	<?php else: ?>
	<form class="form-horizontal" method="POST" action="/conta/ver" id="form_home">
	<div class="panel panel-info" id="panel_home">
        <div class="panel-heading" id="panel_heading_cadastro">
            <h3 class="panel-title">Contas Cadastradas</h3>
        </div>
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
	</div>	
	</form>	
	<?php endif; ?>
	</aside>
	