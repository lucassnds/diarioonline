<?php

include_once("../Conexao.php");

class NotasModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }

    function BuscarCardeneta($modulo, $disciplina, $turma) {

        $sql = "SELECT * FROM cardeneta WHERE  cdModulo = {$modulo} and cdDisciplina = {$disciplina} and cdTurma = {$turma} ORDER BY cdCardeneta DESC";

        return $this->banco->executarQuery($sql);
    }

    function num($sql) {

        $res = $this->banco->numRows($sql);


        return $res;
    }

    function BuscarLIMIT($modulo, $disciplina, $turma, $inicio, $quantPagina) {

        $sql = "SELECT * FROM cardeneta WHERE  cdModulo = {$modulo} and cdDisciplina = {$disciplina} and cdTurma = {$turma}  ORDER BY cdCardeneta DESC LIMIT {$inicio}, {$quantPagina}  ";

        $res = $this->banco->executarQuery($sql);

        return $res;
    }

    function BuscarNotas($cardeneta) {

        $sql = "SELECT aluno.nome, nota.nota, nota.cdAluno, nota.cdNota, nota.status FROM nota, aluno  WHERE aluno.cdAluno = nota.cdAluno and nota.cdCardeneta = {$cardeneta}";

        return $this->banco->executarQuery($sql);
    }

    function BuscarAlunos($cdTurma) {
        $sql = "SELECT turmaaluno.cdAluno, aluno.nome FROM turmaaluno, aluno WHERE turmaaluno.cdturma = {$cdTurma} and aluno.cdAluno = turmaaluno.cdAluno";

        return $this->banco->executarQuery($sql);
    }

    function VisualizarCardeneta($cardeneta) {

        $sql = "SELECT * FROM cardeneta WHERE cdCardeneta = {$cardeneta}";
        return $this->banco->executarQuery($sql);
    }

    function EditarNotas($cdNota, $cardeneta, $aluno, $notas, $status, $indice) {

        
        for ($i = 0; $i < $indice; $i++) {
            $sql = "UPDATE nota SET nota = {$notas[$i]}, status = {$status[$i]}  WHERE nota.cdNota = {$cdNota[$i]} and nota.cdCardeneta = {$cardeneta} and nota.cdAluno = {$aluno[$i]}";
          
         $res = $this->banco->executarQuery($sql);
        }
      
        
         echo '<script type="text/javascript"> window.location.href = "index.php?pagina=notas";</script>';
           if($res){
            return 1;
        }else{
            
            return 0;
        }
    }

}
