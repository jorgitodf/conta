<?php

class Core {

    public function run() {
        $url = explode('index.php', $_SERVER['PHP_SELF']);
        $url = end($url);

        $params = array();
        if (!empty($url)) {
            $url = explode('/', $url);
            array_shift($url);  // array_shift remove a primeira chave do array
            
            $currentController = $url[0].'Controller';
            array_shift($url);
            
            if (isset($url[0])) {
                $currentAction = $url[0];
                array_shift($url);
            } else {
                $currentAction = 'index';
            }
            
            if (count($url) > 0) {
                $params = $url;
            }
            
        } else {
            $currentController = 'homeController';
            $currentAction = 'index';
        }

        if (file_exists('controllers/'.$currentController.'.php')) {
            require_once 'controllers/'.$currentController.'.php';
        } else {
            $erro = new erro404Helper();
            $erro->erro404();
        }

        $c = new $currentController();
        call_user_func_array(array($c, $currentAction), $params);
    }
}
