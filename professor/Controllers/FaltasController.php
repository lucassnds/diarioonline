<?php

include_once("models/FaltasModel.php");

class FaltasController {

    private $faltasModel;

    public function __construct() {
        $this->faltasModel = new FaltasModel();
    }

    function BuscarNomes($cdTurma, $cdDisciplina) {

        return $this->faltasModel->BuscarNomes($cdTurma, $cdDisciplina);
    }

    function BuscarModulo($cdModulo) {

        return $this->faltasModel->BuscarModulo($cdModulo);
    }

    public function BuscarFaltas($aluno, $disciplina, $modulo, $turma) {


        return $this->faltasModel->BuscarFaltas($aluno, $disciplina, $modulo, $turma);
    }

    public function BuscarFalta($aluno, $disciplina, $modulo, $turma) {


        return $this->faltasModel->BuscarFalta($aluno, $disciplina, $modulo, $turma);
    }

    public function BuscarAlunos($turma) {

        return $this->faltasModel->BuscarAlunos($turma);
    }

    function inverterdata($data) {

        if (count(explode("/", $data)) > 1) {
            return implode("-", array_reverse(explode("/", $data)));
        } elseif (count(explode("-", $data)) > 1) {
            return implode("/", array_reverse(explode("-", $data)));
        }
    }

}
