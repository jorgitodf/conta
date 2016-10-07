
<aside class="row-fluid container_cadastro_usuario col-md-12 col-lg-12 col-sm-10 col-xs-10">

    <div class="row-fluid">
        
        <form method="POST" action="" id="form_cadastro_usuario">
            <div class="panel panel-info" id="panel_cadastro">
                <div class="panel-heading" id="panel_heading_cadastro">
                    <h3 class="panel-title">Cadastro de Novo Usuário</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <label class="" for="nomeCompleto">Nome Completo:</label>
                        <input type="text" name="nomeCompleto" id="nomeCompleto" class="form-control input-sm" readonly="true" value="<?php echo !empty($nome) ? $nome : '' ; ?>"/>
                    </div>
                                        
                    <div class="form-group">
                        <label class="" for="email">E-mail:</label>
                        <input type="email" name="email" id="email" class="form-control input-sm" readonly="true" value="<?php echo !empty($email) ? $email : '' ; ?>"/>
                                                
                    </div>
                    
                    <div class="form-group">
                        <label class="" for="senha">Senha:</label>
                        <input type="password" name="senha" id="senha" class="form-control input-sm" value="<?php echo !empty($senha) ? $senha : '' ; ?>"/>
                        
                    </div>
                    
                    <div class="form-group">
                        <a class="btn btn-primary" style="height: 35px" href="/home" title="Fazer Login">Fazer Login</a>
                        <?php echo !empty($msg_sucesso) ? $msg_sucesso : "" ?>
                    </div>
                </div>
            </div>

        </form>
            
    </div>
    
</aside>