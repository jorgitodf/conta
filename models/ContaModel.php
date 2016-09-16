<?php

class ContaModel extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function verificaConta($idUser) {
    	if (isset($idUser) && !empty($idUser)) {
			$stmt = $this->db->prepare("SELECT * FROM tb_conta WHERE fk_id_usuario = ?");
			$stmt->bindValue(1, $idUser, PDO::PARAM_INT);
			$stmt->execute();
			$stmt->fetchAll(PDO::FETCH_ASSOC);    		
			if (!empty($stmt->fetchAll(PDO::FETCH_ASSOC))) {
				return true;				
			} else {
				return false;
			}
		}
	}
	
	public function getBancos() {
		$stmt = $this->db->query("SELECT * FROM tb_banco ORDER BY nome_banco");
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}
    
}    