<?php

include_once("models/CoordenadorModel.php");
class CoordenadorController {
    
     private $professorModel;

    public function __construct() {
        $this->professorModel = new CoordenadorModel();
    }
    
    
    function cadastrartitulacao($titulacao){
        
        return $this->professorModel->cadastrarTitulacao($titulacao);
    }
     function buscarTitulacao(){
     
         return $this->professorModel->buscarTitulacao();
     }
     
      function cadastrarprofesor($professor){
          
          if(!isset($professor['nome'])){
              
              return 0;    
          }else if(!isset($professor['login'])){
              return 0;
          }else if(!isset($professor['senha'])){
              return 0;
          
          }else {
     
         return $this->professorModel->cadastrarProfessor($professor);
          }
     }
     
      function buscarProfessores(){
       
        return $this->professorModel->buscarProfessores();
        
    }
    
      function buscarProfessore($professor){
       
        return $this->professorModel->buscarProfessor($professor);
        
    }
    
    function numProfessor($sql){
        
       
        return $this->professorModel->numProfessor($sql);
        
    }
    
    
    function BuscarLIMIT($inicio, $quantPagina){
     
        return $this->professorModel->BuscarLIMIT($inicio, $quantPagina);
    }
    
    function alterarProfessor($professor){
        
        return $this->professorModel->alterarProfessor($professor);
    }
    
    
     function buscarProfessorNivel($nivel){
         
         return $this->professorModel->buscarProfessorNivel($nivel);
     }
     
     function  buscarProfesorTurma($cdProfessor){
         
         return $this->professorModel->buscarProfesorTurma($cdProfessor);
         
     }
     
      function  buscarDisciplinaTurma($cdTurma, $cdProfessor){
          
          return $this->professorModel->buscarDisciplinaTurma($cdTurma, $cdProfessor);
      }

      public function desativarProfessor($status, $cdusuario){

          if($status == 1){
              $status = 0;
          }else{
               $status = 1;
          }
      return  $this->professorModel->desativarProfessor($status, $cdusuario);
      }
    
    
    
    }

