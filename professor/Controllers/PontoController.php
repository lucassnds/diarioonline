<?php

include_once("models/PontoModel.php");

class PontoController {

    private $pontoModel;

    public function __construct() {
        $this->pontoModel = new PontoModel();
    }

    public function BuscarPontos($professor) {

        return $this->pontoModel->BuscarPontos($professor);
    }

    public function BuscarNomes($turma, $motivo) {

        return $this->pontoModel->BuscarNomes($turma, $motivo);
    }

    public function BuscarNome($motivo) {

        return $this->pontoModel->BuscarNome($motivo);
    }

    public function Motivo() {

        return $this->pontoModel->Motivo();
    }

    public function CadastrarPonto($ponto) {


        return $this->pontoModel->CadastrarPonto($ponto);
    }
    
      function inverterdata($data) {

        if (count(explode("/", $data)) > 1) {
            return implode("-", array_reverse(explode("/", $data)));
        } elseif (count(explode("-", $data)) > 1) {
            return implode("/", array_reverse(explode("-", $data)));
        }
    }
    
     function BuscarAulas($professor) {

        return $this->pontoModel->BuscarAulas($professor);
    }

    function BuscarLIMIT($professor, $inicio, $quantPagina) {

        return $this->pontoModel->BuscarLIMIT($professor, $inicio, $quantPagina);
    }

    function numAulas($sql) {

        return $this->pontoModel->numAulas($sql);
    }

}
