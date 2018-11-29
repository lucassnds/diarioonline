<?php

include_once("../Conexao.php");

class DisciplinaModel {
    
    private $banco;
  

    public function __construct() {
       $this->banco = new Conexao();
       
    }
    
    function cadastrarDisciplina($disciplina, $disciModulos){
        $somaHorario = 0;
        $soma = 0;
       
        if(isset($disciModulos)){ foreach ($disciModulos as $modulos){
            
            $sqlOne = "SELECT modulo.cargaHoraria FROM modulo WHERE modulo.cdModulo = {$modulos}";
          
           $somaHorario = mysqli_fetch_assoc( $this->banco->executarQuery($sqlOne));
          $soma += $somaHorario['cargaHoraria'];
           
        }
        }
        
        $sql=" INSERT INTO disciplina(Dnome, cargaHoraria) VALUES('{$disciplina['nome']}', {$soma})";
        
        if($this->banco->executarQuery($sql)){
            
        $sql="SELECT MAX(cdDisciplina) FROM disciplina";
        $resposta = $this->banco->executarQuery($sql);
        $disciplia = mysqli_fetch_assoc($resposta);
//       
         if(isset($disciModulos)){ foreach ($disciModulos as $modulos){
           
            $sql = "INSERT INTO discimodulo(cdDisciplina, cdModulo) VALUES({$disciplia["MAX(cdDisciplina)"]}, {$modulos})";
             $this->banco->executarQuery($sql);
        }
         }
             return 1;
        
        
        }else{
            return 0;
        }
    
    
    }
    
     function AlterarDisciplina($disciplina, $disciModulos){
         
         $somaHorario = 0;
         $soma = 0;
       
       if(isset($disciModulos)){ foreach ($disciModulos as $modulos){
            
            $sqlOne = "SELECT modulo.cargaHoraria FROM modulo WHERE modulo.cdModulo = {$modulos}";
          
           $somaHorario = mysqli_fetch_assoc( $this->banco->executarQuery($sqlOne));
           $soma += $somaHorario['cargaHoraria'];
           
        }
       }
        $sql ="DELETE FROM `discimodulo` WHERE discimodulo.cdDisciplina = {$disciplina['cdDisciplina']}";
        $this->banco->executarQuery($sql);
        
        $sql = "UPDATE disciplina SET disciplina.Dnome = '{$disciplina['nome']}', disciplina.cargaHoraria = {$soma} WHERE cdDisciplina = {$disciplina['cdDisciplina']} ";
        if($this->banco->executarQuery($sql)){
            
            if(isset($disciModulos)){ foreach ($disciModulos as $modulos){
           
            $sql = "INSERT INTO discimodulo(cdDisciplina, cdModulo) VALUES({$disciplina["cdDisciplina"]}, {$modulos})";
             $this->banco->executarQuery($sql);
        }
            }
            
            return 1;
        }else{
            return 0;
        }
        
     }
     
      function buscarDisciplinas(){
        
        $sql = "SELECT disciplina.Dnome, disciplina.cdDisciplina, disciplina.cargaHoraria FROM disciplina";
        $res =  $this->banco->executarQuery($sql); 
       
        return $res;
        
    }
      function buscarDisciplina($disciplina){
        
        $sql = "SELECT disciplina.Dnome, disciplina.cdDisciplina, disciplina.cargaHoraria  FROM disciplina WHERE disciplina.Dnome LIKE '%{$disciplina['buscar']}%' ";
        $res =  $this->banco->executarQuery($sql); 
      
        return $res;
        
    }
    
    
     function numDisciplinas($sql){
    
        $res =  $this->banco->numRows($sql);
        return $res;
        
    }
    
      function BuscarLIMIT($inicio, $quantPagina){
        
        $sql = "SELECT disciplina.Dnome, disciplina.cdDisciplina, disciplina.cargaHoraria  FROM disciplina LIMIT {$inicio}, {$quantPagina} ";
        $res =  $this->banco->executarQuery($sql);
        
        return $res;
    }
    
    function buscarModuloDisciplina($cdDisciplina){
        
        $sql="select discimodulo.cdDisciplina, discimodulo.cdModulo,  modulo.nome, modulo.cargaHoraria "
                . "from discimodulo, modulo WHERE discimodulo.cdDisciplina = {$cdDisciplina} and modulo.cdModulo = discimodulo.cdModulo ";
                
        $res =  $this->banco->executarQuery($sql);  
        return $res;
                
    }
    
    }