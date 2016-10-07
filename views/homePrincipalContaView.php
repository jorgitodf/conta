
<aside class="body_home_conta col-md-12 col-lg-12 col-sm-12 col-xs-12">
    <div class="panel_home_conta">
        <section class="sec_btn_group">
            <div class="btn-group">
                <button type="button" class="btn btn-success" id="btn_extrato"><a class="href_btn_home" href="/home">Extratos</a></button>
                <button type="button" class="btn btn-success dropdown-toggle" id="btn_extrato_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="/conta/extrato/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Extrato Mês Atual</a></li>
                    <li><a href="#">Extrato Por Período</a></li>
                </ul>
            </div>
            <div class="btn-group">
                <button type="button" class="btn btn-success" id="btn_extrato"><a class="href_btn_home" href="/home">Transações</a></button>
                <button type="button" class="btn btn-success dropdown-toggle" id="btn_extrato_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="/conta/debitar/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Debitar</a></li>
                    <li><a href="/conta/creditar/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Creditar</a></li>
                </ul>
            </div>	
            <div class="btn-group">
                <button type="button" class="btn btn-success" id="btn_extrato"><a class="href_btn_home" href="/home">Pagamentos</a></button>
                <button type="button" class="btn btn-success dropdown-toggle" id="btn_extrato_1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu">
                    <li><a href="/conta/pagar/<?php echo isset($_SESSION['conta']) ? $_SESSION['conta']['idConta'] : "" ?>">Pagamento Agendado</a></li>
                </ul>
            </div>
            <div class="div_msg_alert_pgto_agendado">
                <?php echo !empty($mensagem) ? $mensagem : ""; ?>
            </div>
        </section>
        <section class="sec_desp_agendada">
            
            <div class="table table-responsive">
              <?php if (isset($contas_agendadas) && !empty($contas_agendadas)): ?>  
              <table class="table table-condensed bordasimples" id="table_desp_agendada" cellspacing=1 cellpadding=1>
                  <thead>
                      <tr>
                          <td colspan="4" id="cab_table">Contas Agendadas para <?php echo !empty($mes) ? $mes : "";  ?> / <?php echo !empty($ano) ? $ano : "";  ?></td>
                      </tr>
                      <tr id="tr_cab_table">
                          <td>Movimentação</td>
                          <td>Valor</td>
                          <td>Data Pagamento</td>
                          <td>Pago</td>
                      </tr>
                  </thead>
                  <tbody>
                      <?php $total = "" ?>
                      <?php foreach ($contas_agendadas as $linha): ?>
                      <tr>
                          <?php if ($linha['pago'] == 'Não'): ?>
                          <td class="td_color_pgto"><?php echo ucwords(strtolower(mb_convert_case($linha['mov'], MB_CASE_TITLE))); ?></td>
                          <td align="left" class="td_color_pgto">R$ <?php echo number_format($linha['valor'], 2, ',', '.'); ?></td>
                          <td class="td_color_pgto"><?php echo date("d/m/Y", strtotime($linha['data'])); ?></td>
                          <td class="td_color_pgto"><?php echo ucwords(strtolower(mb_convert_case($linha['pago'], MB_CASE_TITLE))); ?></td>
                          <?php else: ?>
                          <td class="td_color_pgto_sim"><?php echo ucwords(strtolower(mb_convert_case($linha['mov'], MB_CASE_TITLE))); ?></td>
                          <td align="left" class="td_color_pgto_sim">R$ <?php echo number_format($linha['valor'], 2, ',', '.'); ?></td>
                          <td class="td_color_pgto_sim"><?php echo date("d/m/Y", strtotime($linha['data'])); ?></td>
                          <td class="td_color_pgto_sim"><?php echo ucwords(strtolower(mb_convert_case($linha['pago'], MB_CASE_TITLE))); ?></td>                          
                          <?php endif; ?>
                      </tr>
                      <?php $total += $linha['valor']; ?>
                     <?php endforeach; ?> 
                  </tbody>
                  <tfoot>
                      <tr>
                          <td colspan="2" align="center">Total de Contas a Pagar em Outubro/2016</td>
                          <td colspan="2" align="right">R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
                      </tr>
                  </tfoot>
              </table>
              <?php else: ?>
              <?php echo"" ?>
              <?php endif; ?>  
            </div>            
        </section>
    </div>
</aside>