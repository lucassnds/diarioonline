<?php
include_once("models/TurmasModel.php");

class TurmasController{
    private $turmasaModel;

    public function __construct() {
        $this->turmasaModel = new TurmasModel();
    }

    function cadastroTurma($turma, $alunos, $professores){

        return $this->turmasaModel->cadastrarTurma($turma,$alunos, $professores);

    }

    function atualizarTurma($turma){
      
        return $this->turmasaModel->atualizarTurma($turma);

    }

    function  inverterdata($data){

         if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
    }elseif(count(explode("-",$data)) > 1){
        return implode("/",array_reverse(explode("-",$data)));
    }
    }


    function buscarTurmas(){

        return $this->turmasaModel->BuscarTurmas();
    }

    function buscarTurma($turma){

  return $this->turmasaModel->buscarTurma($turma);

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

    function desativarTurma($cdTurma, $status){

        if($status == 1){

            $status = 0;
        }else{
            $status = 1;
        }
        $this->turmasaModel->desativarTurma($cdTurma, $status);
    }

    function numTurmas($sql){


        return $this->turmasaModel->numTurmas($sql);

    }


    function BuscarLIMIT($inicio, $quantPagina){

        return $this->turmasaModel->BuscarLIMIT($inicio, $quantPagina);
    }
    
    function VerificaNomeTurma($nome){
        
        return $this->turmasaModel->VerificaNomeTurma($nome);
    }
    
      function NovoAluno($aluno) {
        
          return $this->turmasaModel->NovoAluno($aluno);
    }

}
