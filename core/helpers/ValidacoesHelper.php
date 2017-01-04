<?php

class ValidacoesHelper {

    public static function validarData($data) {
        if (empty($data) || $data = "") {
            return true;
        }
    }

    public static function validarMovimentacao($string) {
        if (empty($string) || $string == "") {
            return true;
        }
    }
    public static function validarValor($valor) {
        if (empty($valor) || $valor == "") {
            return true;
        }
    }

    public static function validarCategoria($string) {
        if (empty($string) || $string == "") {
            return true;
        }
    }
    
    public static function validarNumCartao($num) {
        if (empty($num) || $num == "") {
            return $erro = "Preencha o Número do Cartão";
        } elseif (strlen($num) != 16) {
            return $erro = "Número do Cartão deve possuir 16 dígitos";
        }
    }
    
    public static function validarDataValidade($data) {
        if (empty($data) || $data == "") {
            return true;
        }
    }
    
    public static function validarBandeira($bandeira) {
        if (empty($bandeira) || $bandeira == "") {
            return true;
        }
    }

}
