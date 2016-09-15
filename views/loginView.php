
	<div class="container-login login-body">
		<form class="form-login" id="" action="" method="post">    
			<h2 class="form-login-heading">Sistema de Controle Financeiro</h2>
			
			<div class="login-wrap">
			
				<input class="form-control" placeholder="e-mail" name="email" type="text" /> 
				<?php echo !empty($erroEmail) ? $erroEmail : "" ?>
				               
				<input class="form-control" placeholder="senha" name="senha" type="password" />
				<?php echo !empty($erroSenha) ? $erroSenha : "" ?>
				<br/>	
				<button class="btn btn-login btn-block" type="submit">Acessar</button>
				<a class="btn btn-cadastro btn-block" style="height: 35px" href="/cadastro" title="Cadastrar">Cadastrar</a>
			</div>
			<?php echo !empty($erro_login) ? $erro_login : "" ?>
			
		</form> 
		
		
  	</div>
	