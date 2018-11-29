<?php

include_once("models/DiarioModel.php");

class DiarioController {

    private $diarioModel;

    public function __construct() {
        $this->diarioModel = new DiarioModel();
    }

    public function BuscarTurmas($aluno) {

        return $this->diarioModel->BuscarTurmas($aluno);
    }

    public function QunatDisciplina($curso) {

        return $this->diarioModel->QunatDisciplina($curso);
    }
     function BuscarModulos($cdDisciplina) {

        
        return $this->diarioModel->BuscarModulos($cdDisciplina);
    }
    
    public function QuantNotas($aluno, $disciplina, $modulo) {
        return $this->diarioModel->QuantNotas($aluno, $disciplina, $modulo);
    }
      public function BuscarNotas($aluno, $disciplina, $modulo) {
      
        return $this->diarioModel->BuscarNotas($aluno, $disciplina, $modulo);
    }
    public function Maior($quant){
        
        foreach ($quant as $q){
        $test[] = $q["quantidadeNotas"];    
        }
        $maior = $test[0];
        for($i =0; $i< count($test); $i++){
            if($test[$i] > $maior){
                $maior = $test[$i];
            }
        }
       return $maior; 
    }
    
     public function BuscarFaltas($aluno, $disciplina, $modulo, $turma){
       
        return $this->diarioModel->BuscarFaltas($aluno, $disciplina, $modulo, $turma);
    }
    

}
