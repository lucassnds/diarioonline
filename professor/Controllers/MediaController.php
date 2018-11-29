<?php

include_once("models/MediaModel.php");

class MediaController {

    private $mediaModel;

    public function __construct() {
        $this->mediaModel = new mediaModel();
    }

    public function BuscarQuantNotas($disciplina, $modulo, $turma, $professor) {


        return $this->mediaModel->BuscarQuantNotas($disciplina, $modulo, $turma, $professor);
    }

    public function BuscarCardeneta($disciplina, $modulo, $turma, $professor) {


        return $this->mediaModel->BuscarCardeneta($disciplina, $modulo, $turma, $professor);
    }
     public function BuscarCriterio($disciplina, $modulo, $turma, $professor) {


        return $this->mediaModel->BuscarCriterio($disciplina, $modulo, $turma, $professor);
    }
    
     public function BuscarNotas($cardeneta, $aluno){
     
      
      return $this->mediaModel->BuscarNotas($cardeneta, $aluno);
  }
  
    public function InserirCriterio($cardeneta, $criterio){
      
      
          $this->mediaModel->InserirCriterio($cardeneta, $criterio);
      
      
  }

}
