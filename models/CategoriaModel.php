<?php

class CategoriaModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function getCategorias() {
        $stmt = $this->db->query("SELECT * FROM tb_categoria ORDER BY nome_categoria");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function getCategoriasNome($categoria) {
        if (isset($categoria) && !empty($categoria)) {
            $stmt = $this->db->prepare("SELECT nome_categoria FROM tb_categoria WHERE id_categoria = ?");
            $stmt->bindValue(1, $categoria, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

}
