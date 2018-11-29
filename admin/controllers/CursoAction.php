<?php

$curso = [];
$cursoController = new CursoController();
 if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
     
    $curso['nome'] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    
   
      if (isset($_POST['disciplinas'])){
         $disciCurso = $_POST['disciplinas'];
     }else{
          $disciCurso = NUll;
     }   
    
 
    
    $resposta = $cursoController->cadastrarCurso($curso, $disciCurso);

  }
  
  if (filter_input(INPUT_POST, "btnUpdate", FILTER_SANITIZE_STRING)) {
       
     $curso['nome'] = filter_input(INPUT_POST, "nomeINFO", FILTER_SANITIZE_STRING);
     //$disciplina['ch'] = filter_input(INPUT_POST, "chINFO", FILTER_SANITIZE_NUMBER_INT);
     $curso['cdCurso'] = filter_input(INPUT_POST, "cdDisciINFO", FILTER_SANITIZE_NUMBER_INT);
      if (isset($_POST['disciplinas'])){
         $disciCurso = $_POST['disciplinas'];
     }else{
          $disciCurso = NUll;
     }    
        
   
    $alterarcadastro =  $cursoController->alterarCurso($curso, $disciCurso);       
    }
  
  if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {
       
         $curso['buscar'] = filter_input(INPUT_POST, "buscar", FILTER_SANITIZE_STRING);
         $controle = 1;
         $page =  1;
         $numdaPagina = 1;
         $res = $cursoController->buscarCurso($curso);  
         $totalCurso = $cursoController->numCursos($res);
         $quantPagina = 10;
         $numPaginas = ceil($totalCurso/$quantPagina);
         $inicio = 0;
       
         $resCurso = $cursoController->buscarCurso($curso);
      
    }else{
      
    }

      if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {
          
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;
        
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)+1;
         $res = $cursoController->buscarCursos(); 
         $totalCurso= $cursoController->numCursos($res);
         $numPaginas = ceil($totalCurso/$quantPagina);
         $resCurso = $cursoController->BuscarLIMIT($inicio, $quantPagina);
    
        }else if(!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)){
   
         $page =  1;
         $numdaPagina = 1;
         
         $res = $cursoController->buscarCursos();
         $totalCurso = $cursoController->numCursos($res);
         $quantPagina = 10;
         $numPaginas = ceil($totalCurso/$quantPagina);

         $inicio = ($quantPagina*$page)-$quantPagina;

         $resCurso = $cursoController->BuscarLIMIT($inicio, $quantPagina);
         $totalCurso = $cursoController->numCursos($resCurso);
         
         } 
         
       
        
        if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING)-10 ;
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)-1;
         $resCurso = $cursoController->BuscarLIMIT($inicio, $quantPagina);
        }

