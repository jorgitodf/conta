
<div class="container-fluid div_coint_form col-md-12">
    <div class="row-fluid col-md-6" id="row_panel_form_rel_geral">
        <form method="POST" action="/relatorio/geral" id="" >
        <div class="panel panel-info" id="panel_form_rel_geral">
            <div class="panel-heading" id="panel_heading_form_rel_geral">
                <h3 class="panel-title">Busca por Tipo de Categoria</h3>
            </div>
            <div class="panel-body">
                <div class="form-group form-group-sm">
                    <input type="hidden" name="idUser" value="<?php echo isset($idUser) ? $idUser : ""; ?>" />
                    <input type="hidden" name="idConta" value="<?php echo isset($idConta) ? $idConta : ""; ?>" />
                    <label for="nome_categoria" class="control-label">Categoria:</label>
                    <select class="form-control input-sm" name="nome_categoria" id="nome_categoria" >
                        <option></option>
                        <?php foreach ($categoria as $value): ?> 
                            <option value="<?php echo $value['id_categoria']; ?>"><?php echo $value['nome_categoria']; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group form-group-sm">
                    <label for="ano" class="control-label">Ano:</label>
                    <select class="form-control input-sm" name="ano" id="" >
                        <option></option>
                        <?php foreach ($ano as $value): ?> 
                            <option value="<?php echo $value['ano']; ?>"><?php echo $value['ano']; ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group form-group-sm">
                    <button type="submit" class="btn btn-primary">Buscar</button>
                    
                </div>
            </div>
        </div>
        </form>    
    </div>
</div>