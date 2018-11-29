<?php

include_once("../Conexao.php");

class ChamadaModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }

    function BuscarAlunos($cdTurma) {
        $sql = "SELECT turmaaluno.cdAluno, aluno.nome FROM turmaaluno, aluno WHERE turmaaluno.cdturma = {$cdTurma} and aluno.cdAluno = turmaaluno.cdAluno";

        return $this->banco->executarQuery($sql);
    }

    function GravarAula($aulaCompleta, $alunosChamada, $presenca, $indice, $ponto, $professorSub) {

        $sql = "INSERT INTO aula(quantaulas, descricao, data, cdDisciplina, cdModulo, cdTurma, cdProfessor, observacao)"
                . " VAlUES ('{$aulaCompleta['numAulas']}','{$aulaCompleta['assunto']}','{$aulaCompleta['data']}','{$aulaCompleta['disciplina']}','{$aulaCompleta['modulo']}','{$aulaCompleta['turma']}','{$aulaCompleta['professor']}','{$aulaCompleta["obs"]}')";

        echo $sql;    
       if($this->banco->executarQuery($sql)){

        $sql = "SELECT MAX(cdAula) FROM aula";
        $resposta = $this->banco->executarQuery($sql);
        $cdAula = mysqli_fetch_assoc($resposta);


        for ($i = 0; $i < $indice; $i++) {
            $sql = "INSERT INTO chamada ( cdAula, cdAluno, status)"
                    . " VALUES('{$cdAula["MAX(cdAula)"]}', '{$alunosChamada[$i]}', '{$presenca[$i]}' )";
            $this->banco->executarQuery($sql);
        }
        
        if($professorSub["estado"] == 2){
            $sql = "INSERT INTO ponto(data,numHoras, turma, entrada, saida, cdDescricaoPonto, cdProfessor)Values('{$ponto["data"]}',{$ponto["numHoras"]},{$ponto["turma"]},'{$ponto["entrada"]}','{$ponto["saida"]}', {$ponto["desc"]},{$professorSub["professor"]})";
        
        }else{
           $sql = "INSERT INTO ponto(data,numHoras, turma, entrada, saida, cdDescricaoPonto, cdProfessor)Values('{$ponto["data"]}',{$ponto["numHoras"]},{$ponto["turma"]},'{$ponto["entrada"]}','{$ponto["saida"]}', {$ponto["desc"]},{$ponto["professor"]})";
         
        }
        
        $this->banco->executarQuery($sql);
     //  echo '<meta http-equiv="refresh" content="0; ?pagina=turmas" />';
     echo '<script type="text/javascript"> window.location.href = "index.php?pagina=aulas";</script>';
       return 1;
       }else{
        
           return 0;
       }
    }
    
     function GravarNota($aulaCompleta, $alunosChamada, $presenca, $indice, $status) {

        $sql = "INSERT INTO cardeneta(assunto, dataAtividade, cdDisciplina, cdModulo, cdTurma, cdProfessor)"
                . " VAlUES ('{$aulaCompleta['assunto']}','{$aulaCompleta['data']}','{$aulaCompleta['disciplina']}','{$aulaCompleta['modulo']}','{$aulaCompleta['turma']}','{$aulaCompleta['professor']}')";

       if($this->banco->executarQuery($sql)){

        $sql = "SELECT MAX(cdCardeneta) FROM cardeneta";
        $resposta = $this->banco->executarQuery($sql);
        $cdAula = mysqli_fetch_assoc($resposta);


        for ($i = 0; $i < $indice; $i++) {
           
            $sql = "INSERT INTO nota ( cdCardeneta, cdAluno, nota, status)"
                    . " VALUES('{$cdAula["MAX(cdCardeneta)"]}', '{$alunosChamada[$i]}', '{$presenca[$i]}', $status[$i] )";
            $this->banco->executarQuery($sql);
        }
        
     //  echo '<meta http-equiv="refresh" content="0; ?pagina=turmas" />';
     echo '<script type="text/javascript"> window.location.href = "index.php?pagina=notas";</script>';
       return 1;
       }else{
        
           return 0;
       }
    }
    
   
    
  

}
