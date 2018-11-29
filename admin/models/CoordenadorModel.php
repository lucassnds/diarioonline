<?php

include_once("../Conexao.php");


class CoordenadorModel {
    
    private $banco;
  

    public function __construct() {
       $this->banco = new Conexao();
       
    }


     function desativarProfessor($status, $cdUsuario){

         
         $sql = "UPDATE usuario SET status = {$status} WHERE cdUsuario = {$cdUsuario}";
       
         $res = $this->banco->executarQuery($sql);
    
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
              
           $sql = "INSERT INTO usuario ( login , nome,  senha,  status, cdNivel) VALUES ('{$professor['login']}','{$professor['nome']}', '{$professor['senha']}', 1 ,5 )";
           $this->banco->executarQuery($sql);
           
        
           return 1;
           
          }else{
              
              return 0;
          }
    }
    
    
    
     function buscarProfessores(){
        
        $sql = "SELECT * FROM usuario WHERE  usuario.cdNivel = 5  ";
        $res =  $this->banco->executarQuery($sql); 
       
        return $res;
        
    }
    
    function numProfessor($sql){
        
       // $sql = "SELECT aluno.nome, usuario.cdUsuario,usuario.status, usuario.login FROM aluno, usuario WHERE aluno.cdUsuario = usuario.cdUsuario and usuario.cdNivel = 2";
        $res =  $this->banco->numRows($sql);
        return $res;
        
    }
    
    
    function BuscarLIMIT($inicio, $quantPagina){
        
        $sql = "SELECT * FROM usuario WHERE  usuario.cdNivel = 5  LIMIT {$inicio}, {$quantPagina} ";
       
        $res =  $this->banco->executarQuery($sql);
        
        return $res;
    }
    
    
    function alterarProfessor($professor){
    
             $sql = "UPDATE usuario SET usuario.nome = '{$professor['nome']}', usuario.senha =  '{$professor['senha']}'  WHERE usuario.cdUsuario = {$professor['cdUsuario']}  and usuario.cdNivel = 5";
             
            if($this->banco->executarQuery($sql)){
                
                return 1;
            }else{
                return 0;
            }
      
       
        }
     function buscarProfessor($professor){
       
         $sql = "SELECT * FROM  usuario WHERE  usuario.cdNivel = 5 and usuario.nome LIKE '%{$professor['buscar']}%' ";
          $res =  $this->banco->executarQuery($sql);
        
        return $res;
        
     }
     
  
}



