<?php
$aulas = new AulasController();
$cardenta = new NotasController;
if(isset($_SESSION['cdTurma']) && isset($_SESSION['cdDisciplina'])){
    $nomes = $aulas->BuscarNomes($_SESSION['cdTurma'],  $_SESSION['cdDisciplina']);
    $_SESSION['nomeD'] = $nomes['Dnome'];
    $_SESSION['nomeT'] = $nomes['nome'];
    $turma = $_SESSION['cdTurma'];
    $disciplina = $_SESSION['cdDisciplina'];

   
     $_SESSION['modulos'] = $aulas->BuscarModulo($_SESSION['modulo']);
     
     
}

if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {


     $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;

     $quantPagina = 10;
     $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)+1;
     $res = $cardenta->BuscarCardeneta($_SESSION['modulo'],  $_SESSION['cdDisciplina'], $_SESSION['cdTurma']);
     $totalTurmas = $cardenta->num($res);
     $numPaginas = ceil($totalTurmas/$quantPagina);
     $resTurmas =  $cardenta->buscarLIMIT($_SESSION['modulo'],  $_SESSION['cdDisciplina'],$_SESSION['cdTurma'], $inicio, $quantPagina);

    }else if(!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)){

     $page =  1;
     $numdaPagina = 1;

     $res =  $cardenta->BuscarCardeneta($_SESSION['modulo'],  $_SESSION['cdDisciplina'], $_SESSION['cdTurma']);
     $totalTurmas = $cardenta->num($res);
     $quantPagina = 10;
     $numPaginas = ceil($totalTurmas/$quantPagina);

     $inicio = ($quantPagina*$page)-$quantPagina;

     $resTurmas = $cardenta->buscarLIMIT($_SESSION['modulo'],  $_SESSION['cdDisciplina'],$_SESSION['cdTurma'], $inicio, $quantPagina);
     $totalTurmas = $cardenta->num($resTurmas);

     }
    if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {

     $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING)-10 ;
     $quantPagina = 10;
     $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)-1;
     $resTurmas =  $resTurmas = $cardenta->buscarLIMIT($_SESSION['modulo'],  $_SESSION['cdDisciplina'],$_SESSION['cdTurma'], $inicio, $quantPagina);
     
    }
