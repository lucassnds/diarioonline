<?php

include_once("models/MensagensModel.php");

class MensagensController {

    private $MensagensModel;

    public function __construct() {
        $this->MensagensModel = new MensagensModel();
    }

    public function MandarMensagem($mensagem) {

        return $this->MensagensModel->MandarMensagem($mensagem);
    }

    public function BuscarDestinatario() {

        return $this->MensagensModel->BuscarDestinatario();
    }

    public function CodigoAluno($aluno) {

        return $this->MensagensModel->CodigoAluno($aluno);
    }

    public function BuscarMensagem($usuario) {

        return $this->MensagensModel->BuscarMensagem($usuario);
    }

    public function BuscarNomes($usuario) {

        return $this->MensagensModel->BuscarNomes($usuario);
    }

    function inverterdata($data) {

        if (count(explode("/", $data)) > 1) {
            return implode("-", array_reverse(explode("/", $data)));
        } elseif (count(explode("-", $data)) > 1) {
            return implode("/", array_reverse(explode("-", $data)));
        }
    }



    function BuscarLIMIT($professor, $inicio, $quantPagina) {

        return $this->MensagensModel->BuscarLIMIT($professor, $inicio, $quantPagina);
    }

    function numAulas($sql) {

        return $this->MensagensModel->numAulas($sql);
    }

}
