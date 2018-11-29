<?php

include_once("models/AulasModel.php");

class AulasController {

    private $aulasModel;

    public function __construct() {
        $this->aulasModel = new AulasModel();
    }

    function BuscarNomes($cdTurma, $cdDisciplina) {

        return $this->aulasModel->BuscarNomes($cdTurma, $cdDisciplina);
    }

    function BuscarModulos($cdDisciplina) {

        return $this->aulasModel->BuscarModulos($cdDisciplina);
    }

    function BuscarModulo($cdModulo) {

        return $this->aulasModel->BuscarModulo($cdModulo);
    }

    function BuscarAulas($turma, $disciplina) {

        return $this->aulasModel->BuscarAulas($turma, $disciplina);
    }

    function BuscarLIMIT($turma, $disciplina, $inicio, $quantPagina) {

        return $this->aulasModel->BuscarLIMIT($turma, $disciplina, $inicio, $quantPagina);
    }

    function VisualizarChamada($aula) {

        return $this->aulasModel->visualizarChamada($aula);
    }

    function numAulas($sql) {

        return $this->aulasModel->numAulas($sql);
    }

    function ConverterPresenca($presenca) {

        if ($presenca == 1) {
            return "Presente";
        } else {
            return "Faltou";
        }
    }

    function DadosDaAula($aula) {

        return $this->aulasModel->DadosDaAula($aula);
    }

    function ApagarAula($aula) {
        return $this->aulasModel->ApagarAula($aula);
    }

    function inverterdata($data) {

        if (count(explode("/", $data)) > 1) {
            return implode("-", array_reverse(explode("/", $data)));
        } elseif (count(explode("-", $data)) > 1) {
            return implode("/", array_reverse(explode("-", $data)));
        }
    }
    
     function BuscarPeriodo($turma) {

        return $this->aulasModel->BuscarPeriodo($turma);
    }
    
       function  EditarObs($aula, $obs){
        
        $this->aulasModel->EditarObs($aula, $obs);
    }

  

}
