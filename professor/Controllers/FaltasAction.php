<?php

$faltas = new FaltasController();
if (isset($_POST["cdDisciplina"]) && isset($_POST["cdTurma"]) && isset($_POST["modulo"])) {

    $nomes = $faltas->BuscarNomes($_POST["cdTurma"], $_POST["cdDisciplina"]);
    $nome = $faltas->BuscarModulo($_POST["modulo"]);
    $disciplina = $_POST["cdDisciplina"];
    $turma = $_POST["cdTurma"];
    $modulo = $_POST["modulo"];
    $alunos = $faltas->BuscarAlunos($_POST["cdTurma"]);
} else {
    header("Location: index.php?pagina=aulas");
}
