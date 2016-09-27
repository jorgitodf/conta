
	<aside class="row body_extrato col-md-12 col-lg-12 col-sm-10 col-xs-10">
		<?php if (isset($extrato) && !empty($extrato)): ?>
		<div class="panel panel-primary" id="table_extrato">
			<div class="panel-heading">
	            <h3 class="panel-title">Extrato</h3>
	        </div>
	        <div class="panel-body">
	        	<table class="table table-hover">
		        	<thead>
	                    <tr>
	                        <th class="data_mov_cab">Data de Movimentação</th>
	                        <th>Movimentação</th>
	                        <th>Categoria</th>
	                        <th class="valor_mov_cab">Valor</th>
	                        <th class="saldo_mov_cab">Saldo</th>
	                    </tr>
	                </thead>
	                <tbody>
	                	<?php foreach($extrato as $linha): ?>
	                	<tr>
	                		<td class="td_extrato_deb_data"><?php echo date("d/m/Y", strtotime($linha['DatMov'])); ?></td>
	                		<?php if ($linha['Op'] == 'Crédito'): ?>
	                		<td class="td_extrato_cre"><?php echo ucwords(strtolower(mb_convert_case($linha['Mov'],MB_CASE_TITLE))); ?></td>
	                		<td class="td_extrato_cre"><?php echo ucwords(strtolower(mb_convert_case($linha['Cat'],MB_CASE_TITLE))); ?></td>
	                		<td align="right" class="td_extrato_cre"><?php echo number_format($linha['Val'], 2, ',', '.'); ?></td>
	                		<td align="right" class="td_extrato_cre"><?php echo number_format($linha['Sal'], 2, ',', '.'); ?></td>
	                		<?php else: ?>
	                		<?php if ($linha['Dp'] == 'S'): ?>
	                		<td class="td_extrato_deb_fixa"><?php echo ucwords(strtolower(mb_convert_case($linha['Mov'],MB_CASE_TITLE))); ?></td>
	                		<?php else: ?>
	                		<td><?php echo ucwords(strtolower(mb_convert_case($linha['Mov'],MB_CASE_TITLE))); ?></td>
	                		<?php endif; ?>
	                		<td><?php echo ucwords(strtolower(mb_convert_case($linha['Cat'],MB_CASE_TITLE))); ?></td>
	                		<td align="right" class="td_extrato_deb"><?php echo number_format($linha['Val'], 2, ',', '.'); ?></td>
	                		<td align="right" class="td_extrato_deb_saldo"><?php echo number_format($linha['Sal'], 2, ',', '.'); ?></td>
	                		<?php endif; ?>
	                	</tr>
	                	<?php endforeach; ?>
	                </tbody>
	        	</table>
			</div>
		</div>
		<?php else: ?>
		<h4><?php echo !empty($extrato_erro) ? $extrato_erro : ""  ?></h4>
		<?php endif; ?>
		
	</aside>