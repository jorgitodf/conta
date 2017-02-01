$(document).ready(function () {

    //CADASTRO DE NOVO USUÁRIO
    $(function () {
        $("#form_cadastro_usuario").submit(function (e) {
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
                        $('.retorno').html('<span class="alert alert-success" id="msgUserCadSucesso">' + retorno.message + '</span>');
                    }
                    else {
                        alert(retorno);
                    }
                },
                fail: function(){
                    alert('ERRO: Falha ao carregar o script.');
                }
            });
        });
    });
   
   
    //CONSULTA DE MOVIMENTAÇÃO POR PERÍODO
    $(function () {
        $("#form_relatorio_periodo").submit(function (e) {
            $(".msgError").html("");
            $(".msgError").css("display", "none");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (retorno) {
                    if (retorno.status === 'error'){
                        $('.retorno').html('<span class="msgError" id="dataMsgError">' + retorno.message + '</span>');
                    } else if (retorno.status === 'success'){
                        $('#div_row_relatorio_periodo').remove();
                        $(retorno.tabela).insertAfter('#aside_consulta');
                    }
                    else {
                        alert(retorno);
                    }
                },
                fail: function(){
                    alert('ERRO: Falha ao carregar o script.');
                }
            });
        });
    });
   
   
    var idConta = $("#idConta").val();
        $.ajax({
            type: "POST",
            url: $('#actionsecond').val(),
            data: {idConta: idConta},
            dataType: 'json',
            success: function (retorno) {
                if (retorno.status === 'sucess' ){
                    //$('.retorno').html('<span class="alert alert-danger" role="alert" id="msg_ret_sem_pgto">' + retorno.message + '</span>');
                    $('#tabela_pgto_agendado').html(retorno.tabela);
                } else {
                    alert(retorno);
                }
            },
            fail: function(){
                alert('ERRO: Falha ao carregar o script.');
            }
        });
    
    var idContaPg = $("#idConta").val();
    setTimeout(function() {
        $.ajax({
            type: "POST",
            url: $('#action').val(),
            data: {idConta: idContaPg},
            dataType: 'json',
            success: function (retorno) {
                if (retorno.status === 'error' ){
                    $('.retorno').html('<span class="alert alert-danger" role="alert" id="msg_ret_sem_pgto">' + retorno.message + '</span>');
                    setTimeout(function() {
                        $('#msg_ret_sem_pgto').remove();
                    }, 10000);
                } else if (retorno.status === 'success'){
                    $('#tabela_pgto_agendado').html(retorno.tabela);
                    $('.retorno').html('<span class="alert alert-success" role="alert" id="msg_ret_com_pgto">' + retorno.message + '</span>');
                    setTimeout(function() {
                        $('#msg_ret_com_pgto').remove();
                    }, 10000);
                } else {
                    alert(retorno);
                }
            },
            fail: function(){
                alert('ERRO: Falha ao carregar o script.');
            }
        });   
    }, 3000);

    
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
    
    
    //FECHAMENTO DE FATURA DE CARTÃO DE CRÉDITO PARA PAGAMENTO
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
        var id_cartao_cre = $('#id_cartao_cre').val();
        var str = $('#subtotal').val();
        var subtotal = replace(str);

        var str = $('#encargos').val();
        var encargos = replace(str);
        if (encargos === "") {
            encargos = 0;
        }
        var str = $('#iof').val();
        var iof = replace(str);
        if (iof === "") {
            iof = 0;
        }
        var str = $('#anuidade').val();
        var anuidade = replace(str);
        if (anuidade === "") {
            anuidade = 0;
        }
        var str = $('#protecao_prem').val();
        var protecao_prem = replace(str);
        if (protecao_prem === "") {
            protecao_prem = 0;
        }
        var str = $('#juros_fat').val();
        var juros_fat = replace(str);
        if (juros_fat === "") {
            juros_fat = 0;
        }
        var str = $('#restante').val();
        var restante = replace(str);
        if (restante === "") {
            restante = 0;
        }
        var total = 0;
        if (subtotal > 0) {
            total = (parseFloat(subtotal) + parseFloat(encargos) + parseFloat(iof) + parseFloat(anuidade) + parseFloat(protecao_prem)
                + parseFloat(juros_fat) + parseFloat(restante));
            var num = arred(total, 2);    
            var n = num.toString();   
            var tot = n.replace('.',',');
        }
        $(".msgError").html("");
        $(".msgError").css("display", "none");
        $.ajax({
            type: "POST",
            url: $('#action').val(),
            data: {id_cartao_cre: id_cartao_cre},
            dataType: 'json',
            success: function (retorno) {
                if (retorno.status === 'error' ){
                    $('.retorno').html('<span class="msgError" id="">' + retorno.message + '</span>');
                } else if (retorno.status === 'success'){
                    var val = retorno.message.toString();
                    var res = val.replace('.',',');
                    $('#restante').val('R$ ' + res);
                } else {
                    alert(retorno);
                }
            },
            fail: function(){
                alert('ERRO: Falha ao carregar o script.');
            }
        });
        $('#valor_total').val('R$ ' + tot);
    });
    
    function replace(str) {
        var encargos = str.replace('R$', '');
        encargos = encargos.replace(',', '.'); 
        return encargos;
    }
    
    function arred(val,casas) { 
        var aux = Math.pow(2,casas);
        return Math.floor(val * aux) / aux;
    }
    
    $(function () {
        $("#form_extrato_periodo").submit(function (e) {
            $(".msgError").html("");
            $(".msgError").css("display", "none");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                dataType: 'json',
                success: function (retorno) {
                    if (retorno.status === 'error' ){
                        $('.retorno').html('<span class="msgError" id="">' + retorno.message + '</span>');
                    } else if (retorno.status === 'success'){
                        $('#panel_extrato_periodo').remove();
                        $('#div_panel_tabela_extrato').html(retorno.divtabela);
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
    
    function arred(d,casas) { 
       var aux = Math.pow(10,casas);
       return Math.floor(d * aux) / aux;
    }
});