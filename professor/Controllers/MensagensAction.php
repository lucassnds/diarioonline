<?php

$msg = new MensagensController();

$destinatario = $msg->BuscarDestinatario();
$cdAluno = $msg->CodigoAluno($_SESSION['usuario']['cdProfessor']);
//$meeeeeen = $msg->BuscarMensagem($cdAluno["cdUsuario"]);

if (filter_input(INPUT_POST, "mandarMensagens", FILTER_SANITIZE_STRING)) {
    $mensagem = [];
    $mensagem["destinatario"] = filter_input(INPUT_POST, "destinatario", FILTER_SANITIZE_STRING);
    $mensagem["conteudo"] = filter_input(INPUT_POST, "conteudo", FILTER_SANITIZE_STRING);
    $mensagem["data"] = date("Y-m-d");
    $cdAluno = $msg->CodigoAluno($_SESSION['usuario']['cdProfessor']);
    
    
  
    $mensagem["remetente"] = $cdAluno["cdUsuario"];
    
   $_SESSION["msg"] = $msg->MandarMensagem($mensagem);
    
}

if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {


    $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;

    $quantPagina = 10;
    $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT) + 1;
    $res = $msg->BuscarMensagem($cdAluno["cdUsuario"]);
    $totalTurmas = $msg->numAulas($res);
    $numPaginas = ceil($totalTurmas / $quantPagina);
    $meeeeeen = $msg->buscarLIMIT($cdAluno["cdUsuario"], $inicio, $quantPagina);
} else if (!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

    $page = 1;
    $numdaPagina = 1;

    $res = $msg->BuscarMensagem($cdAluno["cdUsuario"]);
    $totalTurmas = $msg->numAulas($res);
    $quantPagina = 10;
    $numPaginas = ceil($totalTurmas / $quantPagina);

    $inicio = ($quantPagina * $page) - $quantPagina;

   $meeeeeen = $msg->buscarLIMIT($cdAluno["cdUsuario"], $inicio, $quantPagina);
    $totalTurmas = $msg->numAulas($meeeeeen);
}
if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {

    $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) - 10;
    $quantPagina = 10;
    $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT) - 1;
    $meeeeeen = $msg->buscarLIMIT($cdAluno["cdUsuario"], $inicio, $quantPagina);
}

