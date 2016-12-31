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

}
