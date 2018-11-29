<?php
include_once("../Conexao.php");


class AlunoModel {
    
    private $banco;
  

    public function __construct() {
       $this->banco = new Conexao();
       
    }
    
    function cadastrarAluno($aluno ){
        
           $sql = "INSERT INTO usuario ( login ,  senha,  status, cdNivel) VALUES ('{$aluno['login']}', '{$aluno['senha']}', 1 ,2 )";
           $this->banco->executarQuery($sql);
           
           $sql = "SELECT cdUsuario FROM `usuario` WHERE login = '{$aluno['login']}' ";
           $res =  $this->banco->executarQuery($sql);
          
          $cdUsuario = mysqli_fetch_assoc($res);
          
           
           $sql = "INSERT INTO aluno (nome, cdUsuario) VALUES( '{$aluno['nome']}', {$cdUsuario['cdUsuario']} )";
           
           $res = $this->banco->executarQuery($sql);
           
          
             
    }
    
    function buscarAlunos(){
        
        $sql = "SELECT aluno.nome, aluno.cdAluno, usuario.cdUsuario,usuario.status, usuario.login,usuario.senha FROM aluno, usuario WHERE aluno.cdUsuario = usuario.cdUsuario and usuario.cdNivel = 2    ";
        $res =  $this->banco->executarQuery($sql); 
       
        return $res;
        
    }
    function buscarAluno($aluno, $control){
        
        if($control){
              $sql = "SELECT aluno.nome, aluno.cdAluno, aluno.cdAluno,usuario.senha, usuario.login, usuario.cdUsuario, usuario.status  FROM aluno, usuario WHERE aluno.nome LIKE '%{$aluno['buscar']}%' and aluno.cdUsuario = usuario.cdUsuario";
              $res = $this->banco->executarQuery($sql);
            }else{
                
              $sql = "SELECT aluno.nome, aluno.cdAluno,usuario.senha, usuario.login, usuario.cdUsuario, usuario.status FROM aluno, usuario WHERE usuario.login LIKE '%{$aluno['buscar']}%' and aluno.cdUsuario = usuario.cdUsuario ";
              $res = $this->banco->executarQuery($sql);
            }
       
        return $res;
        
    }
    
    /*SELECT aluno.nome, usuario.login, usuario.senha, situacaoaluno.cdAluno,situacaoaluno.cdModulo,situacaoaluno.media,situacaoaluno.falta, situacaoaluno.cdDisciplina, cardeneta.cdCardeneta,cardeneta.cdModulo, nota.nota from aluno inner JOIN
usuario on  aluno.cdAluno = 2 and usuario.cdUsuario = aluno.cdUsuario inner JOIN situacaoaluno
on situacaoaluno.cdAluno = aluno.cdAluno
inner join cardeneta on cardeneta.cdModulo = situacaoaluno.cdModulo inner JOIN nota ON
nota.cdCardeneta = cardeneta.cdCardeneta and nota.cdAluno = aluno.cdAluno*/
    
    function buscarhistoricoAluno($cdAluno){
        
        $sql = "SELECT * FROM `situacaoaluno` WHERE situacaoaluno.cdAluno = {$cdAluno}";
        
        $res = $this->banco->executarQuery($sql);
        
        
        $sql = "SELECT nota.nota FROM `nota` inner JOIN cardeneta ON cardeneta.cdModulo ="
                . " {$res['modulo']} and nota.cdCardeneta = cardeneta.cdCardeneta and nota.cdAluno = {$cdAluno} ";
        
    }
    

    
 
    function atualizarAluno($aluno){
        
        
 
         
         $sql = "UPDATE usuario SET senha ='{$aluno['senha']}' WHERE  cdUsuario = {$aluno['cdUsuario']}";
        
         $res = $this->banco->executarQuery($sql);

          $sql = " UPDATE aluno SET nome ='{$aluno['nome']}' WHERE cdAluno = {$aluno['cdAluno']}";

           if($this->banco->executarQuery($sql)){
            return 1;

          }else{
            
            return 0;
          }  
        
    }
    
    function numAlunos($sql){
        
       // $sql = "SELECT aluno.nome, usuario.cdUsuario,usuario.status, usuario.login FROM aluno, usuario WHERE aluno.cdUsuario = usuario.cdUsuario and usuario.cdNivel = 2";
        $res =  $this->banco->numRows($sql);
        return $res;
        
    }
    
    
    function BuscarLIMIT($inicio, $quantPagina){
        
        $sql = "SELECT aluno.nome, aluno.cdAluno, aluno.cdAluno, usuario.cdUsuario,usuario.status, usuario.login, usuario.senha FROM aluno, usuario WHERE aluno.cdUsuario = usuario.cdUsuario and usuario.cdNivel = 2 LIMIT {$inicio}, {$quantPagina} ";
        $res =  $this->banco->executarQuery($sql);
        
        return $res;
    }
    
    function buscarDisciplinas($cdTurma, $cdAluno){
        $sql="SELECT cursodisciplina.cdDisciplina, disciplina.nome from cursodisciplina inner JOIN
            curso ON curso.cdCurso = cursodisciplina.cdCurso
            inner join turma
            on {$cdTurma} = curso.cdCurso
            inner JOIN disciplina on disciplina.cdDisciplina = cursodisciplina.cdDisciplina inner join turmaaluno ON
            turmaaluno.cdAluno = {$cdAluno}";
             
        $res =  $this->banco->executarQuery($sql);
       
        return $res;
             
    }
    
    function turmaAluno($cdAluno){
        
            $sql = "SELECT turmaaluno.cdturma, turma.nome from turmaaluno inner join turma 
                on turmaaluno.cdAluno = {$cdAluno} and turma.cdTurma = turmaaluno.cdturma";
            
         $res =  $this->banco->executarQuery($sql);
       
        return $res;    
        
    }
    
    function buscarModulosAluno($cdTurma){ 
        $sql ="SELECT modulo.nome, modulo.cdModulo from modulo, curso, turma, discimodulo where 
modulo.cdModulo = discimodulo.cdModulo and curso.cdCurso = turma.cdCurso and turma.cdTurma = {$cdTurma}";

          
         $res =  $this->banco->executarQuery($sql);
       
        return $res; 
    }
    
    function  buscaProfessorDisciplina($cdTurma){
//        $sql="SELECT professor.nome, disciplina.Dnome, disciplina.cdDisciplina from professor INNER JOIN turma ON
//            turma.cdTurma = {$cdTurma} inner join turmaprofessor on professor.cdProfessor = turmaprofessor.cdProfessor
//            inner join disciplina on disciplina.cdDisciplina = turmaprofessor.disciplina_cdDisciplina ";
        $sql ="SELECT professor.nome, disciplina.Dnome, disciplina.cdDisciplina from professor, turma, turmaprofessor,"
                . " disciplina WHERE turma.cdTurma = {$cdTurma} and turmaprofessor.cdTurma = turma.cdTurma and turmaprofessor.cdProfessor"
                . " = professor.cdProfessor and disciplina.cdDisciplina = turmaprofessor.disciplina_cdDisciplina";
            
        $res =  $this->banco->executarQuery($sql);
       
        return $res; 
        
    }
    
    function numDisciplinas($cdTurma){
        
        $sql="SELECT cdDisciplina from cursodisciplina, turma, curso where turma.cdTurma = {$cdTurma} and turma.curso_cdCurso = "
               ." cursodisciplina.cdCurso and cursodisciplina.cdCurso = curso.cdCurso";
        
          $res =  $this->banco->executarQuery($sql);
          
          $num = $this->banco->numRows($res);
          
          return $num;
    }
    
    function buscarModulos($cdDisciplina){
        $sql="SELECT modulo.nome, modulo.cdModulo from discimodulo, disciplina,  modulo WHERE discimodulo.cdDisciplina = {$cdDisciplina} and"
                . " discimodulo.cdDisciplina = disciplina.cdDisciplina AND modulo.cdModulo = discimodulo.cdModulo";
        
        $res=  $this->banco->executarQuery($sql);
          
       return $res;
    }

    function buscarNotas($cdAluno, $cdModulo, $opcao){
        if($opcao == true){
        $sql="SELECT nota.nota from nota, aluno, cardeneta where aluno.cdAluno = {$cdAluno} and cardeneta.cdCardeneta = nota.cdCardeneta and nota.cdAluno = {$cdAluno}"
        . " and cardeneta.cdModulo = {$cdModulo} ORDER by nota.cdNota LIMIT 1 ";
      }else{
            $sql="SELECT nota.nota from nota, aluno, cardeneta where aluno.cdAluno = {$cdAluno} and cardeneta.cdCardeneta = nota.cdCardeneta and nota.cdAluno = {$cdAluno}"
       . " and cardeneta.cdModulo ={$cdModulo} ORDER BY nota.cdNota LIMIT 1, 1 ";
        }
        
        $res=  $this->banco->executarQuery($sql);
          
       return $res;
    }
    
    function buscarMediaFaltas($cdAluno, $cdModulo){
       
        $sql="select situacaoaluno.media, situacaoaluno.falta from situacaoaluno, modulo"
                . " where situacaoaluno.cdAluno = {$cdAluno} and situacaoaluno.cdModulo = {$cdModulo} ";
        
        $res = $this->banco->executarQuery($sql);
        
        return $res;
    }

    public function desativarAluno($status, $cdusuario){

      $sql = "UPDATE usuario SET status = {$status} WHERE cdUsuario = {$cdusuario}";


      return $this->banco->executarQuery($sql);
      
    }





//    SELECT nota.nota, modulo.nome from nota inner join cardeneta on cardeneta.cdCardeneta = nota.cdCardeneta
//inner join turma ON
//turma.cdTurma = cardeneta.cdTurma inner join turmaaluno ON
//turmaaluno.cdAluno = 1 AND nota.cdAluno = 1 inner join modulo ON
//modulo.cdModulo = cardeneta.cdModulo
    
//    
//    SELECT professor.nome, turmaprofessor.cdDisciplina from professor,
//            turmaprofessor, turma, discimodulo, disciplina where turma.cdTurma = 1 
//            and professor.cdProfessor = turmaprofessor.cdProfessor AND disciplina.cdDisciplina = 
//            turmaprofessor.cdDisciplina and discimodulo.cdModulo = 2

    
//    inner join discimodulo on 
//            discimodulo.cdModulo = {$cdModulo} and discimodulo.cdDisciplina = turmaprofessor.cdDisciplina"
    
}


