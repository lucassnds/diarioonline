<?php

include_once("models/NotasModel.php");

class NotasController {

    private $chamadaModel;

    public function __construct() {
        $this->chamadaModel = new NotasModel();
    }
    
    function BuscarCardeneta($modulo, $disciplina, $turma){
   return $this->chamadaModel->BuscarCardeneta($modulo,  $disciplina, $turma);
        
    }
    
    function BuscarLIMIT($modulo, $disciplina,$turma, $inicio, $quantPagina){

        return $this->chamadaModel->BuscarLIMIT($modulo, $disciplina, $turma, $inicio, $quantPagina);
    }
    
    
    
     function num($sql){

         return $this->chamadaModel->num($sql);
    }
    
     
    function BuscarNotas($cardeneta){
        
        
       return $this->chamadaModel->BuscarNotas($cardeneta);
    }
    
    function BuscarAlunos($cdTurma) {
        
        return $this->chamadaModel->BuscarAlunos($cdTurma);
    }
    
     function VisualizarCardeneta($cardeneta){
        
       
       return $this->chamadaModel->VisualizarCardeneta($cardeneta);
        
    }
    function StatusNota($status){
        if($status == 1){
            return "Presente"; 
        }else{
            return "N/A";
        }
    }
    
    function EditarNotas($cdNota, $cardeneta, $aluno, $notas, $status, $indice){
        
        return $this->chamadaModel->EditarNotas($cdNota, $cardeneta, $aluno, $notas, $status, $indice);
    }
    
}


