
<div class="container-login login-body">
    <form class="form-login" id="" action="/login/logar" method="post">    
        <h2 class="form-login-heading">Sistema de Controle Financeiro</h2>

        <div class="login-wrap">

            <div class="form-group">
                <input class="form-control input-sm" placeholder="e-mail" name="email" type="text" value="<?php echo!empty($email) ? $email : ''; ?>"/> 
            </div>	

            <div class="form-group">
                <input class="form-control input-sm" placeholder="senha" name="senha" type="password" value="<?php echo!empty($senha) ? $senha : ''; ?>"/>
            </div>	               

            <button class="btn btn-login btn-block" type="submit">Acessar</button>
            <a class="btn btn-cadastro btn-block" style="height: 35px" href="/cadastro" title="Cadastrar">Cadastrar</a>

        </div>
        <?php echo!empty($erroEmail) ? $erroEmail : "" ?><br/>
        <?php echo!empty($erroSenha) ? $erroSenha : "" ?>
        <?php echo!empty($erro_login) ? $erro_login : "" ?>
    </form> 

</div>
