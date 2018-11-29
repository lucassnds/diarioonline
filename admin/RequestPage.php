<?php

$pagina = filter_input(INPUT_GET, "pagina", FILTER_SANITIZE_STRING);


$arrayPaginas = array(
    "home" => "views/home.php", //Página inicial
    "alunos" => "views/alunos.php",
    "professores" => "views/professores.php",
    "turmas" => "views/turmas.php",
    "turma" => "views/turma.php",
     "disciplinas" => "views/disciplinas.php",
     "modulos" => "views/modulos.php",
     "cursos" => "views/cursos.php",
     "editarperfil" => "views/editarperfil.php",
     "titu" => "views/titulacoes.php",
      "folha" => "views/folhapontos.php",
      "coor" => "views/coordenador.php",
      "substituicao" => "views/substituicao.php",
     "ponto" => "views/ponto.php",
     "adms" => "views/configuracoes.php",
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
