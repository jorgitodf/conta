
<aside class="container-fluid body_rel_geral col-sm-12 col-lg-12">
    <div class="row-fluid col-sm-5 col-lg-5" id="div_row_form_rel_geral">
        <form method="POST" action="/relatorio/geral" id="form_rel_geral" >  
            <div class="panel panel-info" id="panel_form_rel_geral">
                <div class="panel-heading" id="panel_heading_form_rel_geral">
                    <h3 class="panel-title">Busca por Tipo de Categoria</h3>
                </div>
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="form-group form-group-sm">
                            <input type="hidden" name="idUser" value="<?php echo isset($idUser) ? $idUser : ""; ?>" />
                            <input type="hidden" name="idConta" value="<?php echo isset($idConta) ? $idConta : ""; ?>" />
                            <label for="nome_categoria" class="control-label">Categoria:</label>
                            <select class="form-control input-sm" name="nome_categoria" id="" >
                                <option></option>
                                <?php foreach ($categoria as $value): ?> 
                                    <option <?php echo (isset($nome_categoria) && $value['id_categoria'] == $nome_categoria ? 'selected="selected"' : '') ?> value="<?php echo $value['id_categoria']; ?>"><?php echo $value['nome_categoria']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div> 
                    <div class="row-fluid">
                        <div class="form-group form-group-sm">
                            <label for="ano" class="control-label">Ano:</label>
                            <select class="form-control input-sm" name="ano" id="" >
                                <option></option>
                                <?php foreach ($ano as $value): ?> 
                                    <option <?php echo (isset($anoForm) && $value['ano'] == $anoForm ? 'selected="selected"' : '') ?> value="<?php echo $value['ano']; ?>"><?php echo $value['ano']; ?> </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>   
                    <div class="row-fluid">
                        <div class="form-group form-group-sm" id="div_btn_form_rel_geral">
                            <button type="submit" class="btn btn-primary" id="btn_buscar_rel_geral">Buscar</button>
                        </div>
                        <div class="form-group" id="div_msg_error_rel_geral">
                            <div class="retorno">
                                <span class="msg_error_sem_ajax"><?php echo !empty($erroCat) ? $erroCat : ""; ?></span>
                                <span class="msg_error_sem_ajax"><?php echo !empty($erroAno) ? $erroAno : ""; ?></span>
                            </div>
                        </div>
                    </div>      
                </div>       
            </div>    
        </form>
    </div>
</aside>