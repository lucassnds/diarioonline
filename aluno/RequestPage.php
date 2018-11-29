<?php

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);


$arrayPaginas = array(
    "home" => "views/home.php", //Página inicial
    "editarperfil" => "views/editarperfil.php",
     "diario" => "views/diario.php",
      "msg" => "views/mensagens.php",
     "sair" => "views/home.php"
);

if ($pagina) {
    $encontrou = false;

    foreach ($arrayPaginas as $page => $key) {
        if ($pagina == $page) {
            $encontrou = true;
            require_once($key);
        }
    }

    if (!$encontrou) {
        require_once("views/home.php");
    }
} else {
    require_once("views/home.php");
}
