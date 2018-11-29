<?php

include_once("../Conexao.php");

class ModuloModel {
    
    private $banco;
  

    public function __construct() {
       $this->banco = new Conexao();
       
    }
    
    function cadastrarModulo($modulo){
        
        $sql = "INSERT INTO modulo ( nome ,  cargaHoraria, descricao) VALUES ('{$modulo['nome']}', {$modulo['ch']}, '{$modulo['descricao']}')";
        if($this->banco->executarQuery($sql)){
            
            return 1;
        }else{
            return 0;
        }
        
     }
       function AlterarModulo($modulo){
        
        $sql = "UPDATE modulo SET modulo.nome = '{$modulo['nome']}', modulo.cargaHoraria = {$modulo['ch']}, modulo.descricao = '{$modulo['descricao']}' WHERE modulo.cdModulo = {$modulo['cdModulo']} ";
        if($this->banco->executarQuery($sql)){
            
            return 1;
        }else{
            return 0;
        }
        
     }
     
      function buscarModulos(){
        
        $sql = "SELECT modulo.nome, modulo.cdModulo, modulo.cargaHoraria, modulo.descricao FROM modulo";
        $res =  $this->banco->executarQuery($sql); 
       
        return $res;
        
    }
      function buscarModulo($modulo){
        
        $sql = "SELECT modulo.nome, modulo.cdModulo, modulo.cargaHoraria, modulo.descricao FROM modulo WHERE modulo.nome LIKE '%{$modulo['buscar']}%' ";
        $res =  $this->banco->executarQuery($sql); 
       
        return $res;
        
    }
    
    
     function numModulos($sql){
    
        $res =  $this->banco->numRows($sql);
        return $res;
        
    }
    
      function BuscarLIMIT($inicio, $quantPagina){
        
        $sql = "SELECT modulo.nome, modulo.cdModulo, modulo.cargaHoraria, modulo.descricao  FROM modulo LIMIT {$inicio}, {$quantPagina} ";
        $res =  $this->banco->executarQuery($sql);
        
        return $res;
    }
}
