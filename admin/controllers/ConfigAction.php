<?php
  include_once("../Conexao.php");
$adm = [];
$configController = new ConfigController();

if(filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)){

  $adm["nome"] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
  $adm["login"] = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
  $adm["senha"] = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);


  $cadastro = $configController->cadastrarAdm($adm);

}

if(filter_input(INPUT_POST, "btnUpdate", FILTER_SANITIZE_STRING)){

  $adm["nome"] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
  $adm["cdUsuario"] = filter_input(INPUT_POST, "cdusuario", FILTER_SANITIZE_NUMBER_INT);
  $adm["senha"] = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);


  $alterarcadastro = $configController->atualizarAdm($adm);

}


if(filter_input(INPUT_POST, "Sim", FILTER_SANITIZE_STRING)){

  $cdUsuario = filter_input(INPUT_POST, "cdusuario", FILTER_SANITIZE_STRING);
  $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);



   $configController->desativarAdm($status, $cdUsuario);

}



if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

     $professor['buscar'] = filter_input(INPUT_POST, "buscar", FILTER_SANITIZE_STRING);
     $controle = 1;
     $page =  1;
     $numdaPagina = 1;
     $res = $configController->buscarAdm($professor);
     $totalAdm = $configController->numAdms($res);
     $quantPagina = 10;
     $numPaginas = ceil($totalAdm/$quantPagina);
     $inicio = 0;

     $resAdm = $configController->buscarAdm($professor);

}else{

}

  if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {


     $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;

     $quantPagina = 10;
     $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)+1;
     $res = $configController->buscarAdms();
     $totalAdm = $configController->numAdms($res);
     $numPaginas = ceil($totalAdm/$quantPagina);
     $resAdm = $configController->buscarLIMIT($inicio, $quantPagina);

    }else if(!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)){

     $page =  1;
     $numdaPagina = 1;

     $res = $configController ->buscarAdms();
     $totalAdm = $configController ->numAdms($res);
     $quantPagina = 10;
     $numPaginas = ceil($totalAdm/$quantPagina);

     $inicio = ($quantPagina*$page)-$quantPagina;

     $resAdm = $configController ->buscarLIMIT($inicio, $quantPagina);
     $totalAdm = $configController ->numAdms($resAdm);

     }



    if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {

     $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING)-10 ;
     $quantPagina = 10;
     $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)-1;
     $resAdm = $configController->buscarLIMIT($inicio, $quantPagina);
    }
