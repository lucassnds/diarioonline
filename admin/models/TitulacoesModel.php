<?php

include_once("../Conexao.php");

class TitulacoesModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }

    function buscarTitulacao() {

        $sql = "SELECT * FROM titulacao  ";
        $res = $this->banco->executarQuery($sql);

        return $res;
    }

    function atualizarTitulacao($aluno) {

         $sql = " UPDATE titulacao SET Tnome ='{$aluno['nome']}' WHERE cdTitulacao = {$aluno['cdTitulacao']}";

        if ($this->banco->executarQuery($sql)) {
            return 1;
        } else {

            return 0;
        }
    }

    function numTitulacao($sql) {

         $res = $this->banco->numRows($sql);
        return $res;
    }

    function BuscarLIMIT($inicio, $quantPagina) {

        $sql = "SELECT * FROM titulacao LIMIT {$inicio}, {$quantPagina} ";
        $res = $this->banco->executarQuery($sql);

        return $res;
    }

}
