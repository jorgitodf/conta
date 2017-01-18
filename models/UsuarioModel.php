<?php

class UsuarioModel extends Model {

    public function __construct() {
        parent::__construct();
    }

    public function verificaLoginSenha($email, $senha) {
        $array = array();
        $sql = "SELECT id_usuario, nome, email, senha FROM tb_usuario WHERE email = '$email' AND senha = MD5('$senha')";
        $sql = $this->db->query($sql);
        if ($sql->rowCount() > 0) {
            $array = $sql->fetchALL(PDO::FETCH_ASSOC);
            return $array;
        } else {
            return false;
        }
    }
    
    public function getEmail($email) {
        if (!empty($email)) {
            $stmt = $this->db->prepare("SELECT email FROM tb_usuario WHERE email = ?");
            $stmt->bindValue(1, $email, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    }

    public function salvarCadastroUsuario($nomeCompleto, $email, $senha) {
        if (!empty($nomeCompleto) && !empty($email) && !empty($senha)) {
            date_default_timezone_set('America/Sao_Paulo'); 
            $dataCadastro = date("Y-m-d H:i:s");
            try {
                $this->db->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
                $this->db->beginTransaction();
                $stmt = $this->db->prepare("INSERT INTO tb_usuario (nome, email, senha, data_cadastro) "
                    . "VALUES (?, ?, ?, ?)");
                $stmt->bindValue(1, $nomeCompleto, PDO::PARAM_STR);
                $stmt->bindValue(2, $email, PDO::PARAM_STR);
                $stmt->bindValue(3, md5($senha), PDO::PARAM_STR);
                $stmt->bindValue(4, $dataCadastro, PDO::PARAM_STR);
                $stmt->execute();
                $this->db->commit();
                return true;
            } catch (PDOException $exc) {
                $this->db->rollback();
                throw new Exception('ERRO: '.$exc->getMessage());
                return false;
            }
        } else {
            throw new Exception("ERRO: Possui dados vazios.");
            return false;
        }
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
