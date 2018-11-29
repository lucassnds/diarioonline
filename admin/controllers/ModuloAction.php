<?php

    $modulo = [];
    $moduloController = new moduloController();

 if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
       
    $modulo['nome'] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $modulo['ch'] = filter_input(INPUT_POST, "ch", FILTER_SANITIZE_NUMBER_INT);
    $modulo['descricao'] = filter_input(INPUT_POST, "descricao", FILTER_SANITIZE_STRING);
    
     
     $cadastro =  $moduloController->cadastrarModulo($modulo);  
     
    } 
    if (filter_input(INPUT_POST, "btnUpdate", FILTER_SANITIZE_STRING)) {
       
    $modulo['cdModulo'] = filter_input(INPUT_POST, "cdModuloINFO", FILTER_SANITIZE_NUMBER_INT);
    $modulo['nome'] = filter_input(INPUT_POST, "nomeINFO", FILTER_SANITIZE_STRING);
    $modulo['ch'] = filter_input(INPUT_POST, "chINFO", FILTER_SANITIZE_NUMBER_INT);
    $modulo['descricao'] = filter_input(INPUT_POST, "descricaoINFO", FILTER_SANITIZE_STRING);
    
     
     $alterarcadastro =  $moduloController->alterarModulo($modulo);        
    }
    
    
     if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {
       
         $modulo['buscar'] = filter_input(INPUT_POST, "buscar", FILTER_SANITIZE_STRING);
         $controle = 1;
         $page =  1;
         $numdaPagina = 1;
         $res = $moduloController->buscarModulo($modulo);  
         $totalModulo = $moduloController->numModulos($res);
         $quantPagina = 10;
         $numPaginas = ceil($totalModulo/$quantPagina);
         $inicio = 0;
       
         $resModulo = $moduloController->buscarModulo($modulo);
      
    }else{
      
    }

      if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {
          
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;
        
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)+1;
         $res = $moduloController->buscarModulos();  
         $totalModulo = $moduloController->numModulos($res);
         $numPaginas = ceil($totalModulo/$quantPagina);
         $resModulo = $moduloController->buscarLIMIT($inicio, $quantPagina);
    
        }else if(!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)){
   
         $page =  1;
         $numdaPagina = 1;
         
         $res = $moduloController->buscarModulos();  
         $totalModulo = $moduloController->numModulos($res);
         $quantPagina = 10;
         $numPaginas = ceil($totalModulo/$quantPagina);

         $inicio = ($quantPagina*$page)-$quantPagina;

         $resModulo = $moduloController->buscarLIMIT($inicio, $quantPagina);
         $totalModulo = $moduloController->numModulos($resModulo);
         
         } 
         
       
        
        if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING)-10 ;
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)-1;
         $resModulo = $moduloController->buscarLIMIT($inicio, $quantPagina);
        }
