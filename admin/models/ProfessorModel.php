<?php

include_once("../Conexao.php");


class ProfessorModel {
    
    private $banco;
  

    public function __construct() {
       $this->banco = new Conexao();
       
    }
    
    function  cadastrarTitulacao($titulacao){
        
        $sql=" INSERT INTO titulacao(Tnome)VALUES( '{$titulacao}')";
        
        if($this->banco->executarQuery($sql)){
            
            return 1;
            
        }else{
            return 0;
        }
        
    }

     function desativarProfessor( $status, $cdUsuario){

         
         $sql = "UPDATE usuario SET status = {$status} WHERE cdUsuario = {$cdUsuario}";
       
         $res = $this->banco->executarQuery($sql);
    
    }
    
    
    function buscarTitulacao(){
        $sql = "SELECT * FROM titulacao";
        
        $res = $this->banco->executarQuery($sql);
        
        return $res;
    }
    
    function cadastrarProfessor($professor){
        
           $sql ="SELECT usuario.login FROM usuario";
           $r = false;
          $auten = $this->banco->executarQuery($sql);
          
          while($com = mysqli_fetch_assoc($auten)){
              
              if($professor['login'] == $com['login']){
                  $r = true;
              }
          }
        
          if($r == false){
              
           $sql = "INSERT INTO usuario ( login ,  senha,  status, cdNivel) VALUES ('{$professor['login']}', '{$professor['senha']}', 1 ,3 )";
           $this->banco->executarQuery($sql);
           
           $sql = "SELECT cdUsuario FROM `usuario` WHERE login = '{$professor['login']}' ";
           $res =  $this->banco->executarQuery($sql);
          
          $cdUsuario = mysqli_fetch_assoc($res);    
          
         
           $sql = " INSERT INTO professor (nome, cdUsuario, cdTitulacao) VALUES( '{$professor['nome']}', {$cdUsuario['cdUsuario']}, {$professor['titulacao']} )";
          
            $this->banco->executarQuery($sql);
           
           return 1;
           
          }else{
              
              return 0;
          }
    }
    
    
    
     function buscarProfessores(){
        
        $sql = "SELECT professor.nome, professor.cdProfessor, usuario.cdUsuario, usuario.status, usuario.login, usuario.senha, titulacao.Tnome, titulacao.cdTitulacao FROM professor, usuario, titulacao WHERE professor.cdUsuario = usuario.cdUsuario and usuario.cdNivel = 3 and titulacao.cdTitulacao = professor.cdTitulacao ";
        $res =  $this->banco->executarQuery($sql); 
       
        return $res;
        
    }
    
    function numProfessor($sql){
        
       // $sql = "SELECT aluno.nome, usuario.cdUsuario,usuario.status, usuario.login FROM aluno, usuario WHERE aluno.cdUsuario = usuario.cdUsuario and usuario.cdNivel = 2";
        $res =  $this->banco->numRows($sql);
        return $res;
        
    }
    
    
    function BuscarLIMIT($inicio, $quantPagina){
        
        $sql = "SELECT professor.nome, professor.cdProfessor, usuario.cdUsuario, usuario.status, usuario.login, usuario.senha, titulacao.Tnome, titulacao.cdTitulacao FROM professor, usuario, titulacao WHERE professor.cdUsuario = usuario.cdUsuario and usuario.cdNivel = 3 and titulacao.cdTitulacao = professor.cdTitulacao  LIMIT {$inicio}, {$quantPagina} ";
        $res =  $this->banco->executarQuery($sql);
        
        return $res;
    }
    
    
    function alterarProfessor($professor){
        
        $sql="UPDATE professor set professor.nome = '{$professor['nome']}', professor.cdTitulacao = {$professor['cdTitulacao']} WHERE professor.cdProfessor = {$professor['cdProfessor']}";
       
        if($this->banco->executarQuery($sql)){
             $sql = "UPDATE usuario SET usuario.senha =  '{$professor['senha']}'  WHERE usuario.cdUsuario = {$professor['cdUsuario']}  and usuario.cdNivel = 3";
             
            if($this->banco->executarQuery($sql)){
                
                return 1;
            }else{
               
            }
        }else{
            return 0;
        }
       
        }
     function buscarProfessor($professor){
       
         $sql = "SELECT professor.nome, professor.cdProfessor, usuario.cdUsuario, usuario.status, usuario.login, usuario.senha, titulacao.Tnome, titulacao.cdTitulacao FROM professor, usuario, titulacao"
                 . " WHERE professor.cdUsuario = usuario.cdUsuario and usuario.cdNivel = 3 and titulacao.cdTitulacao = professor.cdTitulacao and professor.nome LIKE '%{$professor['buscar']}%' ";
          $res =  $this->banco->executarQuery($sql);
        
        return $res;
        
     }
     
      function buscarProfessorNivel($nivel){
       
          $sql = "SELECT professor.nome, professor.cdProfessor FROM professor WHERE professor.cdTitulacao  = {$nivel} ";
          $res =  $this->banco->executarQuery($sql);
        
        return $res;
        
     }
     
     function  buscarProfesorTurma($cdProfessor){
      
         $sql = "SELECT turmaprofessor.cdTurma, turma.nome, turma.cdTurma FROM `turmaprofessor`, "
                 . "turma WHERE turmaprofessor.cdProfessor = {$cdProfessor} and turma.cdTurma =turmaprofessor.cdTurma ";
     
         return $this->banco->executarQuery($sql);
         
        }
        
        function  buscarDisciplinaTurma($cdTurma, $cdProfessor){
            
            $sql="SELECT disciplina.Dnome from disciplina, turmaprofessor where turmaprofessor.cdProfessor = {$cdProfessor} and turmaprofessor.cdTurma = {$cdTurma} and disciplina.cdDisciplina = turmaprofessor.disciplina_cdDisciplina ";
            
            return $this->banco->executarQuery($sql);
            
            }
}

