<?php

if (isset($_POST['turma'])) {
    $chamada = new ChamadaController();
    $aulaCompleta = [];
    $alunos = $chamada->BuscarAlunos($_POST['turma']);
    $turma = $_POST['turma'];
    $disciplina = $_POST['disciplina'];
} else if (isset($_POST['cardeneta'])) {
    
    $notas = new NotasController();
    $alunos = $notas->BuscarNotas($_POST['cardeneta']);
    
} else {
    echo '<script type="text/javascript"> window.location.href = "index.php?pagina=notas";</script>';
}

if (filter_input(INPUT_POST, "inserirnotas", FILTER_SANITIZE_STRING)) {

    $aulaCompleta['assunto'] = filter_input(INPUT_POST, "assunto", FILTER_SANITIZE_STRING);
    $aulaCompleta['data'] = date('Y/m/d');
    $aulaCompleta['turma'] = filter_input(INPUT_POST, "turma", FILTER_SANITIZE_STRING);
    $aulaCompleta['disciplina'] = filter_input(INPUT_POST, "disciplina", FILTER_SANITIZE_STRING);
    $aulaCompleta['modulo'] = filter_input(INPUT_POST, "modulo", FILTER_SANITIZE_STRING);
    $aulaCompleta['professor'] = $_SESSION['usuario']['cdProfessor'];
    $alunosChamada = $_POST['indiceAluno'];
    $indice = $_POST['indice'];
    $presenca = [];
    $status = [];
    for ($i = 1; $i <= $indice; $i++) {
        if (isset($_POST['presenca' . $i]) && ($_POST['presenca' . $i] != 0)) {
            $presenca[] = $_POST['presenca' . $i];
            $status[] = 1;
        } else {
            $presenca[] = "0";
            $status[] = 0;
        }
    }

    $_SESSION['cadastro'] = $chamada->GravarNota($aulaCompleta, $alunosChamada, $presenca, $indice, $status);
}

if (filter_input(INPUT_POST, "editarnotas", FILTER_SANITIZE_STRING)) {
    
    $notass = new NotasController();
    $notas = $_POST['notas'];
    $cdNotas = $_POST['cdNota']; 
    $cardeneta = $_POST['cardeneta'];
    $status =  $_POST['status'];
    $aluno  = $_POST['indiceAluno'];
    $indice  = filter_input(INPUT_POST, "indice", FILTER_SANITIZE_STRING);
   
//      var_dump($aluno);
//        var_dump($notas);
 // var_dump($cdNotas);
//        var_dump($cardenta);
//        var_dump($status);
 
   $_SESSION['alterar'] = $notass->EditarNotas($cdNotas, $cardeneta, $aluno, $notas, $status, $indice);
}
?>

