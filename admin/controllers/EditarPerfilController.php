<?php
include_once("models/EditarPerfilModel.php");
class EditarPerfilController{
    
    
    private $perfil;
    
    public function __construct() {
        $this->perfil = new EditarPerfilModel();
    }
    
    public function novaSenha($senhas){
       return $this->perfil->novaSenha($senhas); 
    }
    
}