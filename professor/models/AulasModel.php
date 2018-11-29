<?php

include_once("../Conexao.php");

class AulasModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }

    function BuscarNomes($cdTurma, $cdDisciplina) {

        $sql = "SELECT disciplina.Dnome, turma.nome FROM disciplina, turma WHERE disciplina.cdDisciplina = {$cdDisciplina} and turma.cdTurma = {$cdTurma} ";

        return mysqli_fetch_assoc($this->banco->executarQuery($sql));
    }

    function BuscarModulos($cdDisciplina) {

        $sql = "SELECT discimodulo.cdModulo, modulo.nome FROM discimodulo, modulo WHERE discimodulo.cdDisciplina = {$cdDisciplina} and modulo.cdModulo = discimodulo.cdModulo";

        return $this->banco->executarQuery($sql);
    }

    function BuscarModulo($cdModulo) {

        $sql = "SELECT * FROM modulo WHERE  modulo.cdModulo = {$cdModulo}";

        return mysqli_fetch_assoc($this->banco->executarQuery($sql));
    }

    function BuscarAulas($turma, $disciplina) {

        $sql = "SELECT * FROM `aula` WHERE aula.cdTurma = {$turma} and aula.cdDisciplina = {$disciplina}  ORDER BY aula.cdAula DESC ";


        return $this->banco->executarQuery($sql);
    }

    function BuscarLIMIT($turma, $disciplina, $inicio, $quantPagina) {

        $sql = "SELECT * FROM aula WHERE aula.cdTurma = {$turma} and aula.cdDisciplina = {$disciplina} ORDER BY aula.cdAula DESC LIMIT {$inicio}, {$quantPagina}  ";
        $res = $this->banco->executarQuery($sql);

        return $res;
    }

    function VisualizarChamada($aula) {

        $sql = "SELECT nome, status FROM chamada, aluno WHERE chamada.cdAula = {$aula} and aluno.cdAluno = chamada.cdAluno";

        return $this->banco->executarQuery($sql);
    }

    function numAulas($sql) {



        $res = $this->banco->numRows($sql);

        return $res;
    }

    function DadosDaAula($aula) {

        $sql = "SELECT turma.cdTurma, modulo.nome, disciplina.Dnome,disciplina.cdDisciplina, aula.descricao, aula.data, aula.observacao FROM aula, disciplina, modulo, turma WHERE aula.cdDisciplina = disciplina.cdDisciplina and aula.cdModulo = modulo.cdModulo and turma.cdTurma = aula.cdTurma and aula.cdAula = {$aula}";
        return $this->banco->executarQuery($sql);
    }

    function ApagarAula($aula) {
        $sql = "DELETE from chamada Where chamada.cdAula = {$aula}";
        if ($this->banco->executarQuery($sql)) {
            $sql = "DELETE from aula Where aula.cdAula = {$aula}";
            $this->banco->executarQuery($sql);
        }
    }

    function BuscarPeriodo($turma) {

        $sql = "SELECT turma.turno FROM turma WHERE turma.cdTurma = {$turma}";

        return $this->banco->executarQuery($sql);
    }

    function EditarObs($aula, $obs) {

        $sql = "UPDATE aula SET descricao = '{$obs["assunto"]}', cdModulo = {$obs["modulo"]}, observacao = '{$obs["obs"]}' WHERE cdAula = {$aula}";

        if ($this->banco->executarQuery($sql)) {
            $_SESSION["alterar"] = 1;
            
           
        } else {
            $_SESSION["alterar"] = 0;
            
        }

        
    }

}
