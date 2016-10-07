<?php

class Model {

    protected $db;
  
    public function __construct() {
        global $config;
		try {
			$this->db = new PDO("mysql:dbname=".$config['dbname'].";host=".$config['host'], $config['dbuser'], $config['dbpass']);
			$this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $ex) {
			if ($ex->getCode() == 1049) {
				echo "O Banco de Dados <b>".$config['dbname']."</b> não Existe...";
				exit;
			}
		}
    }

}