
<aside class="container col-sm-12 col-md-12 col-lg-12">
    <div class="row-fluid">
        <header class="panel-heading" id="div_panel_agendamento_pgto">
            <div class="panel panel-success" >
                <div class="panel-heading" id="panel_head_agendamento_pagamento">Listagem Geral de Agendamento de Pagamentos</div>
                <div class="panel-body">
                    <?php if (isset($pgto_agendados) && !empty($pgto_agendados)): ?>
                    <table class="table table-bordered table-responsive table-hover table-condensed" id="tabela_index_agendamento_pagamento">
                        <thead>
                            <tr>
                                <th width="13%">Data de Pagamento</th>
                                <th width="32%">Movimentação</th>
                                <th width="20%">Categoria</th>
                                <th width="10%">Valor</th>
                                <th width="4%">Pago</th>
                                <th colspan="2" width="8%">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($pgto_agendados as $value): ?>
                            <tr>
                                <td class="centralizar_td"><?php echo $value['data_pg']; ?></td>
                                <td><?php echo ucwords(strtolower($value['mov'])); ?></td>
                                <td><?php echo $value['categoria']; ?></td>
                                <td><?php echo $value['valor']; ?></td>
                                <?php if ($value['pg'] == "Sim"): ?>
                                <td class="centralizar_td"><span class="glyphicon glyphicon-ok cor_verde" aria-hidden="true" title="Pago"></span></td>
                                <?php else: ?>
                                <td class="centralizar_td"><span class="glyphicon glyphicon-alert cor_vermelho" aria-hidden="true" title="Não Pago"></span></td>
                                <?php endif; ?>
                                <?php if ($value['pg'] == "Sim"): ?>
                                <td class="centralizar_td"><a class="glyphicon glyphicon-pencil disabled" aria-hidden="true" title="Não é possível Editar" href="/agendamento/alterar/<?php echo $value['id']; ?>"></a></td>
                                <td class="centralizar_td"><a class="glyphicon glyphicon-trash disabled" aria-hidden="true" title="Não é possível Apagar"></a></td>
                                <?php else: ?>
                                <td class="centralizar_td"><a class="glyphicon glyphicon-pencil" aria-hidden="true" title="Editar" href="/agendamento/alterar/<?php echo $value['id']; ?>"></a></td>
                                <td class="centralizar_td"><a class="glyphicon glyphicon-trash" aria-hidden="true" title="Apagar" href="/agendamento/apagar/<?php echo $value['id']; ?>"></a></td>
                                <?php endif; ?>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <?php else: ?>
                    
                    <?php endif; ?>
                </div>
            </div>
        </header>
    </div>
</aside>