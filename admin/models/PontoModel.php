<?php

include_once("../Conexao.php");

class PontoModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }

    function Cadastrodescricaoponto($desc) {
        $sql = "INSERT INTO descricaoponto(nome)VALUES('{$desc}')";

        if ($this->banco->executarQuery($sql)) {
            return 1;
        }
    }

    function buscardescricaoponto() {

        $sql = "SELECT * FROM descricaoponto  ";
        $res = $this->banco->executarQuery($sql);

        return $res;
    }

    function atualizardescricaoponto($aluno) {

        $sql = " UPDATE descricaoponto SET nome ='{$aluno['nome']}' WHERE cdDescricaoPonto = {$aluno['cdDescricaoPonto']}";

        if ($this->banco->executarQuery($sql)) {
            return 1;
        } else {

            return 0;
        }
    }

    function numdescricaoponto($sql) {

        $res = $this->banco->numRows($sql);
        return $res;
    }

    function BuscarLIMIT($inicio, $quantPagina) {

        $sql = "SELECT * FROM descricaoponto LIMIT {$inicio}, {$quantPagina} ";
        $res = $this->banco->executarQuery($sql);

        return $res;
    }

}
