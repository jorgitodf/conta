<?php

class LoginModel extends Model {
    
    public function __construct() {
        parent::__construct(); //executa do contrutor da classe extendida, sou seja, executa o construtor da Classe Model
    }
    
    public function isLogged() {
        
        if (isset($_SESSION['userLogin']) && !empty($_SESSION['userLogin'])) {
            return true;           
        } else {
            return false;          
        }
       
    }    
   
} 