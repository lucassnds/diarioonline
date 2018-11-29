<?php

$titulacaoController = new PontoController();
if (filter_input(INPUT_POST, "btnUpdate", FILTER_SANITIZE_STRING)) {
    $titula["nome"] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $titula["cdDescricaoPonto"] = filter_input(INPUT_POST, "titulacao", FILTER_SANITIZE_STRING);
    
$alterarcadastro = $titulacaoController->atualizardescricaoponto($titula);
}

if (filter_input(INPUT_POST, "btnGravarDesc", FILTER_SANITIZE_STRING)) {
    $titula = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
   
    
$cadastro = $titulacaoController->Cadastrodescricaoponto($titula);
}


  if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {
          
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;
        
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)+1;
         $res = $titulacaoController->buscardescricaoponto(); 
         $totalCurso = $titulacaoController->numdescricaopontoo($res);
         $numPaginas = ceil($totalCurso/$quantPagina);
         $resT = $titulacaoController->BuscarLIMIT($inicio, $quantPagina);
    
        }else if(!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)){
   
         $page =  1;
         $numdaPagina = 1;
         
         $res = $titulacaoController->buscardescricaoponto(); 
         $totalCurso = $titulacaoController->numdescricaopontoo($res);
         $quantPagina = 10 ;
         $numPaginas = ceil($totalCurso/$quantPagina);

         $inicio = ($quantPagina*$page)-$quantPagina;

         $resT = $titulacaoController->BuscarLIMIT($inicio, $quantPagina);
         $totalCurso = $titulacaoController->numdescricaopontoo($resT);
         
         } 
         
       
        
        if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING)- 10 ;
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)-1;
         $resT =  $titulacaoController->BuscarLIMIT($inicio, $quantPagina);
        }
?>
