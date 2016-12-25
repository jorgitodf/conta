
<div class="container-fluid div_coint">
    <div class="row">
        <div class="col-md-12" id="div_cab_rel_geral">
            <span>Relatório Geral de Gastos com <?php echo $categoria[0]['nome_categoria'] ?></span>
        </div>
    </div>
    <?php if (isset($gasto_geral_categoria) && !empty($gasto_geral_categoria)): ?>
    <div class="row" id="seg_div_rel_geral">
        <div class="col-md-12">
            <?php 
                foreach ($gasto_geral_categoria as $key => $value) {
                    $dados[] = $key;            
                }
            ?>
            <?php $contArray = count($dados);  ?>
            <?php for ($i = 0; $i < 3; $i++): ?>
            <div class="col-md-4">
                <table class="table table-condensed table-hover" id="table_rel_geral_categoria">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Movimentação</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $total = "" ?>
                    <?php foreach ($gasto_geral_categoria[$dados[$i]] as $key => $value): ?>    
                        <tr>
                            <td><?php echo !empty($value['data']) ? $value['data'] : "00/00/0000"; ?></td>
                            <td><?php echo !empty($value['mov']) ? ucwords(strtolower(mb_convert_case($value['mov'], MB_CASE_TITLE))) : "Sem Movimentação" ; ?></td>
                            <td><?php echo !empty($value['val']) ? $value['val'] : "0,00"; ?></td>
                        </tr>
                        <?php $total += $value['val']; ?>
                    <?php endforeach; ?>    
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Total</td> 
                            <td>R$ <?php echo !empty($total) ? number_format($total, 2, ',', '.') : ""; ?></td> 
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php for ($i = 3; $i < 6; $i++): ?>
            <div class="col-md-4">
                <table class="table table-condensed table-hover" id="table_rel_geral_categoria">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Movimentação</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $total = "" ?>
                    <?php foreach ($gasto_geral_categoria[$dados[$i]] as $key => $value): ?>    
                        <tr>
                            <td><?php echo !empty($value['data']) ? $value['data'] : ""; ?></td>
                            <td><?php echo !empty($value['mov']) ? ucwords(strtolower(mb_convert_case($value['mov'], MB_CASE_TITLE))) : "Sem Movimentação" ; ?></td>
                            <td><?php echo !empty($value['val']) ? $value['val'] : ""; ?></td>
                        </tr>
                        <?php $total += $value['val']; ?>
                    <?php endforeach; ?>    
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Total</td> 
                            <td>R$ <?php echo !empty($total) ? number_format($total, 2, ',', '.') : ""; ?></td> 
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php for ($i = 6; $i < 9; $i++): ?>
            <div class="col-md-4">
                <table class="table table-condensed table-hover" id="table_rel_geral_categoria">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Movimentação</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $total = "" ?>
                    <?php foreach ($gasto_geral_categoria[$dados[$i]] as $key => $value): ?>    
                        <tr>
                            <td><?php echo !empty($value['data']) ? $value['data'] : ""; ?></td>
                            <td><?php echo !empty($value['mov']) ? ucwords(strtolower(mb_convert_case($value['mov'], MB_CASE_TITLE))) : "" ; ?></td>
                            <td><?php echo !empty($value['val']) ? $value['val'] : ""; ?></td>
                        </tr>
                        <?php $total += $value['val']; ?>
                    <?php endforeach; ?>    
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Total</td> 
                            <td>R$ <?php echo !empty($total) ? number_format($total, 2, ',', '.') : ""; ?></td> 
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            <?php for ($i = 9; $i < 12; $i++): ?>
            <div class="col-md-4">
                <table class="table table-condensed table-hover" id="table_rel_geral_categoria">
                    <thead>
                        <tr>
                            <th>Data</th>
                            <th>Movimentação</th>
                            <th>Valor</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php $total = "" ?>
                    <?php foreach ($gasto_geral_categoria[$dados[$i]] as $key => $value): ?>    
                        <tr>
                            <td><?php echo !empty($value['data']) ? $value['data'] : ""; ?></td>
                            <td><?php echo !empty($value['mov']) ? ucwords(strtolower(mb_convert_case($value['mov'], MB_CASE_TITLE))) : "" ; ?></td>
                            <td><?php echo !empty($value['val']) ? $value['val'] : ""; ?></td>
                        </tr>
                        <?php $total += $value['val']; ?>
                    <?php endforeach; ?>    
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2">Total</td> 
                            <td>R$ <?php echo !empty($total) ? number_format($total, 2, ',', '.') : ""; ?></td> 
                        </tr>
                    </tfoot>
                </table>
            </div>
            <?php endfor; ?>
        </div>
    </div>
    <?php endif; ?>
</div>