
<aside class="row body_debito col-sm-12 col-lg-12">
    <div id="div_form_debito">
        <form method="POST" action="/conta/agendar" id="" >
            <div class="panel panel-primary" id="">
                <div class="panel-heading">
                    <h3 class="panel-title">Agendamento de Pagamento</h3>
                </div>
                <div class="panel-body">	
                    <input type="hidden" name="idConta" value="<?php echo $idConta; ?>"/>
                    <div class="form-group form-group-sm">
                        <div class="form-group form-group-sm">
                            <label for="data_credito" class="control-label">Data:</label>
                            <input type="date" name="data_credito" id="data_credito" class="form-control input-sm" value="<?php echo!empty($data_credito) ? $data_credito : ''; ?>"/>
                        </div> 

                        <div class="form-group form-group-sm">
                            <label for="movimentacao" class="control-label">Movimentação:</label>
                            <input type="text" name="movimentacao" id="movimentacao" class="form-control input-sm" value="<?php echo!empty($movimentacao) ? $movimentacao : ''; ?>"/>
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="nome_categoria" class="control-label">Categoria:</label>
                            <select class="form-control input-sm" name="nome_categoria" id="nome_categoria" >
                                <option></option>
                                <?php foreach ($categorias as $categoria): ?> 
                                    <option <?php echo (isset($nome_categoria) && $categoria['id_categoria'] == $nome_categoria ? 'selected="selected"' : '') ?> value="<?php echo $categoria['id_categoria']; ?>"><?php echo $categoria['nome_categoria']; ?> </option>
                                <?php endforeach; ?>
                            </select>  
                        </div>

                        <div class="form-group form-group-sm">
                            <label for="valor" class="control-label">Valor:</label>
                            <input type="text" name="valor" id="valor" class="form-control input-sm" value="<?php echo!empty($valor) ? $valor : ''; ?>"/>
                        </div>  
                    </div> 

                    <div class="form-group div_button_debito">
                        <button type="submit" class="btn btn-primary">Creditar</button>
                    </div>
                    <div class="div_erros">
                        <?php echo!empty($erroCredito) ? $erroCredito : "" ?><br/>
                        <?php echo!empty($erroMovimentacao) ? $erroMovimentacao : "" ?><br/>
                        <?php echo!empty($erroCategoria) ? $erroCategoria : "" ?><br/>
                        <?php echo!empty($erroValor) ? $erroValor : "" ?><br/>
                    </div>
                </div>
            </div>
        </form>	
    </div>
</aside>