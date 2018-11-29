<?php

include_once("../Conexao.php");


class TurmasModel {

    private $banco;


    public function __construct() {
       $this->banco = new Conexao();

    }

    function cadastrarTurma($turma, $aluno, $professor){

        $sql="INSERT INTO `turma`( `nome`, `dataInicio`, `vagas`, `dataTermino`, `turno`, `curso_cdCurso`)"
                . " VALUES ('{$turma['nome']}', '{$turma['dataI']}', {$turma['vagas']}, '{$turma['dataT']}', {$turma['turno']}, {$turma['cdCurso']})";

      if($this->banco->executarQuery($sql)){

        $sql= "SELECT MAX(cdTurma) FROM `turma` ";

        $resposta = $this->banco->executarQuery($sql);
        $cdTurma = mysqli_fetch_assoc($resposta);

        foreach ($aluno as $alunoTurma){

        $sql = "INSERT INTO usuario ( login ,  senha,  status, cdNivel) VALUES ('{$alunoTurma['matricula']}', '{$alunoTurma['senha']}', 1 ,2 )";
        $this->banco->executarQuery($sql);

         $sql = "SELECT cdUsuario FROM `usuario` WHERE login = '{$alunoTurma['matricula']}' ";
         $res =  $this->banco->executarQuery($sql);

         $cdUsuario = mysqli_fetch_assoc($res);


         $sql = "INSERT INTO aluno (nome, cdUsuario) VALUES( '{$alunoTurma['nome']}', {$cdUsuario['cdUsuario']} )";

         $res = $this->banco->executarQuery($sql);

         $sql = "SELECT MAX(cdAluno) FROM aluno";

         $res = $this->banco->executarQuery($sql);

         $cdAluno = mysqli_fetch_assoc($res);



         $sql = "INSERT INTO turmaaluno(cdAluno, cdTurma) VALUES ({$cdAluno['MAX(cdAluno)']}, {$cdTurma['MAX(cdTurma)']})";

         $this->banco->executarQuery($sql);
        }

        foreach ($professor as $prof){
            $sql = "INSERT INTO turmaprofessor(cdTurma, cdProfessor, disciplina_cdDisciplina)Values({$cdTurma["MAX(cdTurma)"]},{$prof["cdProfessor"]},{$prof["cdDisciplina"]})";


            $this->banco->executarQuery($sql);

        }

        return 1;
      }else{

        return 0;
      }


    }
    
    function NovoAluno($aluno) {
        
         $sql = "INSERT INTO usuario ( login ,  senha,  status, cdNivel) VALUES ('{$aluno['matricula']}', '{$aluno['senha']}', 1 ,2 )";
        if($this->banco->executarQuery($sql)){

         $sql = "SELECT cdUsuario FROM `usuario` WHERE login = '{$aluno['matricula']}' ";
         $res =  $this->banco->executarQuery($sql);

         $cdUsuario = mysqli_fetch_assoc($res);


         $sql = "INSERT INTO aluno (nome, cdUsuario) VALUES( '{$aluno['nome']}', {$cdUsuario['cdUsuario']} )";

         $res = $this->banco->executarQuery($sql);

         $sql = "SELECT MAX(cdAluno) FROM aluno";

         $res = $this->banco->executarQuery($sql);

         $cdAluno = mysqli_fetch_assoc($res);



         $sql = "INSERT INTO turmaaluno(cdAluno, cdTurma) VALUES ({$cdAluno['MAX(cdAluno)']}, {$aluno['turma']})";

         $this->banco->executarQuery($sql);
         
         return 1;
        }else{
            return 0;
        }
    }

    function atualizarTurma($turma){

        $sql = "UPDATE turma SET dataInicio = '{$turma['dataI']}', dataTermino = '{$turma['dataT']}', turno ='{$turma['turno']}' WHERE cdTurma = {$turma['cdTurma']}";
        
        if($this->banco->executarQuery($sql)){
          return 1;
        }else{
          return 0;
        }
    }

    function BuscarTurmas(){

        $sql = "SELECT * FROM turma";
        return $this->banco->executarQuery($sql);
    }

    function buscarTurma($turma){

      $sql = "SELECT * FROM turma WHERE turma.nome LIKE '%{$turma['buscar']}%' ";


       $res =  $this->banco->executarQuery($sql);

     return $res;

  }

     function desativarTurma($cdTurma, $status){

        $sql = "UPDATE turma SET turma.status = {$status} WHERE cdTurma = {$cdTurma}";

        return $this->banco->executarQuery($sql);
    }


    function numTurmas($sql){

       // $sql = "SELECT aluno.nome, usuario.cdUsuario,usuario.status, usuario.login FROM aluno, usuario WHERE aluno.cdUsuario = usuario.cdUsuario and usuario.cdNivel = 2";
        $res =  $this->banco->numRows($sql);
        return $res;

    }


    function BuscarLIMIT($inicio, $quantPagina){

        $sql = "SELECT * FROM turma  LIMIT {$inicio}, {$quantPagina} ";
        $res =  $this->banco->executarQuery($sql);

        return $res;
    }
    
    function VerificaNomeTurma($nome){
        
        $sql = "SELECT turma.nome FROM turma WHERE turma.nome = '{$nome}'";

       $res = $this->banco->executarQuery($sql);
     
       if(mysqli_num_rows($res) > 0){
           
          return 1; 
       }else{
           
           return 0;
       }
        
    }



}
