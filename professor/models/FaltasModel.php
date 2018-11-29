<?php

include_once("../Conexao.php");

class FaltasModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }
    
    function BuscarNomes($cdTurma, $cdDisciplina) {

        $sql = "SELECT disciplina.Dnome, turma.nome FROM disciplina, turma WHERE disciplina.cdDisciplina = {$cdDisciplina} and turma.cdTurma = {$cdTurma} ";

        return mysqli_fetch_assoc($this->banco->executarQuery($sql));
    }
    
      function BuscarModulo($cdModulo) {

        $sql = "SELECT * FROM modulo WHERE  modulo.cdModulo = {$cdModulo}";

        return mysqli_fetch_assoc($this->banco->executarQuery($sql));
    }
    
    public function BuscarAlunos($turma){
        $sql = "SELECT turmaaluno.cdAluno, nome FROM turmaaluno, aluno WHERE turmaaluno.cdturma = {$turma} and aluno.cdAluno = turmaaluno.cdAluno"; 
        
        return $this->banco->executarQuery($sql);
    }


    public function BuscarFaltas($aluno, $disciplina, $modulo, $turma){
        
            $sql = "SELECT (COUNT(chamada.status) * aula.quantaulas) as faltas FROM chamada, aula WHERE chamada.cdAluno = {$aluno} and aula.cdDisciplina = {$disciplina} and aula.cdModulo = {$modulo} and aula.cdTurma = {$turma} and chamada.cdAula = aula.cdAula and chamada.status != 1";
        
        return mysqli_fetch_assoc($this->banco->executarQuery($sql));
    }
    
    public function BuscarFalta($aluno, $disciplina, $modulo, $turma){
        
            $sql = "SELECT * FROM chamada, aula WHERE chamada.cdAluno = {$aluno} and aula.cdDisciplina = {$disciplina} and aula.cdModulo = {$modulo} and aula.cdTurma = {$turma} and chamada.cdAula = aula.cdAula and chamada.status != 1 ORDER BY cdChamada DESC";
      
        return $this->banco->executarQuery($sql);
    }
    
    //SELECT * FROM aula WHERE aula.cdDisciplina = 1 and aula.cdModulo = 11 and aula.cdTurma 
    // SQL para buscar cada aulo 
    //SELECT * FROM chamada, aula WHERE chamada.cdAluno = 1 and aula.cdDisciplina = 1 and aula.cdModulo = 11 and aula.cdTurma = 1 and chamada.cdAula = aula.cdAula
    //SELECT COUNT(chamada.status) FROM chamada, aula WHERE chamada.cdAluno = 1 and aula.cdDisciplina = 1 and aula.cdModulo = 11 and aula.cdTurma = 1 and chamada.cdAula = aula.cdAula and chamada.status != 1
    
}