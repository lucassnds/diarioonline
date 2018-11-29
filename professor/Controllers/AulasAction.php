<?php

include_once ("AulasController.php");

$aulas = new AulasController();

if(filter_input(INPUT_POST, "salvar", FILTER_SANITIZE_STRING)){
    
   
    $obs["obs"] =  filter_input(INPUT_POST, "obs", FILTER_SANITIZE_STRING);
    $obs["assunto"] =  filter_input(INPUT_POST, "assunto", FILTER_SANITIZE_STRING);
    $obs["modulo"] =  filter_input(INPUT_POST, "modulo", FILTER_SANITIZE_STRING);
    $aula =  filter_input(INPUT_POST, "cdaula", FILTER_SANITIZE_STRING);
    
   $aulas->EditarObs($aula, $obs);
    
 
}

    if (isset($_POST['cdTurma']) && isset($_POST['cdDisciplina'])) {
    $nomes = $aulas->BuscarNomes($_POST['cdTurma'], $_POST['cdDisciplina']);
    $_SESSION['nomeD'] = $nomes['Dnome'];
    $_SESSION['nomeT'] = $nomes['nome'];
    $turma = $_POST['cdTurma'];
    $disciplina = $_POST['cdDisciplina'];
    $_SESSION['turma'] = $_POST['cdTurma'];
    $_SESSION['disciplina'] = $_POST['cdDisciplina'];
    $_SESSION['modulos'] = $aulas->BuscarModulos($_SESSION['disciplina']);

    $periodo = $aulas->BuscarPeriodo($_SESSION['turma']);
    $periodo = mysqli_fetch_object($periodo);
} else if (isset($_SESSION['turma'])) {
    $turma = $_SESSION['turma'];
    $disciplina = $_SESSION['disciplina'];
    $periodo = $aulas->BuscarPeriodo($_SESSION['turma']);
    $periodo = mysqli_fetch_object($periodo);
}


$_SESSION['modulos'] = $aulas->BuscarModulos($_SESSION['disciplina']);

if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {


    $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;

    $quantPagina = 10;
    $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT) + 1;
    $res = $aulas->BuscarAulas($_SESSION['turma'], $_SESSION['disciplina']);
    $totalTurmas = $aulas->numAulas($res);
    $numPaginas = ceil($totalTurmas / $quantPagina);
    $resTurmas = $aulas->buscarLIMIT($_SESSION['turma'], $_SESSION['disciplina'], $inicio, $quantPagina);
} else if (!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

    $page = 1;
    $numdaPagina = 1;

    $res = $aulas->BuscarAulas($_SESSION['turma'], $_SESSION['disciplina']);
    $totalTurmas = $aulas->numAulas($res);
    $quantPagina = 10;
    $numPaginas = ceil($totalTurmas / $quantPagina);

    $inicio = ($quantPagina * $page) - $quantPagina;

    $resTurmas = $aulas->buscarLIMIT($_SESSION['turma'], $_SESSION['disciplina'], $inicio, $quantPagina);
    $totalTurmas = $aulas->numAulas($resTurmas);
}
if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {

    $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) - 10;
    $quantPagina = 10;
    $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT) - 1;
    $resTurmas = $aulas->buscarLIMIT($_SESSION['turma'], $_SESSION['disciplina'], $inicio, $quantPagina);
}

//    if (filter_input(INPUT_POST, "Sim", FILTER_SANITIZE_STRING)) {
//
//     $cdaula = filter_input(INPUT_POST, "cdaula", FILTER_SANITIZE_STRING);
//    
//        $aulas->ApagarAula($cdaula);
//      
//    }



?>

