<?php

include_once("../Conexao.php");

class MediaModel {

    private $banco;

    public function __construct() {
        $this->banco = new Conexao();
    }
    
  public function  BuscarQuantNotas($disciplina, $modulo, $turma, $professor){
      
      $sql = "SELECT COUNT(cardeneta.cdCardeneta) as quantnotas FROM cardeneta WHERE cardeneta.cdDisciplina = {$disciplina} and cardeneta.cdModulo = {$modulo} and cardeneta.cdTurma = {$turma} and cardeneta.cdProfessor = {$professor}";
      
      return mysqli_fetch_assoc($this->banco->executarQuery($sql));
  }
  
   public function  BuscarCardeneta($disciplina, $modulo, $turma, $professor){
      
      $sql = "SELECT cardeneta.cdCardeneta  FROM cardeneta WHERE cardeneta.cdDisciplina = {$disciplina} and cardeneta.cdModulo = {$modulo} and cardeneta.cdTurma = {$turma} and cardeneta.cdProfessor = {$professor}";
    
      return $this->banco->executarQuery($sql);
  }
  public function  BuscarCriterio($disciplina, $modulo, $turma, $professor){
      
      $sql = "SELECT cardeneta.criterio  FROM cardeneta WHERE cardeneta.cdDisciplina = {$disciplina} and cardeneta.cdModulo = {$modulo} and cardeneta.cdTurma = {$turma} and cardeneta.cdProfessor = {$professor} LIMIT 1";
    
      return mysqli_fetch_assoc($this->banco->executarQuery($sql));
  }
  public function BuscarNotas($cardeneta, $aluno){
      $sql = "SELECT * FROM nota WHERE nota.cdCardeneta = {$cardeneta} and nota.cdAluno = {$aluno}";
      
      return mysqli_fetch_assoc($this->banco->executarQuery($sql));
  }
  
  
  public function InserirCriterio($cardeneta, $criterio){
      
      for($i = 0; $i < COUNT($cardeneta); $i++){
          $sql = "UPDATE cardeneta SET criterio = {$criterio} WHERE cdCardeneta = {$cardeneta[$i]}";
          $this->banco->executarQuery($sql);
      }
      
  }
  
  
  
 
    
}
