<?php

class CartaoModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public $numero_cartao;
    public $data_validade;
    public $fk_id_bandeira_cartao;
    public $fk_id_usuario;
    
    public function getBandeiras() {
        $stmt = $this->db->query("SELECT * FROM tb_bandeira_cartao ORDER BY bandeira ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function cadastrarCartaoDebito($idUser,$numCartao,$dtValidade,$bandeira) {
        
    }
    
    

}
