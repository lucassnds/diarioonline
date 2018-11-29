<?php
include_once("models/ModuloModel.php");
class ModuloController{
    private $moduloModel;

    public function __construct() {
        $this->moduloModel = new ModuloModel();
    }
    
    function  cadastrarModulo($modulo){
    
        return $this->moduloModel->cadastrarModulo($modulo);
        
    }
    
    function buscarModulos(){
         
         return $this->moduloModel->buscarModulos();
     }
     
     function buscarModulo($modulo){
         
         return $this->moduloModel->buscarModulo($modulo);
     }
             
     function alterarModulo($modulo){
         
         return $this->moduloModel->AlterarModulo($modulo);
     }
     
    function numModulos($res){
         
         return $this->moduloModel->numModulos($res);
     }
     
    function BuscarLIMIT($inicio, $quantPagina){
           
           return $this->moduloModel->BuscarLIMIT($inicio, $quantPagina);
     }
     
    
    
}
