
<div class="container col-sm-12 col-md-12 col-lg-12">
    <div class="row">
        <form class="form-login" id="form_login" action="/login/logar" method="post">    
            <h2 class="form-login-heading">Sistema de Controle Financeiro</h2>
            <div class="login-wrap">
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="Insira seu E-mail" name="email" type="text" value="<?php echo!empty($email) ? $email : ''; ?>"/> 
                </div>	
                <div class="form-group">
                    <input class="form-control input-sm" placeholder="Insira sua Senha" name="senha" type="password" value="<?php echo!empty($senha) ? $senha : ''; ?>"/>
                </div>	               
                <button class="btn btn-success" type="submit" id="btn_acessar">Acessar</button>
                <a class="btn btn-primary" id="btn_cadastro" href="/cadastro" title="Cadastrar">Cadastrar</a>
            </div>
            <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                <?php echo!empty($erroEmail) ? $erroEmail : "" ?><br>
                <?php echo!empty($erroSenha) ? $erroSenha : "" ?>
                <?php echo!empty($erro_login) ? $erro_login : "" ?>
            </div>
        </form> 
    </div>
</div>
