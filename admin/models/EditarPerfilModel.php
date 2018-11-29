<?php
include_once("../Conexao.php");

class EditarPerfilModel{
    
     private $banco;
  

    public function __construct() {
       $this->banco = new Conexao();
       
    }
    
    public function novaSenha($senhas) {
        
        $sql = "SELECT senha FROM usuario WHERE senha = '{$senhas['senha']}' and login = '{$senhas['login']}'";
      
        
           $result = $this->banco->executarQuery($sql);
           
        if($this->banco->numRows($result) <= 0){
            
           return 0;
        }else{
            
            $sql = "UPDATE usuario SET senha = '{$senhas['novasenha']}' WHERE cdUsuario = {$senhas['cdUsuario']}";
             $sql;
            $this->banco->executarQuery($sql);
            
            return 1;
        }
    }
    
    
}
