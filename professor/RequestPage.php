<?php

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);


$arrayPaginas = array(
    "home" => "views/home.php", //Página inicial
    "aulas" => "views/aulas.php",
    "chamada" => "views/chamada.php",
    "turmas" => "views/turmas.php",
    "inserir" => "views/inserirNotas.php",
    "editar" => "views/editarNotas.php",
    "notas" => "views/notas.php",
    "editarperfil" => "views/editarperfil.php",
    "sair" => "views/home.php",
     "msg" => "views/mensagens.php",
    "ponto" => "views/ponto.php",
     "medias" => "views/medias.php",
    "faltas" => "views/faltas.php"
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
