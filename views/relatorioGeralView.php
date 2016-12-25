
<div class="container-fluid div_coint">
    <div class="row">
        <div class="col-md-12" id="div_cab_rel_geral">
            <span>Relatório Geral de Gastos com Gasolina</span>
        </div>
    </div>
    <?php if (isset($rel_geral_gasto) && !empty($rel_geral_gasto)): ?>
    <div class="row-fluid" id="seg_div_rel_geral">
        <?php 
            foreach ($rel_geral_gasto as $key => $value) {
                $dados[] = $key;            
            }
        ?>
        <?php $contArray = count($dados);  ?>
        <?php for ($i = 0; $i < 3; $i++): ?>
        <div class="col-md-4" id="div_table">
            <table class="table table-condensed table-hover" id="table_rel_geral">
                <thead>
                    <tr>
                        <th>Ano <?php echo str_replace("ano", "", $dados[$i]); ?></th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                <?php $total = "" ?>
                <?php foreach ($rel_geral_gasto[$dados[$i]] as $key => $value): ?>    
                    <tr>
                        <td><?php echo $value['mes']; ?></td>
                        <td><?php echo $value['val']; ?></td>
                    </tr>
                    <?php $total += $value['val']; ?>
                <?php endforeach; ?>    
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td> 
                        <td>R$ <?php echo number_format($total, 2, ',', '.'); ?></td> 
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php endfor; ?>
    </div>
    <div class="row-fluid">
        <?php if ($contArray <= 6): ?>
        <?php for ($i = 3; $i < $contArray; $i++): ?>
        <div class="col-md-4" id="div_table">
            <table class="table table-condensed table-hover" id="table_rel_geral">
                <thead>
                    <tr>
                        <th>Ano <?php echo str_replace("ano", "", $dados[$i]); ?></th>
                        <th>Valor</th>
                    </tr>
                </thead>
                <tbody>
                <?php $total = "" ?>
                <?php foreach ($rel_geral_gasto[$dados[$i]] as $key => $value): ?>    
                    <tr>
                        <td><?php echo $value['mes']; ?></td>
                        <td><?php echo $value['val']; ?></td>
                    </tr>
                    <?php $total += $value['val']; ?>
                <?php endforeach; ?>    
                </tbody>
                <tfoot>
                    <tr>
                        <td>Total</td> 
                        <td>R$ <?php echo number_format($total, 2, ',', '.'); ?></td> 
                    </tr>
                </tfoot>
            </table>
        </div>
        <?php endfor; ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</div>