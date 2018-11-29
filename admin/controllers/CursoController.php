
<?php

include_once("models/CursoModel.php");

class CursoController{
    private $cursoModel;

    public function __construct() {
        $this->cursoModel = new cursoModel();
    }
    
    function  cadastrarCurso($cruso, $disciModulo){
    
        return $this->cursoModel->cadastrarCurso($cruso, $disciModulo);
        
    }
    
   
    
    function buscarCursos(){
         
         return $this->cursoModel->buscarCursos();
     }
     
     function buscarCurso($curso){
         
         return $this->cursoModel->buscarCurso($curso);
     }
     function buscarCursoID($curso){
         
         return $this->cursoModel->buscarCursoID($curso);
     }
     
             
     function alterarCurso($curso, $disciModulos){
         
         return $this->cursoModel->AlterarCurso($curso, $disciModulos);
     }
     
    function numCursos($res){
         
         return $this->cursoModel->numCursos($res);
     }
     
    function BuscarLIMIT($inicio, $quantPagina){
           
           return $this->cursoModel->BuscarLIMIT($inicio, $quantPagina);
     }
     function buscarDisciplinaCurso($cdCurso){
         
         return $this->cursoModel->buscarDisciplinaCurso($cdCurso);
     }
    
}   



