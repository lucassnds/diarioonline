<?php

include_once("../Conexao.php");

class FolhaPontosModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }

    public function BuscarProf() {

        $sql = "SELECT cdProfessor, nome FROM professor";
        return $this->banco->executarQuery($sql);
    }

    public function BuscarPonto($mes, $cdProfessor, $cdDesc) {
        $ano = date("Y");

        $sql = "SELECT * FROM descricaoponto";


        $sql = "Select SUM(numHoras) as 'horas', ponto.status, ponto.cdProfessor, professor.nome, ponto.cdDescricaoPonto From ponto, professor WHERE Month(data) = {$mes} and Year(data)  = {$ano} and ponto.cdProfessor = $cdProfessor and ponto.cdProfessor = professor.cdProfessor and cdDescricaoPonto = {$cdDesc}";

        $ponto = mysqli_fetch_assoc($this->banco->executarQuery($sql));


        return $ponto;
    }

    public function BuscarDescPonto() {

        $sql = "SELECT * FROM descricaoponto";

        return $this->banco->executarQuery($sql);
    }

    public function Pontosregistrados($professor, $mes) {
        $ano = date("Y");
        $sql = "SELECT * FROM `ponto` WHERE Month(data) = {$mes} and Year(data)  = {$ano} and cdProfessor = {$professor} ORDER BY cdDescricaoPonto ASC";

        return $this->banco->executarQuery($sql);
    }

      public function BuscarNome($motivo) {

        
        $sql = "SELECT nome FROM descricaoponto WHERE cdDescricaoPonto = {$motivo}";

        $retorno["motivo"] = mysqli_fetch_assoc($this->banco->executarQuery($sql));

        return $retorno;
    }
    
    public function BuscarNomes($turma, $motivo) {

        $sql = "SELECT nome FROM turma WHERE cdTurma = {$turma}";
        $retorno["turma"] = mysqli_fetch_assoc($this->banco->executarQuery($sql));
        $sql = "SELECT nome FROM descricaoponto WHERE cdDescricaoPonto = {$motivo}";

        $retorno["motivo"] = mysqli_fetch_assoc($this->banco->executarQuery($sql));

        return $retorno;
    }
    
   
}
