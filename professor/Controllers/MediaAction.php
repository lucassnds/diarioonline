<?php


$alunos = new FaltasController();
$notasController = new MediaController();
if (isset($_POST["disciplina"]) && isset($_POST["turma"]) && isset($_POST["modulo"])) {
    $criterio = $_POST["criterio"];
    $nomes = $alunos->BuscarNomes($_POST["turma"], $_POST["disciplina"]);
    $nome = $alunos->BuscarModulo($_POST["modulo"]);
    $disciplina = $_POST["disciplina"];
    $turma = $_POST["turma"];
    $modulo = $_POST["modulo"];
    $professor = $_SESSION['usuario']['cdProfessor'];
    
    $aluno = $alunos->BuscarAlunos($_POST["turma"]);

    $quantNotas = $notasController->BuscarQuantNotas($disciplina, $modulo, $turma, $professor);
    $c = $notasController->BuscarCardeneta($disciplina, $modulo, $turma, $professor);
    foreach ($c as $cdcardeneta){
       $cardeneta[] = $cdcardeneta["cdCardeneta"]; 
    }
    
    if($criterio != $_POST["opc"]){
        $notasController->InserirCriterio($cardeneta, $criterio);
    }
    

}