<?php

include_once("../Conexao.php");


class usuarioModel {

    private $pdo;
    private $debug;

    public function __construct() {
       $this->pdo = new Conexao();
        $this->debug = true;
    }

    public function Cadastrar($nivel) {
        
            $sql = "INSERT INTO nivel (nome) VALUES ('$nivel')";
        
          $this->pdo->executarQuery($sql);
          
        
    }

    public function RetornarUsuarios() {
   
            $sql = "SELECT * FROM usuario";
        
            $dataTable = $this->pdo->ExecuteQuery($sql);
            $listaUsuario = [];

            foreach ($dataTable as $resultado) {
                 $usuario = new Usuario();
                 $usuario->setCodUsuario($resultado["codUsuario"]);
                 $usuario->setNome($resultado["nome"]);
                 $usuario->setUsuario($resultado["usuario"]);
                 $usuario->setSenha($resultado["senha"]);
                  $usuario->setNivel($resultado["codNivel"]);
               

                $listaUsuario[] = $usuario;
            }

            return $listaUsuario;
       
    }
    
    public function AutenticarUsuario($usuario, $senha) {
        $sql = "SELECT nome, usuario, senha, codNivel  FROM usuario WHERE usuario = '{$usuario}' and senha = '{$senha}' ";

        $autenticar = $this->pdo->ExecuteQueryOneRow($sql);
        if($autenticar != NULL){
             $usu = new Usuario();
            $usu->setNome($autenticar["nome"]);
             $usu->setUsuario($autenticar["usuario"]);
             $usu->setSenha($autenticar["senha"]);
             $usu->setNivel($autenticar["codNivel"]);
             
             return $usu;
        
        }else{
            return null;
        }
       
        
    }

}

?>

