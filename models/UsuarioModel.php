<?php

class UsuarioModel extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function isExiste($email, $senha = '') {
        if (!empty($senha)) {
            $sql = "Select * From usuarios WHERE email = '$email' AND senha = MD5('$senha')";
        } else {
            $sql = "Select * From usuarios WHERE email = '$email'";
        }
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }        
    }
  
    public function criar($nome, $email, $senha) {
        $sql = "Insert Into usuarios SET nome = '$nome', email = '$email', senha = MD5('$senha')";
        $this->db->query($sql);
        return $this->db->lastInsertId();
    }        

    public function getId($email) {
        $idUser = 0;
        $sql = "Select idusuarios From usuarios WHERE email = '$email'";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $sql = $sql->fetch();
            $idUser = $sql['idusuarios'];
        }
        return $idUser;
    }
    
}

