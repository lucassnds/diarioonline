<?php

$disciplina = [];
$disciplinaController = new DisciplinaController();
 if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
     
    $disciplina['nome'] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $disciplina['ch'] = filter_input(INPUT_POST, "ch", FILTER_SANITIZE_NUMBER_INT);
   
   
      if (isset($_POST['modulos'])){
         $disciModulos = $_POST['modulos'];
     }else{
         $disciModulos = NUll;
     }  
    
    $resposta = $disciplinaController->cadastrarDisciplina($disciplina, $disciModulos);

  }
  
   if (filter_input(INPUT_POST, "btnUpdate", FILTER_SANITIZE_STRING)) {
       
     $disciplina['nome'] = filter_input(INPUT_POST, "nomeINFO", FILTER_SANITIZE_STRING);
     //$disciplina['ch'] = filter_input(INPUT_POST, "chINFO", FILTER_SANITIZE_NUMBER_INT);
     $disciplina['cdDisciplina'] = filter_input(INPUT_POST, "cdDisciINFO", FILTER_SANITIZE_NUMBER_INT);
       if (isset($_POST['modulos'])){
         $disciModulos = $_POST['modulos'];
     
     }else{
         $disciModulos = NUll;
     } 
     
     
  $alterarcadastro =  $disciplinaController->alterarDisciplina($disciplina, $disciModulos);       
    }
  
  if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {
       
         $disciplina['buscar'] = filter_input(INPUT_POST, "buscar", FILTER_SANITIZE_STRING);
         $controle = 1;
         $page =  1;
         $numdaPagina = 1;
         $res = $disciplinaController->buscarDisciplina($disciplina);
    
         $totalDisciplina = $disciplinaController->numDisciplinas($res);
         $quantPagina = 10;
         $numPaginas = ceil($totalDisciplina/$quantPagina);
         $inicio = 0;
       
         $resDisciplina = $disciplinaController->buscarDisciplina($disciplina);
      
    }else{
      
    }

      if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {
          
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;
        
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)+1;
         $res = $disciplinaController->buscarDisciplinas();  
         $totalDisciplina = $disciplinaController->numDisciplinas($res);
         $numPaginas = ceil($totalDisciplina/$quantPagina);
         $resDisciplina = $disciplinaController->buscarLIMIT($inicio, $quantPagina);
    
        }else if(!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)){
   
         $page =  1;
         $numdaPagina = 1;
         
         $res = $disciplinaController->buscarDisciplinas();
         $totalDisciplina = $disciplinaController->numDisciplinas($res);
         $quantPagina = 10;
         $numPaginas = ceil($totalDisciplina/$quantPagina);

         $inicio = ($quantPagina*$page)-$quantPagina;

         $resDisciplina = $disciplinaController->buscarLIMIT($inicio, $quantPagina);
         $totalDisciplina = $disciplinaController->numDisciplinas($resDisciplina);
         
         } 
         
       
        
        if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING)-10 ;
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)-1;
         $resDisciplina = $disciplinaController->buscarLIMIT($inicio, $quantPagina);
        }
        
        

