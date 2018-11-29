<?php

include_once("../Conexao.php");


class ConfigModel {

    private $banco;


    public function __construct() {
       $this->banco = new Conexao();

    }

    function cadastrarAdm($adm){

        $sql = "SELECT login FROM usuario WHERE login = '{$adm['login']}'";
        $retorno = $this->banco->executarQuery($sql);
        $retorno = mysqli_fetch_assoc($retorno);
        if($retorno['login'] == $adm['login']){

          return 0;
        }else{

            $sql = "INSERT INTO usuario(nome, login, senha, cdNivel) VALUES ('{$adm['nome']}','{$adm['login']}','{$adm['senha']}', 1) ";
            if($this->banco->executarQuery($sql)){

              return 1;
            }else{

            }
        }
    }

    public function atualizarAdm($adm) {

        $sql = "UPDATE usuario SET nome = '{$adm['nome']}', senha = '{$adm['senha']}' WHERE cdUsuario = {$adm['cdUsuario']}";
           if($this->banco->executarQuery($sql)){

             return 1;
           }else{
             return 0;
           }
    }


    public function buscarAdms(){

        $sql = "SELECT * FROM usuario WHERE cdNivel = 1";

        return  $this->banco->executarQuery($sql);

    }

    public function buscarAdm($adm){

        $sql = "SELECT * FROM usuario WHERE cdNivel = 1 and nome LIKE '%{$adm['buscar']}%' ";

        return  $this->banco->executarQuery($sql);

    }

    public function numAdms($sql){

      $res =  $this->banco->numRows($sql);
      return $res;
    }

    public function BuscarLIMIT($inicio, $quantPagina){

        $sql = "SELECT * FROM usuario WHERE cdNivel = 1  LIMIT {$inicio}, {$quantPagina} ";
        $res =  $this->banco->executarQuery($sql);

        return $res;
    }

    public function desativarAdm($status, $cdusuario){

      $sql = "UPDATE usuario SET status = {$status} WHERE cdUsuario = {$cdusuario}";

      return  $this->banco->executarQuery($sql);
    }


  }
