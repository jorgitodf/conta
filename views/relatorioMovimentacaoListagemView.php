
<aside class="body_relatorio_movimentacao col-sm-12 col-lg-12">
    <div id="div_form_debito">
        <form method="POST" action="/relatorio" id="" >
            <div class="panel panel-primary" id="">
                <div class="panel-heading">
                    <h3 class="panel-title" align="center">Relatório de Movimentação por Período</h3>
                </div>
                <div class="panel-body">
                    <?php if (isset($extrato_relatorio) && !empty($extrato_relatorio)): ?>
                    <table class="table table-condensed table-hover" id="" cellspacing=1 cellpadding=1>
                        <thead>
                            <tr>
                                <td colspan="3" id="">Extrato de despesas com <?php echo !empty($extrato_relatorio[0]['mov']) ? ucwords(strtolower(mb_convert_case($extrato_relatorio[0]['mov'], MB_CASE_TITLE))) : "" ?> no ano de <?php echo !empty($extrato_relatorio[2]['ano']) ? ucwords(strtolower(mb_convert_case($extrato_relatorio[2]['ano'], MB_CASE_TITLE))) : "" ?></td>
                            </tr>
                            <tr id="">
                                <td>Mês</td>
                                <td>Ano</td>
                                <td align="right">Valor</td>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $total = "" ?>
                        <?php foreach ($extrato_relatorio as $linha): ?>
                            <tr>
                                <td><?php echo ucwords(strtolower(mb_convert_case($linha['mes'], MB_CASE_TITLE))); ?></td>
                                <td><?php echo ucwords(strtolower(mb_convert_case($linha['ano'], MB_CASE_TITLE))); ?></td>
                                <td align="right">R$ <?php echo number_format($linha['val'], 2, ',', '.'); ?></td>
                            </tr>
                        <?php $total += $linha['val']; ?>
                        <?php $mov = $linha['mov']; ?>
                        <?php $ano = $linha['ano']; ?>
                        <?php endforeach; ?>
                        </tbody>
                        <tfoot>
                        <td colspan="2" align="center">Total gasto com <?php echo !empty($mov) ? ucwords(strtolower(mb_convert_case($mov, MB_CASE_TITLE))) : "" ?> em <?php echo !empty($mov) ? ucwords(strtolower(mb_convert_case($ano, MB_CASE_TITLE))) : "" ?></td>
                            <td colspan="1" align="right">R$ <?php echo number_format($total, 2, ',', '.'); ?></td>
                        </tfoot>
                    </table>
                    <?php endif; ?>  
                </div>
            </div>       
        </form>
    </div>
</aside>