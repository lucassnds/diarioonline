<?php

include_once("../Conexao.php");

class PontoModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }

    public function BuscarPontos($professor) {

        $sql = "SELECT * FROM ponto WHERE cdProfessor = {$professor} ORDER BY cdPonto DESC";

        return $this->banco->executarQuery($sql);
    }

    public function BuscarNomes($turma, $motivo) {

        $sql = "SELECT nome FROM turma WHERE cdTurma = {$turma}";
        $retorno["turma"] = mysqli_fetch_assoc($this->banco->executarQuery($sql));
        $sql = "SELECT nome FROM descricaoponto WHERE cdDescricaoPonto = {$motivo}";

        $retorno["motivo"] = mysqli_fetch_assoc($this->banco->executarQuery($sql));

        return $retorno;
    }
    public function Motivo(){
        
        $sql = "SELECT * FROM descricaoponto WHERE cdDescricaoPonto != 1";
        
        return $this->banco->executarQuery($sql);
    }
    
    public function CadastrarPonto($ponto){
       
        $sql = "INSERT INTO ponto(numHoras, data, entrada, saida, cdDescricaoPonto, cdProfessor)VALUES"
                . "({$ponto["numHoras"]},'{$ponto["data"]}','{$ponto["entrada"]}','{$ponto["saida"]}',{$ponto["cdDescricao"]},{$ponto["cdProfessor"]} )";
        
               
        return $this->banco->executarQuery($sql);
    }
    public function BuscarNome($motivo) {

        
        $sql = "SELECT nome FROM descricaoponto WHERE cdDescricaoPonto = {$motivo}";

        $retorno["motivo"] = mysqli_fetch_assoc($this->banco->executarQuery($sql));

        return $retorno;
    }
    
        function BuscarAulas($professor) {

        $sql = "SELECT * FROM ponto WHERE ponto.cdProfessor = {$professor}  ORDER BY ponto.cdPonto DESC ";


        return $this->banco->executarQuery($sql);
    }

    function BuscarLIMIT($professor, $inicio, $quantPagina) {

        $sql = "SELECT * FROM ponto WHERE ponto.cdProfessor = {$professor}  ORDER BY ponto.cdPonto DESC LIMIT {$inicio}, {$quantPagina}  ";
        $res = $this->banco->executarQuery($sql);

        return $res;
    }
        function numAulas($sql) {

        $res = $this->banco->numRows($sql);

        return $res;
    }
    

}
