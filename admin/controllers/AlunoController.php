<?php

include_once("models/AlunoModel.php");
class AlunoController {
    
     private $alunoModel;

    public function __construct() {
        $this->alunoModel = new AlunoModel();
    }
    
    public function Cadastrar($aluno) {

           return $this->alunoModel->cadastrarAluno($aluno);
        
    }
    
    function buscarAlunos(){
        
         return $this->alunoModel->buscarAlunos();
    }
     function atualizarAluno($aluno){
     
         return $this->alunoModel->atualizarAluno($aluno);
    }
     function buscarAluno($aluno){
        
       
        

       $conversao = preg_replace("/[^0-9]/","", $aluno['buscar']);
        if($conversao == NULL){
            $control = true;
            return $this->alunoModel->buscarAluno($aluno, $control);
        }else{
            $aluno['buscar'] = $conversao;
            $control = false;
            return $this->alunoModel->buscarAluno($aluno, $control);
        }
      
    }
    
    function numAlunos($res){
        
         return $this->alunoModel->numAlunos($res);
    }
    
    
    function buscarLIMIT($inicio, $quantPagina){
        
         return $this->alunoModel->BuscarLIMIT($inicio, $quantPagina);
    } 
    
    function buscarDisciplinas($cdTurma,$cdAluno){
        
         return $this->alunoModel->buscarDisciplinas($cdTurma,$cdAluno);
    }
    
    function turmaAluno($cdAluno){
        
        return $this->alunoModel->turmaAluno($cdAluno);
    }
    
    function buscarModulosAluno($cdTurma){
        
        return $this->alunoModel->buscarModulosAluno($cdTurma);
    }
    
    function  buscaProfessorDisciplina($cdTurma){
        
         
         $res = $this->alunoModel->buscaProfessorDisciplina($cdTurma);
        
         return $res;
    }
    
    function  numdisciplinas($cdTurma){
        
         return $this->alunoModel->numDisciplinas($cdTurma);
    
    }
    
    function buscarModulo($cdDisciplina){
        return $this->alunoModel->buscarModulos($cdDisciplina);
    }
    
    function buscarNotas($cdAluno, $cdModulo, $i){
       if($i == 1){
            return $this->alunoModel->buscarNotas($cdAluno, $cdModulo,  true);
      }else{
         
         return $this->alunoModel->buscarNotas($cdAluno, $cdModulo,  False); 
       }
        
    }
    
     function buscarMediaFaltas($cdAluno, $cdModulo){
        return $this->alunoModel->buscarMediaFaltas($cdAluno,$cdModulo);
    }
    

     public function desativarAluno($status, $cdusuario){

          if($status == 1){
              $status = 0;
          }else{
               $status = 1;
          }
      return  $this->alunoModel->desativarAluno($status, $cdusuario);
      }
   
    
}
