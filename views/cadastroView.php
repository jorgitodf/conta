
<aside class="container col-md-12 col-lg-12 col-sm-12">
    <div class="row-fluid col-sm-6 col-md-6 col-lg-6" id="row_cadastro_usuario">
        <form method="POST" action="/cadastro" id="form_cadastro_usuario">
            <div class="panel panel-info" id="panel_cadastro">
                <div class="panel-heading" id="panel_heading_cadastro">
                    <h3 class="panel-title">Cadastro de Novo Usuário</h3>
                </div>
                <div class="panel-body">
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <label class="" for="nomeCompleto">Nome Completo:</label>
                            <input type="text" name="nomeCompleto" id="nomeCompleto" class="form-control input-sm"/>
                        </div>      
                    </div>    
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <label class="" for="email">E-mail:</label>
                            <input type="email" name="email" id="email" class="form-control input-sm"/>
                        </div>      
                    </div>  
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <label class="" for="senha">Senha:</label>
                            <input type="password" name="senha" id="senha" class="form-control input-sm"/>
                        </div>      
                    </div> 
                    <div class="both"></div><br/>
                    <div class="row-fluid">
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="">
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                        <div class="form-group form-group-sm col-sm-12 col-md-12 col-lg-12" id="div_msgs_error_cad_novo_user">
                            <div class="retorno"></div>
                        </div>
                    </div>    
                </div>    
            </div>    
        </form>
    </div>
</aside>