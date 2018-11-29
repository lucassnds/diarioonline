<?php
include_once("models/TurmasModel.php");

class TurmasController{
    private $turmasaModel;

    public function __construct() {
        $this->turmasaModel = new TurmasModel();
    }

    

  
    function  inverterdata($data){

         if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
    }elseif(count(explode("-",$data)) > 1){
        return implode("/",array_reverse(explode("-",$data)));
    }
    }


    function buscarTurmas($cdProfessor){

        return $this->turmasaModel->BuscarTurmas($cdProfessor);
    }

    function buscarTurma($professor, $turma){

  return $this->turmasaModel->buscarTurma($professor, $turma);

}

    function  turno($turno){

        if($turno == 1 ){
            return "Manhã";
        }

        if($turno == 2 ){
             return "Tarde";
        }

        if($turno == 3 ){
             return "Noite";
        }

    }

    function numTurmas($sql){


        return $this->turmasaModel->numTurmas($sql);

    }


    function BuscarLIMIT($cdProfessor,$inicio, $quantPagina){

        return $this->turmasaModel->BuscarLIMIT($cdProfessor,$inicio, $quantPagina);
    }
    
    
    function BuscarDadosTurma($cdTurma){
          return $this->turmasaModel->BuscarDadosTurma($cdTurma);
        
    }
    
     function BuscarDisciplina($cdDisciplina){
       return $this->turmasaModel->BuscarDisciplina($cdDisciplina);
    }

}
