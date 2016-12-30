<?php

class ValidacoesHelper {

    public static function validarData($data) {
        if (empty($data)) {
            $erro = '
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#dataMsgError").html("A Data é obrigatória!");
                    $("#dataMsgError").css("display","block");
                });
            </script>';
            return $erro;
        }
    }

    public static function validarMovimentacao($string) {
        if (empty($string) || $string == "") {
            $erro = '
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#movMsgError").html("A Movimentação é obrigatória!");
                    $("#movMsgError").css("display","block");
                });
            </script>';
            return $erro;
        }
    }
    public static function validarValor($valor) {
        if (empty($valor) || $valor == "") {
            $erro = '
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#valMsgError").html("O Valor é Obrigatório!");
                    $("#valMsgError").css("display","block");
                });
            </script>';
            return $erro;
        }
    }

    public static function validarCategoria($string) {
        if (empty($string) || $string == "") {
            $erro = '
            <script type="text/javascript">
                $(document).ready(function() {
                    $("#catMsgError").html("A Categoria é Obrigatória!");
                    $("#catMsgError").css("display","block");
                });
            </script>';
            return $erro;
        }
    }

}
