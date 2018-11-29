<?php

include_once("../Conexao.php");

class CursoModel {
    
    private $banco;
  

    public function __construct() {
       $this->banco = new Conexao();
       
    }
    
    function cadastrarCurso($curso, $cursoDisci){
        $somaHorario = 0;
        $soma = 0;
       
       if(isset($cursoDisci)){ foreach ($cursoDisci as $disciplina){
            
            $sqlOne = "SELECT disciplina.cargaHoraria FROM disciplina WHERE disciplina.cdDisciplina = {$disciplina}";
          
           $somaHorario = mysqli_fetch_assoc($this->banco->executarQuery($sqlOne));
          $soma += $somaHorario['cargaHoraria'];
           
          
           
        }
       }
        $sql=" INSERT INTO curso(nome, cargaHoraria) VALUES('{$curso['nome']}', {$soma})";
        
        if($this->banco->executarQuery($sql)){
            
        $sql="SELECT MAX(cdCurso) FROM curso";
        $resposta = $this->banco->executarQuery($sql);
        $cdcurso = mysqli_fetch_assoc($resposta);
//       
       if(isset($cursoDisci)){ foreach ($cursoDisci as $disciplina){
           
            $sql = "INSERT INTO cursodisciplina(cdCurso, cdDisciplina) VALUES({$cdcurso["MAX(cdCurso)"]}, {$disciplina})";
             $this->banco->executarQuery($sql);
       }}
             return 1;
        
        
        }else{
            return 0;
        }
    
    
    }
    
    function AlterarCurso($curso, $cursoDisci){
         
         $somaHorario = 0;
         $soma = 0;
       if(isset($cursoDisci)){
       foreach ($cursoDisci as $disciplina){
            
            $sqlOne = "SELECT disciplina.cargaHoraria FROM disciplina WHERE disciplina.cdDisciplina = {$disciplina}";
          
           $somaHorario = mysqli_fetch_assoc($this->banco->executarQuery($sqlOne));
          $soma += $somaHorario['cargaHoraria'];
           
        
        }
       }
        
        $sql ="DELETE FROM cursodisciplina WHERE cursodisciplina.cdCurso = {$curso['cdCurso']}";
        $this->banco->executarQuery($sql);
        
        $sql = "UPDATE curso SET curso.nome = '{$curso['nome']}', curso.cargaHoraria = {$soma} WHERE cdCurso = {$curso['cdCurso']} ";
        if($this->banco->executarQuery($sql)){
            
           if(isset($cursoDisci)){
               foreach ($cursoDisci as $disciplina){
           
            $sql = "INSERT INTO cursodisciplina(cdCurso, cdDisciplina) VALUES({$curso["cdCurso"]}, {$disciplina})";
             $this->banco->executarQuery($sql);
           }
        }
            
            return 1;
        }else{
            return 0;
        }
        
     }
    
    function buscarCursos(){
        
        $sql = "SELECT curso.nome, curso.cdCurso, curso.cargaHoraria FROM curso ";
        $res =  $this->banco->executarQuery($sql); 
       
        return $res;
        
    }
     function buscarCurso($curso){
        
        $sql = "SELECT curso.nome, curso.cdCurso, curso.cargaHoraria  FROM curso WHERE curso.nome LIKE '%{$curso['buscar']}%' ";
        $res =  $this->banco->executarQuery($sql); 
       
        return $res;
        
    }
      function buscarCursoID($curso){
        
        $sql = "SELECT curso.nome, curso.cdCurso, curso.cargaHoraria  FROM curso WHERE curso.cdCurso = {$curso}";
        $res =  $this->banco->executarQuery($sql); 
       
        return $res;
        
    }
    
    
      function numCursos($sql){
    
        $res =  $this->banco->numRows($sql);
        return $res;
        
    }
    function buscarDisciplinaCurso($cdCurso){
        
        $sql="select cursodisciplina.cdCurso, cursodisciplina.cdDisciplina, disciplina.Dnome, disciplina.cargaHoraria from cursodisciplina, disciplina WHERE cursodisciplina.cdCurso = "
                . "{$cdCurso} and disciplina.cdDisciplina = cursodisciplina.cdDisciplina  ";
                
        $res =  $this->banco->executarQuery($sql);  
        return $res;
                
    }
    
    
       function BuscarLIMIT($inicio, $quantPagina){
        
        $sql = "SELECT curso.nome, curso.cdCurso, curso.cargaHoraria  FROM curso LIMIT {$inicio}, {$quantPagina} ";
        $res =  $this->banco->executarQuery($sql);
        
        return $res;
    }
    
}
