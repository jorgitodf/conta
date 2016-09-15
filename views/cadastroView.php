
<aside class="row-fluid container_cadastro_usuario col-md-12 col-lg-12 col-sm-10 col-xs-10">

    <div class="row-fluid">
        
        <form method="POST" action="/cadastro/salvar" id="form_cadastro_usuario">
            <div class="panel panel-info" id="panel_cadastro">
                <div class="panel-heading" id="panel_heading_cadastro">
                    <h3 class="panel-title">Cadastro de Novo Usuário</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" for="nomeCompleto">Nome Completo:</label>
                        <input type="text" name="nomeCompleto" id="nomeCompleto" class="form-control input-sm" value="<?php echo !empty($nomeCompleto) ? $nomeCompleto : '' ; ?>"/>
                        <?php echo !empty($erroNomeCompleto) ? $erroNomeCompleto : "" ?>
                    </div>
                    
                                        
                    <div class="form-group">
                        <label class="" for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control input-sm" value="<?php echo !empty($email) ? $email : '' ; ?>"/>
                        <?php echo !empty($erroEmail) ? $erroEmail : "" ?>
                        
                    </div>
                    
                    <div class="form-group">
                        <label class="" for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" class="form-control input-sm" value="<?php echo !empty($senha) ? $senha : '' ; ?>"/>
                        <?php echo !empty($erroSenha) ? $erroSenha : "" ?>
                        
                    </div>
                    
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                    </div>
                </div>
            </div>
            
        </form>
            
    </div>
    
</aside>