<?php

include_once("models/AlunoModel.php");
    
class UsuarioController {

    private $usuarioDAO;

    public function __construct() {
        $this->usuarioDAO = new AlunoModel();
    }

    public function Cadastrar() {

           return $this->usuarioDAO->cadastrarAluno();
        
    }

    public function RetornarUsuarios() {
        
            return $this->usuarioDAO->RetornarUsuarios();
        
    }
    
    public function Autenticar($usuario, $senha){
      
        
       return $this->usuarioDAO->AutenticarUsuario($usuario, $senha);
       
       
       
      
  
    }

}   