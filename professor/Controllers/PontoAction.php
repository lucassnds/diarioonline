<?php

$ponto = new PontoController();

//$dados = $ponto->BuscarPontos($_SESSION['usuario']['cdProfessor']);


if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {

    $pont["numHoras"] = filter_input(INPUT_POST, "numHoras", FILTER_SANITIZE_STRING);
    $pont["data"] = filter_input(INPUT_POST, "data", FILTER_SANITIZE_STRING);
    $pont["entrada"] = filter_input(INPUT_POST, "entrada", FILTER_SANITIZE_STRING);
    $pont["saida"] = filter_input(INPUT_POST, "saida", FILTER_SANITIZE_STRING);
    $pont["cdDescricao"] = filter_input(INPUT_POST, "motivo", FILTER_SANITIZE_STRING);
    $pont["cdProfessor"] = $_SESSION['usuario']['cdProfessor'];

    $ponto->CadastrarPonto($pont);
}


if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {


    $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;

    $quantPagina = 10;
    $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT) + 1;
    $res = $ponto->BuscarAulas($_SESSION['usuario']["cdProfessor"]);
    $totalTurmas = $ponto->numAulas($res);
    $numPaginas = ceil($totalTurmas / $quantPagina);
    $resTurmas = $ponto->buscarLIMIT($_SESSION['usuario']["cdProfessor"], $inicio, $quantPagina);
} else if (!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

    $page = 1;
    $numdaPagina = 1;

    $res = $ponto->BuscarAulas($_SESSION['usuario']["cdProfessor"]);
    $totalTurmas = $ponto->numAulas($res);
    $quantPagina = 10;
    $numPaginas = ceil($totalTurmas / $quantPagina);

    $inicio = ($quantPagina * $page) - $quantPagina;

    $resTurmas = $ponto->buscarLIMIT($_SESSION['usuario']["cdProfessor"], $inicio, $quantPagina);
    $totalTurmas = $ponto->numAulas($resTurmas);
}
if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {

    $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) - 10;
    $quantPagina = 10;
    $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT) - 1;
    $resTurmas = $ponto->buscarLIMIT($_SESSION['usuario']["cdProfessor"], $inicio, $quantPagina);
}
?>