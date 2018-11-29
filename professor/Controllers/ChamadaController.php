<?php

include_once("models/ChamadaModel.php");

class ChamadaController {

    private $chamadaModel;

    public function __construct() {
        $this->chamadaModel = new ChamadaModel();
    }

    function BuscarAlunos($cdTurma) {

        return $this->chamadaModel->BuscarAlunos($cdTurma);
    }

    function GravarAula($aulaCompleta, $alunosChamada, $presenca, $indice, $ponto, $professorSub) {
        
        return $this->chamadaModel->GravarAula($aulaCompleta, $alunosChamada, $presenca, $indice, $ponto, $professorSub);
    }
    
    function GravarNota($aulaCompleta, $alunosChamada, $presenca, $indice, $status) {
        
        return $this->chamadaModel->GravarNota($aulaCompleta, $alunosChamada, $presenca, $indice, $status);
    }
    
  
    
    
    
    

}
