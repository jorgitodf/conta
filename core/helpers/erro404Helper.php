<?php

class erro404Helper {

    public function erro404 () {
        header("Location: /naoexiste");
        die();
    }
}