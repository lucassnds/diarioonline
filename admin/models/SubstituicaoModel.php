<?php

include_once("../Conexao.php");

class SubstituicaoModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }

    public function BuscarProfessor() {

        $sql = "SELECT * FROM professor";

        return $this->banco->executarQuery($sql);
    }

    public function BuscarTurmas() {

        $sql = "SELECT * FROM turma";
        return $this->banco->executarQuery($sql);
    }

    public function Substituir($dados) {

        $sql = "UPDATE turmaprofessor SET cdProfessor = {$dados["professor"]} WHERE cdTurma = {$dados["estado"]} and cdProfessor = {$dados["cidade"]}";
        if ($this->banco->executarQuery($sql)) {
            $sql = "UPDATE aula SET cdProfessor = {$dados["professor"]} WHERE aula.cdTurma = {$dados["estado"]} and aula.cdProfessor = {$dados["cidade"]}";
            if ($this->banco->executarQuery($sql)) {
                $sql = "UPDATE cardeneta SET cdProfessor = {$dados["professor"]} WHERE cardeneta.cdTurma = {$dados["estado"]} and cardeneta.cdProfessor = {$dados["cidade"]}";
                if($this->banco->executarQuery($sql)) {
                    
                    return 1;
                }
                else{
                    return 0;
                }
            }else{
                return 0;
            }
        }else{
            return 0;
        }
    }
    
    function SubstituirAluno($dados) {
        
        
       // $sql = "UPDATE turmaaluno SET cdTurma = {$dados["turmaNova"]} WHERE cdTurma = {$dados["turma"]} and cdAluno = {$dados["aluno"]} "; 
        
        //$sql = "SELECT * FROM nota WHERE cdAluno = {$dados["aluno"]}";
        
    }

}
