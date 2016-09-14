<?php

class UsuarioModel extends Model{
    
    public function __construct() {
        parent::__construct();
    }
    
    public function verificaLoginSenha($email, $senha) {
        $array = array();
        $sql = "SELECT id_usuario, nome, email, senha FROM tb_usuario WHERE email = '$email' AND senha = MD5('$senha')";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchALL(PDO::FETCH_ASSOC);
        }
        return $array;
    }
  
    public function criar($nome, $email, $senha) {
        $sql = "Insert Into tb_usuario SET nome = '$nome', email = '$email', senha = MD5('$senha')";
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

