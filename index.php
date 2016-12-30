<?php
session_start();
require 'config.php';
define('HELPERS','core/helpers/');
header("Content-Type: text/html;  charset=utf-8", true);

spl_autoload_register(function ($class) {
    if (file_exists('models/'.$class.'.php')) {
        require_once 'models/'.$class.'.php';
    }
    if (file_exists('core/'.$class.'.php')) {
        require_once 'core/'.$class.'.php';
    }
    if(strpos($class, 'Helper') > -1) {
        if (file_exists(HELPERS.$class.'.php')) {
            require_once HELPERS.$class.'.php';
        } else {
            echo "Não existe nenhum helper no momento";
            die();
        }
    }
});

$core = new Core();
$core->run();