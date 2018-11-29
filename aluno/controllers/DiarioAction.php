<?php
$diario = new DiarioController();

$turma = $diario->BuscarTurmas($_SESSION["usuario"]["cdAluno"]);

if (filter_input(INPUT_POST, "buscarNotas", FILTER_SANITIZE_STRING)) {
    
    $curso =  filter_input(INPUT_POST, "curso", FILTER_SANITIZE_STRING);
    $curso = explode("/", $curso);
    $quantDisciplina = $diario->QunatDisciplina($curso[0]);
    
    
}

