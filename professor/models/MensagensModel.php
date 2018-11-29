<?php

include_once("../Conexao.php");

class MensagensModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }
    
    public function MandarMensagem($mensagem){
       
        $sql = "INSERT INTO mensagens( destinatario, remetente,  conteudo, status, dataMensagem) VALUES"
                . "('{$mensagem["destinatario"]}','{$mensagem["remetente"]}','{$mensagem["conteudo"]}', 0, '{$mensagem["data"]}')";
        if($this->banco->executarQuery($sql)){
            
            return 1;
        }  
    }
    
    public function BuscarDestinatario(){
        
        $sql = "SELECT * FROM usuario, professor WHERE usuario.cdUsuario = professor.cdUsuario";
        
        return $this->banco->executarQuery($sql);
        
    }
    
    public function CodigoAluno($aluno){
        
        $sql = "SELECT usuario.cdUsuario FROM usuario, professor WHERE usuario.cdUsuario = professor.cdUsuario and professor.cdProfessor = {$aluno}";
        
        return mysqli_fetch_assoc($this->banco->executarQuery($sql));
    }
    
    public function BuscarMensagem($usuario){
        
        $sql = "SELECT * FROM mensagens WHERE mensagens.destinatario = {$usuario} ORDER BY cdMensagem DESC";
        
        return $this->banco->executarQuery($sql);
    }
    
    public function BuscarNomes($usuario){
        
        $sql = "SELECT * FROM usuario WHERE usuario.cdUsuario = {$usuario}";
        
        $cdNivel = mysqli_fetch_assoc($this->banco->executarQuery($sql));
        
        switch ($cdNivel["cdNivel"]){
            
            case 1:
                $sql = "SELECT nome FROM usuario WHERE usuario.cdUsuario = {$cdNivel["cdUsuario"]}";
                return mysqli_fetch_assoc($this->banco->executarQuery($sql));
           
            case 2:
                $sql = "SELECT nome FROM aluno WHERE aluno.cdUsuario = {$cdNivel["cdUsuario"]}";
                return mysqli_fetch_assoc($this->banco->executarQuery($sql));
            
            case 3:
                $sql = "SELECT nome FROM professor WHERE professor.cdUsuario = {$cdNivel["cdUsuario"]}";
                return mysqli_fetch_assoc($this->banco->executarQuery($sql));
            
            case 4:
                 $sql = "SELECT nome FROM usuario WHERE usuario.cdUsuario = {$cdNivel["cdUsuario"]}";
                return mysqli_fetch_assoc($this->banco->executarQuery($sql));
              
        }
        
    }
    


    function BuscarLIMIT($usuario, $inicio, $quantPagina) {

        $sql = "SELECT * FROM mensagens WHERE mensagens.destinatario = {$usuario} ORDER BY cdMensagem DESC LIMIT {$inicio}, {$quantPagina}  ";
        $res = $this->banco->executarQuery($sql);

        return $res;
    }
        function numAulas($sql) {

        $res = $this->banco->numRows($sql);

        return $res;
    }
    
    
}