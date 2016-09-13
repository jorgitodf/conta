$(document).ready(function() {
    $(".quantidade").each(function() {
        $('.quantidade').on("blur", function () {
            var quantidade = $(this).val();
            var valor_unitario = $('.valor_unitario').val();
            var novo_valor = valor_unitario.replace(',', '.')
            var total = 0;
            total = parseFloat(quantidade * novo_valor);
            $(".total").text(total);
        });
    })
});