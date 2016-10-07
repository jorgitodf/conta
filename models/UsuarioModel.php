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
  
    public function salvarCadastroUsuario($nomeCompleto, $email, $senha) {
    	
		// Prepara uma sentença para ser executada
		$statement = $this->db->prepare('INSERT INTO tb_usuario (nome, email, senha, data_cadastro) VALUES (:nome, :email, :senha, 
		:data_cadastro)');

		// Filtra os dados e armazena em variáveis (o filtro padrão é FILTER_SANITIZE_STRING que remove tags HTML)
		$nome  = filter_var($nomeCompleto);
		$email = filter_var($email);
		$senha = filter_var($senha);
		$senha = md5($senha);
		date_default_timezone_set('America/Sao_Paulo'); 
		$dataCadastro = date("Y-m-d H:i:s");
		
		// Adiciona os dados acima para serem executados na sentença
		$statement->bindParam(':nome',  $nome);
		$statement->bindParam(':email', $email);
		$statement->bindParam(':senha', $senha);
		$statement->bindParam(':data_cadastro', $dataCadastro);

		if (!$statement->execute()) {
			return false;
		} else {
			return true;
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

