<?php

include_once("models/SubstituicaoModel.php");

class SubstituicaoController {

    private $subsModel;

    public function __construct() {
        $this->subsModel = new SubstituicaoModel();
    }

    public function BuscarProfessor() {

        return $this->subsModel->BuscarProfessor();
    }

    public function BuscarTurmas() {

        return $this->subsModel->BuscarTurmas();
    }
    
     public function Substituir($dados) {
        
         return $this->subsModel->Substituir($dados);
    }

}
