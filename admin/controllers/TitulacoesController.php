<?php

include_once("models/TitulacoesModel.php");
class TitulacoesController {
    
     private $titulacoesModel;

    public function __construct() {
        $this->titulacoesModel = new TitulacoesModel();
    }
    
     function buscarTitulacao() {

         return $this->titulacoesModel->buscarTitulacao();
    }

    function atualizarTitulacao($aluno) {

        return $this->titulacoesModel->atualizarTitulacao($aluno);
    }

    function numTitulacao($sql) {

        return $this->titulacoesModel->numTitulacao($sql);
    }

    function BuscarLIMIT($inicio, $quantPagina) {

       
        return $this->titulacoesModel->BuscarLIMIT($inicio, $quantPagina);
    }
    
    
}