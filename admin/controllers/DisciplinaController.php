<?php

include_once("models/DisciplinaModel.php");

class DisciplinaController{
    private $disciplinaModel;

    public function __construct() {
        $this->disciplinaModel = new DisciplinaModel();
    }
    
    function  cadastrarDisciplina($disciplina, $disciModulo){
    
        return $this->disciplinaModel->cadastrarDisciplina($disciplina, $disciModulo);
        
    }
    
   
    
    function buscarDisciplinas(){
         
         return $this->disciplinaModel->buscarDisciplinas();
     }
     
     function buscarDisciplina($disciplina){
         
         return $this->disciplinaModel->buscarDisciplina($disciplina);
     }
             
     function alterarDisciplina($disciplina, $disciModulos){
         
         return $this->disciplinaModel->AlterarDisciplina($disciplina, $disciModulos);
     }
     
    function numDisciplinas($res){
         
         return $this->disciplinaModel->numDisciplinas($res);
     }
     
    function BuscarLIMIT($inicio, $quantPagina){
           
           return $this->disciplinaModel->BuscarLIMIT($inicio, $quantPagina);
     }
     function buscarModuloDisciplina($cdDisciplina){
         
         return $this->disciplinaModel->buscarModuloDisciplina($cdDisciplina);
     }
    
}   

