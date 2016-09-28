
	<aside class="row body_home_conta col-md-12 col-lg-12 col-sm-10 col-xs-10">
		<div class="panel_home_conta">
		
			<div class="btn-group">
			  <button type="button" class="btn btn-success" id="btn_extrato">Extratos</button>
			  <button type="button" class="btn btn-success dropdown-toggle" id="btn_extrato_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a href="/conta/extrato/<?php echo $idConta; ?>">Extrato Mês Atual</a></li>
			    <li><a href="#">Extrato Por Período</a></li>
			  </ul>
			</div>
			
			<div class="btn-group">
			  <button type="button" class="btn btn-success" id="btn_extrato">Transações</button>
			  <button type="button" class="btn btn-success dropdown-toggle" id="btn_extrato_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			    <span class="caret"></span>
			    <span class="sr-only">Toggle Dropdown</span>
			  </button>
			  <ul class="dropdown-menu">
			    <li><a href="/conta/debitar/<?php echo $idConta; ?>">Debitar</a></li>
			    <li><a href="#">Creditar</a></li>
			  </ul>
			</div>		
			
		</div>
	</aside>