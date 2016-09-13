<?php

class LoginAdminHelper {

    public static function isLoogedAdmin() {
        $logado = new AdminModel();
        if ($logado->isLogged() == false) {
            header("Location: /admin/login");
        }
    }

}