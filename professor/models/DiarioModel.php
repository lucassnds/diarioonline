<?php

include_once("../Conexao.php");

class DiarioModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }

    public function BuscarTurmas($aluno) {
        $sql = "SELECT turma.cdTurma, turma.curso_cdCurso, turma.nome as nomeTurma, curso.nome as nomeCurso  FROM turma,"
                . " turmaaluno, curso  WHERE turma.cdTurma = turmaaluno.cdTurma and turmaaluno.cdAluno = {$aluno} and curso.cdCurso = turma.curso_cdCurso";

        return $this->banco->executarQuery($sql);
    }

    public function QunatDisciplina($curso) {

        $sql = "SELECT cursodisciplina.cdDisciplina, disciplina.Dnome FROM cursodisciplina, disciplina WHERE cursodisciplina.cdCurso = {$curso} and disciplina.cdDisciplina = cursodisciplina.cdDisciplina";
        return $this->banco->executarQuery($sql);
    }

    function BuscarModulos($cdDisciplina) {

        $sql = "SELECT discimodulo.cdModulo, modulo.nome FROM discimodulo, modulo WHERE discimodulo.cdDisciplina = {$cdDisciplina} and modulo.cdModulo = discimodulo.cdModulo";

        return $this->banco->executarQuery($sql);
    }

    public function BuscarNotas($aluno, $disciplina, $modulo) {
        $sql = "SELECT * FROM cardeneta, nota WHERE cardeneta.cdCardeneta = nota.cdCardeneta and nota.cdAluno = {$aluno} and cardeneta.cdDisciplina = {$disciplina} and cardeneta.cdModulo = {$modulo}";

        return $this->banco->executarQuery($sql);
    }

    public function QuantNotas($aluno, $disciplina, $modulo) {
        $sql = "SELECT COUNT(cardeneta.cdCardeneta)as quantidadeNotas FROM cardeneta, nota WHERE "
                . "cardeneta.cdCardeneta = nota.cdCardeneta and nota.cdAluno = {$aluno}"
                . " and cardeneta.cdDisciplina = {$disciplina} and cardeneta.cdModulo = {$modulo}";
               
        return mysqli_fetch_assoc($this->banco->executarQuery($sql));
    }
    
    public function BuscarFaltas($aluno, $disciplina, $modulo, $turma){
        
            $sql = "SELECT (COUNT(chamada.status) * aula.quantaulas) as faltas FROM chamada, aula WHERE chamada.cdAluno = {$aluno} and aula.cdDisciplina = {$disciplina} and aula.cdModulo = {$modulo} and aula.cdTurma = {$turma} and chamada.cdAula = aula.cdAula and chamada.status != 1";
        
        return mysqli_fetch_assoc($this->banco->executarQuery($sql));
    }

}
