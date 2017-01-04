$(document).ready(function () {
    $('#btn_novo_agendamento').click(function () {
        $("#btn_salvar_agendamento").removeAttr('disabled');
        $("#btn_novo_agendamento").attr('disabled', 'disabled');
        $("#data_pgto").removeAttr('disabled');
        $("#mov_pgto").removeAttr('disabled');
        $("#categoria_pgto").removeAttr('disabled');
        $("#valor_pgto").removeAttr('disabled');
        $('#msgCadPgtoSucesso').remove();
        $("#data_pgto").val("");
        $("#mov_pgto").val("");
        $("#categoria_pgto").val("");
        $("#valor_pgto").val("");
    });
    $(function () {
        $("#form_cad_agendamento_debito").submit(function (e) {
            $(".msgError").html("");
            $(".msgError").css("display", "none");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (retorno) {
                    if (retorno.status == 'error' ){
                        //aqui é o código executado caso ocorra erros no cadastro pelo php
                        $('#retorno').html('<span class="msgError" id="dataMsgError">' + retorno.message + '</span>');
                    } else if (retorno.status == 'success'){
                        //aqui é o código executado caso ocorra tudo ok no cadastro pelo php
                        $('#retorno').html('<span class="alert alert-success" id="msgCadPgtoSucesso">' + retorno.message + '</span>');
                        $("#btn_salvar_agendamento").attr('disabled', 'disabled');
                        $("#btn_novo_agendamento").removeAttr('disabled');
                        $("#data_pgto").attr('disabled', 'disabled');
                        $("#mov_pgto").attr('disabled', 'disabled');
                        $("#categoria_pgto").attr('disabled', 'disabled');
                        $("#valor_pgto").attr('disabled', 'disabled');
                    }
                    else {
                        alert(retorno);
                        // alert com erro caso não seja um retorno json.
                    }
                },
                fail: function(){
                    alert('ERRO: Falha ao carregar o script.');
                    // Erro caso o arquivo não seja encontrado ou falhou ao ser carregado.
                }
            });
            
            
        });
    });

    $('#btn_editar_pgto_agendado').click(function () {
        $("#btn_salvar_pgto_agendado").removeAttr('disabled');
        $("#btn_editar_pgto_agendado").attr('disabled', 'disabled');
        $("#data_pgto").removeAttr('disabled');
        $("#mov_pgto").removeAttr('disabled');
        $("#categoria_pgto").removeAttr('disabled');
        $("#valor_pgto").removeAttr('disabled');
        $('#msgCadPgtoSucesso').remove();

    });
    $(function () {
        $("#form_editar_agendamento_debito").submit(function (e) {
            $(".msgError").html("");
            $(".msgError").css("display", "none");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (retorno) {
                    if (retorno.status == 'error' ){
                        //aqui é o código executado caso ocorra erros no cadastro pelo php
                        $('#retorno').html('<span class="msgError" id="dataMsgError">' + retorno.message + '</span>');
                    } else if (retorno.status == 'success'){
                        //aqui é o código executado caso ocorra tudo ok no cadastro pelo php
                        $('#retorno').html('<span class="alert alert-success" id="msgCadPgtoSucesso">' + retorno.message + '</span>');
                        $("#btn_salvar_pgto_agendado").attr('disabled', 'disabled');
                        $("#btn_editar_pgto_agendado").removeAttr('disabled');
                        $("#data_pgto").attr('disabled', 'disabled');
                        $("#mov_pgto").attr('disabled', 'disabled');
                        $("#categoria_pgto").attr('disabled', 'disabled');
                        $("#valor_pgto").attr('disabled', 'disabled');
                    }
                    else {
                        alert(retorno);
                        // alert com erro caso não seja um retorno json.
                    }
                },
                fail: function(){
                    alert('ERRO: Falha ao carregar o script.');
                    // Erro caso o arquivo não seja encontrado ou falhou ao ser carregado.
                }
            });
            
            
        });
    });
    
    $('#btn_novo_debito').click(function () {
        $("#btn_salvar_debito").removeAttr('disabled');
        $("#btn_novo_debito").attr('disabled', 'disabled');
        $("#data_debito").removeAttr('disabled');
        $("#movimentacao").removeAttr('disabled');
        $("#nome_categoria").removeAttr('disabled');
        $("#valor").removeAttr('disabled');
        $('#msgDebitadoSucesso').remove();
        $("#data_debito").val("");
        $("#movimentacao").val("");
        $("#nome_categoria").val("");
        $("#valor").val("");
    });
    $(function () {
        $("#form_cad_debito").submit(function (e) {
            $(".msgError").html("");
            $(".msgError").css("display", "none");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (retorno) {
                    if (retorno.status == 'error' ){
                        //aqui é o código executado caso ocorra erros no cadastro pelo php
                        $('.retorno').html('<span class="msgError" id="dataMsgError">' + retorno.message + '</span>');
                    } else if (retorno.status == 'success'){
                        //aqui é o código executado caso ocorra tudo ok no cadastro pelo php
                        $('.retorno').html('<span class="alert alert-success" id="msgDebitadoSucesso">' + retorno.message + '</span>');
                        $("#btn_salvar_debito").attr('disabled', 'disabled');
                        $("#btn_novo_debito").removeAttr('disabled');
                        $("#data_debito").attr('disabled', 'disabled');
                        $("#movimentacao").attr('disabled', 'disabled');
                        $("#nome_categoria").attr('disabled', 'disabled');
                        $("#valor").attr('disabled', 'disabled');
                    }
                    else {
                        alert(retorno);
                        // alert com erro caso não seja um retorno json.
                    }
                },
                fail: function(){
                    alert('ERRO: Falha ao carregar o script.');
                    // Erro caso o arquivo não seja encontrado ou falhou ao ser carregado.
                }
            });
            
            
        });
    });
    
    
    $('#btn_novo_cartao_credito').click(function () {
        $("#btn_salvar_cartao_credito").removeAttr('disabled');
        $("#btn_novo_cartao_credito").attr('disabled', 'disabled');
        $("#num_cartao").removeAttr('disabled');
        $("#data_validade").removeAttr('disabled');
        $("#bandeira").removeAttr('disabled');
        $('#msgCadastroCartaoSucesso').remove();
        $("#num_cartao").val("");
        $("#data_validade").val("");
        $("#bandeira").val("");
    });
    $(function () {
        $("#form_cadastro_cartao_credito").submit(function (e) {
            $(".msgError").html("");
            $(".msgError").css("display", "none");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (retorno) {
                    if (retorno.status == 'error' ){
                        //aqui é o código executado caso ocorra erros no cadastro pelo php
                        $('.retorno').html('<span class="msgError">' + retorno.message + '</span>');
                    } else if (retorno.status == 'success'){
                        //aqui é o código executado caso ocorra tudo ok no cadastro pelo php
                        $('.retorno').html('<span class="alert alert-success" id="msgCadastroCartaoSucesso">' + retorno.message + '</span>');
                        $("#btn_salvar_cartao_credito").attr('disabled', 'disabled');
                        $("#btn_novo_cartao_credito").removeAttr('disabled');
                        $("#num_cartao").attr('disabled', 'disabled');
                        $("#data_validade").attr('disabled', 'disabled');
                        $("#bandeira").attr('disabled', 'disabled');
                    }
                    else {
                        alert(retorno);
                        // alert com erro caso não seja um retorno json.
                    }
                },
                fail: function(){
                    alert('ERRO: Falha ao carregar o script.');
                    // Erro caso o arquivo não seja encontrado ou falhou ao ser carregado.
                }
            });
            
            
        });
    });

});