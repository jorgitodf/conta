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

    $('#btn_novo_credito').click(function () {
        $("#btn_salvar_credito").removeAttr('disabled');
        $("#btn_novo_credito").attr('disabled', 'disabled');
        $("#data_credito").removeAttr('disabled');
        $("#mov_cred").removeAttr('disabled');
        $("#nome_cat_cre").removeAttr('disabled');
        $("#valor_cre").removeAttr('disabled');
        $('#msgCreditadoSucesso').remove();
        $("#data_credito").val("");
        $("#mov_cred").val("");
        $("#nome_cat_cre").val("");
        $("#valor_cre").val("");
    });
    $(function () {
        $("#form_cad_credito").submit(function (e) {
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
                        $('.retorno').html('<span class="msgError" id="dataMsgError">' + retorno.message + '</span>');
                    } else if (retorno.status == 'success'){
                        $('.retorno').html('<span class="alert alert-success" id="msgCreditadoSucesso">' + retorno.message + '</span>');
                        $("#btn_salvar_credito").attr('disabled', 'disabled');
                        $("#btn_novo_credito").removeAttr('disabled');
                        $("#data_credito").attr('disabled', 'disabled');
                        $("#mov_cred").attr('disabled', 'disabled');
                        $("#nome_cat_cre").attr('disabled', 'disabled');
                        $("#valor_cre").attr('disabled', 'disabled');
                    }
                    else {
                        alert(retorno);
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
        $("#banco").removeAttr('disabled');
        $('#msgCadastroCartaoSucesso').remove();
        $("#num_cartao").val("");
        $("#data_validade").val("");
        $("#bandeira").val("");
        $("#banco").val("");
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
                        $("#banco").attr('disabled', 'disabled');
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
    
    $('#btn_nova_fatura').click(function () {
        $("#btn_salvar_nova_fatura").removeAttr('disabled');
        $("#btn_nova_fatura").attr('disabled', 'disabled');
        $("#cartao").removeAttr('disabled');
        $("#data_pagto").removeAttr('disabled');
        $('#msgCadastroFaturaSucesso').remove();
        $("#cartao").val("");
        $("#data_pagto").val("");
    });
    $(function () {
        $("#form_cadastro_fatura_cartao_credito").submit(function (e) {
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
                        $('.retorno').html('<span class="msgError" id="msg_erro_fatura">' + retorno.message + '</span>');
                    } else if (retorno.status == 'success'){
                        //aqui é o código executado caso ocorra tudo ok no cadastro pelo php
                        $('.retorno').html('<span class="alert alert-success" id="msgCadastroFaturaSucesso">' + retorno.message + '</span>');
                        $("#btn_salvar_nova_fatura").attr('disabled', 'disabled');
                        $("#btn_nova_fatura").removeAttr('disabled');
                        $("#btn_debitar_fatura").removeAttr('disabled');
                        $("#cartao").attr('disabled', 'disabled');
                        $("#data_pagto").attr('disabled', 'disabled');
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
    
    $('#btn_nova_lanc_fatura').click(function () {
        $("#btn_salvar_novo_lanc_fatura").removeAttr('disabled');
        $("#btn_nova_lanc_fatura").attr('disabled', 'disabled');
        $("#cartao_fat").removeAttr('disabled');
        $("#data_compra").removeAttr('disabled');
        $("#descricao").removeAttr('disabled');
        $("#valor_compra_fatura").removeAttr('disabled');
        $("#parcela").removeAttr('disabled');
        $('#msgLancamentoFaturaSucesso').remove();
        $("#cartao_fat").val("");
        $("#data_compra").val("");
        $("#descricao").val("");
        $("#valor_compra_fatura").val("");
        $("#parcela").val("");
    });
    $(function () {
        $("#form_deb_fatura_cartao_credito").submit(function (e) {
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
                        $('.retorno').html('<span class="msgError" id="msg_erro_lanc_fatura">' + retorno.message + '</span>');
                    } else if (retorno.status == 'success'){
                        //aqui é o código executado caso ocorra tudo ok no cadastro pelo php
                        $('.retorno').html('<span class="alert alert-success" id="msgLancamentoFaturaSucesso">' + retorno.message + '</span>');
                        $("#btn_salvar_novo_lanc_fatura").attr('disabled', 'disabled');
                        $("#btn_nova_lanc_fatura").removeAttr('disabled');
                        $("#cartao_fat").attr('disabled', 'disabled');
                        $("#data_compra").attr('disabled', 'disabled');
                        $("#descricao").attr('disabled', 'disabled');
                        $("#valor_compra_fatura").attr('disabled', 'disabled');
                        $("#parcela").attr('disabled', 'disabled');
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
    
    $('#btn_limpar_pgto_fatura').click(function () {
        $("#encargos").val("");
        $("#iof").val("");
        $("#anuidade").val("");
        $("#protecao_prem").val("");
        $("#juros_fat").val("");
        $("#restante").val("");
        $("#valor_total").val("");
        $("#valor_pagar").val("");
    });

    $('#btn_novo_pgto_fatura').click(function () {
        $("#btn_novo_pgto_fatura").attr('disabled', 'disabled');
        $("#btn_calcular_fatura").removeAttr('disabled');
        $("#btn_pagar_fatura").removeAttr('disabled');
        $("#btn_limpar_pgto_fatura").removeAttr('disabled');
    });
    $(function () {
        $("#form_fechar_fatura").submit(function (e) {
            var id_cartao_fat = $('#id_cartao_fat').val();
            var encargos = $('#encargos').val();
            var iof = $('#iof').val();
            var anuidade = $('#anuidade').val();
            var protecao_prem = $('#protecao_prem').val();
            var juros_fat = $('#juros_fat').val();
            var restante = $('#restante').val();
            var valor_pagar = $('#valor_pagar').val();
            var valor_total = $('#valor_total').val();
            $(".msgError").html("");
            $(".msgError").css("display", "none");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: {id_cartao_fat: id_cartao_fat, encargos: encargos, iof: iof, anuidade: anuidade, protecao_prem: protecao_prem,
                      juros_fat: juros_fat, restante: restante, valor_pagar: valor_pagar, valor_total: valor_total},
                dataType: 'json',
                success: function (retorno) {
                    if (retorno.status === 'error' ){
                        $('.retorno').html('<span class="msgError" id="">' + retorno.message + '</span>');
                    } else if (retorno.status === 'success'){
                        $('.retorno').html('<span class="alert alert-success" id="msgPagamentoFaturaSucesso">' + retorno.message + '</span>');
                        $("#btn_novo_pgto_fatura").attr('disabled', 'disabled');
                        $("#btn_calcular_fatura").attr('disabled', 'disabled');
                        $("#btn_pagar_fatura").attr('disabled', 'disabled');
                        $("#btn_limpar_pgto_fatura").attr('disabled', 'disabled');
                        $("#encargos").attr('disabled', 'disabled');
                        $("#iof").attr('disabled', 'disabled');
                        $("#anuidade").attr('disabled', 'disabled');
                        $("#protecao_prem").attr('disabled', 'disabled');
                        $("#juros_fat").attr('disabled', 'disabled');
                        $("#restante").attr('disabled', 'disabled');
                        $("#valor_pagar").attr('disabled', 'disabled');
                        $("#valor_total").attr('disabled', 'disabled');
                    } else {
                        alert(retorno);
                    }
                },
                fail: function(){
                    alert('ERRO: Falha ao carregar o script.');
                    // Erro caso o arquivo não seja encontrado ou falhou ao ser carregado.
                }
            });
        });
    });


    $('#btn_calcular_fatura').click(function () {
        var str = $('#subtotal').val();
        var subtotal = str.replace('R$', '');
        var str = $('#encargos').val();
        var encargos = str.replace('R$', '');
        var encargos = encargos.replace(',', '.');
        if (encargos === "") {
            encargos = 0;
        }
        var str = $('#iof').val();
        var iof = str.replace('R$', '');
        var iof = iof.replace(',', '.');
        if (iof === "") {
            iof = 0;
        }
        var str = $('#anuidade').val();
        var anuidade = str.replace('R$', '');
        var anuidade = anuidade.replace(',', '.');
        if (anuidade === "") {
            anuidade = 0;
        }
        var str = $('#protecao_prem').val();
        var protecao_prem = str.replace('R$', '');
        var protecao_prem = protecao_prem.replace(',', '.');
        if (protecao_prem === "") {
            protecao_prem = 0;
        }
        var str = $('#juros_fat').val();
        var juros_fat = str.replace('R$', '');
        var juros_fat = juros_fat.replace(',', '.');
        if (juros_fat === "") {
            juros_fat = 0;
        }
        var str = $('#restante').val();
        var restante = str.replace('R$', '');
        var restante = restante.replace(',', '.');
        if (restante === "") {
            restante = 0;
        }
        var total = 0;
        if (subtotal > 0) {
            total = (parseFloat(subtotal) + parseFloat(encargos) + parseFloat(iof) + parseFloat(anuidade) + parseFloat(protecao_prem)
                + parseFloat(juros_fat) + parseFloat(restante));
        }
        $('#valor_total').val('R$ '+ total);
    });
    
});