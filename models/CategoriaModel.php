<?php

class CategoriaModel extends Model {
    
    public function __construct() {
        parent::__construct();
    }
    
	public function getCategorias() {
		$stmt = $this->db->query("SELECT * FROM tb_categoria ORDER BY nome_categoria");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}    
    
}    