<?php

include_once("models/PontoModel.php");
class PontoController {
    
     private $pontoModel;

    public function __construct() {
        $this->pontoModel = new PontoModel();
    }
     function Cadastrodescricaoponto($desc) {
         return $this->pontoModel->Cadastrodescricaoponto($desc);
    }
     function buscardescricaoponto() {

         return $this->pontoModel->buscardescricaoponto();
    }

    function atualizardescricaoponto($aluno) {

        return $this->pontoModel->atualizardescricaoponto($aluno);
    }

    function numdescricaopontoo($sql) {

        return $this->pontoModel->numdescricaoponto($sql);
    }

    function BuscarLIMIT($inicio, $quantPagina) {

       
        return $this->pontoModel->BuscarLIMIT($inicio, $quantPagina);
    }
    
    
}