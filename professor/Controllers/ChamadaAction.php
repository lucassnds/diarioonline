<?php
$chamada = new ChamadaController();
$aulaCompleta = [];
if(isset($_POST['turma'])){
    

    $alunos = $chamada->BuscarAlunos($_SESSION['turma']);
    $turma = $_SESSION['turma'];
    $disciplina = $_POST['disciplina'];
 
    

    
    
}else if(isset($_SESSION['turma'])){
    
    $alunos = $chamada->BuscarAlunos($_SESSION['turma']);
    $turma = $_SESSION['turma'];
    $disciplina = $_SESSION['disciplina'];
    
}

if(filter_input(INPUT_POST, "fazerchamada", FILTER_SANITIZE_STRING)){
   $ponto = []; 
   $estado["estado"] = filter_input(INPUT_POST, "estado", FILTER_SANITIZE_STRING);
   
   if((isset($estado["estado"])) && ($estado["estado"] == 2)){
       
       $estado["professor"] = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_STRING);
   } else {
   $estado["professor"]  = 0;
   }
   
   
  $aulaCompleta['assunto'] = filter_input(INPUT_POST, "assunto", FILTER_SANITIZE_STRING);
  $aulaCompleta['data'] = date('Y/m/d');
  $aulaCompleta['turma'] = filter_input(INPUT_POST, "turma", FILTER_SANITIZE_STRING);
  $aulaCompleta['disciplina'] = filter_input(INPUT_POST, "disciplina", FILTER_SANITIZE_STRING);
  $aulaCompleta['modulo'] = filter_input(INPUT_POST, "modulo", FILTER_SANITIZE_STRING);
   $aulaCompleta['numAulas'] = filter_input(INPUT_POST, "numAulas", FILTER_SANITIZE_STRING);
  $aulaCompleta['professor'] = $_SESSION['usuario']['cdProfessor'];
  if(isset($_POST['obs'])){
       $aulaCompleta["obs"] = $_POST['obs'];
  }else{
      $aulaCompleta["obs"] = NULL;
  }
 
  
  $ponto["data"] =  date('Y/m/d');
  $ponto["turma"] = filter_input(INPUT_POST, "turma", FILTER_SANITIZE_STRING);
  $ponto["entrada"] = filter_input(INPUT_POST, "horarioEntrada", FILTER_SANITIZE_STRING);
  $ponto["saida"] = filter_input(INPUT_POST, "horarioSaida", FILTER_SANITIZE_STRING);
  $ponto["numHoras"] = filter_input(INPUT_POST, "numAulas", FILTER_SANITIZE_STRING);
  $ponto["professor"] = $_SESSION['usuario']['cdProfessor'];
  $ponto["desc"] = 1;
          
  $alunosChamada = $_POST['indiceAluno'];
  $indice = $_POST['indice'];
  $presenca = [];
  for($i = 1; $i <= $indice; $i++){
      if(isset($_POST['presenca'.$i])  && ($_POST['presenca'.$i] != NULL)){
          $presenca[] =  $_POST['presenca'.$i];
      }else{
           $presenca[] =  "0";
      }
     
  }
  
 $_SESSION['cadastro']  = $chamada->GravarAula($aulaCompleta, $alunosChamada, $presenca, $indice, $ponto, $estado);
  
}






?>

