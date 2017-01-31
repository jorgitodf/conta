<?php

class ValidacoesHelper {
    
    public static function validarEmail($email) {
        $er = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
	if (!preg_match($er, $email)) {
            $erro = 'O E-mail Está Inválido!';
            return $erro;
        }
    }

    public static function validarData($data) {
        if (empty($data) || $data = "") {
            return true;
        }
    }
    
    public static function validarIntervaloData($data1, $data2) {
        if ($data1 > $data2) {
            return true;
        }
    }
    
    public static function validarCampoVazio($campo) {
        if (empty($campo) || $campo = "") {
            return true;
        }
    }
    
    public static function validarIdVazio($id) {
        if (empty($id) || $id = "") {
            return true;
        }
    }
    
    public static function validarValorMaior($valor1, $valor2) {
        if ($valor1 > $valor2) {
            return true;
        }
    }

    public static function validarMovimentacao($string) {
        if (empty($string) || $string == "") {
            return true;
        }
    }
    
    public static function validarCampoIntegerVazio($campo) {
        if (empty($campo) || $campo == "") {
            return true;
        }
    }
    
    public static function validarCampoDescricao($campo) {
        if (empty($campo) || $campo == "") {
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
    
    public static function validarCartao($cartao) {
        if (empty($cartao) || $cartao == "") {
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
    
    public static function validarBanco($banco) {
        if (empty($banco) || $banco == "") {
            return true;
        }
    }
    
    public static function removeCaracteresValor ($valor) {
        $valor1 = str_replace('.', '', $valor);
        $valor2 = str_replace(',', '.', $valor1);
        $valor3 = trim(str_replace('R$ ', '', $valor2));
        return $valor3;
    }
    
    public static function removeCaracteresValorTotal ($valor) {
        $valor2 = str_replace(',', '.', $valor);
        $valor3 = trim(str_replace('R$ ', '', $valor2));
        return $valor3;
    }

}
