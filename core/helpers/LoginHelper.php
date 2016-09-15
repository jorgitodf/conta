<?php

class LoginHelper {

    public static function isLoogedUser() {
        $logado = new LoginModel();
        if ($logado->isLogged() == false) {
            header("Location: /login");
        }
    }

}