$(document).ready(function() {
    $(function() {
        $("#form_cad_agendamento_debito").submit(function(e) {
            $("#dataMsgError").html("");
            $("#dataMsgError").css("display","none");
            $("#movMsgError").html("");
            $("#movMsgError").css("display","none");
            $("#catMsgError").html("");
            $("#catMsgError").css("display","none");
            $("#valMsgError").html("");
            $("#valMsgError").css("display","none");
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: $(this).serialize(),
                success: function(retorno) {
                    beforeSend:$("#retorno").html(retorno);

                }
            });
        });	
    });	


});