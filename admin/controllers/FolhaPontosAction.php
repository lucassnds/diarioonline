<?php

$folhaController = new FolhaPontosController();
if (filter_input(INPUT_POST, "pagamento", FILTER_SANITIZE_STRING)) {
    
    $professor = filter_input(INPUT_POST, "professor", FILTER_SANITIZE_STRING);
    $mes = filter_input(INPUT_POST, "mes", FILTER_SANITIZE_STRING);
    
    $folhaController->FazerPagamnto($professor, $mes);
    
}

if (filter_input(INPUT_POST, "gerar", FILTER_SANITIZE_STRING)) {

    $mes = filter_input(INPUT_POST, "mes", FILTER_SANITIZE_STRING);
   
$professores = $folhaController->BuscarProf();
  // $CC = $folhaController->BuscarPonto($mes);
   $desc = $folhaController->BuscarDescPonto();
  
    
}
?>

