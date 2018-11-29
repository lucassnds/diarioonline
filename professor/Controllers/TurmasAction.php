<?php

$turmasController = new TurmasController();
$turmas = [];

if (isset($_SESSION['nomeD'])) {
    unset($_SESSION['cdTurma']);
    unset($_SESSION['cdDisciplina']);
    unset($_SESSION['modulo']);
    unset($_SESSION['nomeD']);
    unset($_SESSION['nomeT']);
    unset($_SESSION['modulos']);
    unset($_SESSION['turma']); 
    unset($_SESSION['disciplina']); 
}



if (filter_input(INPUT_POST, "Gravar", FILTER_SANITIZE_STRING)) {

    $_SESSION['nome'] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $_SESSION['dataI'] = filter_input(INPUT_POST, "dataI", FILTER_SANITIZE_STRING);
    $_SESSION['vagas'] = filter_input(INPUT_POST, "vagas", FILTER_SANITIZE_STRING);
    $_SESSION['dataT'] = filter_input(INPUT_POST, "T", FILTER_SANITIZE_STRING);
    $_SESSION['turno'] = filter_input(INPUT_POST, "turno", FILTER_SANITIZE_STRING);
    $_SESSION['cdCurso'] = filter_input(INPUT_POST, "curso", FILTER_SANITIZE_STRING);
    $_SESSION['matricula'] = filter_input(INPUT_POST, "matricula", FILTER_SANITIZE_STRING);

    echo '<script type="text/javascript"> window.location.href = "index.php?pagina=turma";</script>';
}

if (filter_input(INPUT_POST, "btnUpdate", FILTER_SANITIZE_STRING)) {

    $turmas['dataI'] = $turmasController->inverterdata(filter_input(INPUT_POST, "dataI", FILTER_SANITIZE_STRING));
    $turmas['dataT'] = $turmasController->inverterdata(filter_input(INPUT_POST, "dataT", FILTER_SANITIZE_STRING));
    $turmas['turno'] = filter_input(INPUT_POST, "turno", FILTER_SANITIZE_STRING);
    $turmas['cdTurma'] = filter_input(INPUT_POST, "cdturma", FILTER_SANITIZE_NUMBER_INT);

    $alterarcadastro = $turmasController->atualizarTurma($turmas);
}

if (filter_input(INPUT_POST, "Sim", FILTER_SANITIZE_STRING)) {

    $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_NUMBER_INT);
    $cdTurma = filter_input(INPUT_POST, "cdturma", FILTER_SANITIZE_NUMBER_INT);

    $turmasController->desativarTurma($cdTurma, $status);
}

if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

    $turma['buscar'] = filter_input(INPUT_POST, "buscar", FILTER_SANITIZE_STRING);
    $controle = 1;
    $page = 1;
    $numdaPagina = 1;
    $res = $turmasController->buscarTurma($_SESSION['usuario']['cdProfessor'], $turma);
    $totalTurmas = $turmasController->numTurmas($res); 
    $quantPagina = 2;
    $numPaginas = ceil($totalTurmas / $quantPagina);
    $inicio = 0;

    $resTurmas = $turmasController->buscarTurma($_SESSION['usuario']['cdProfessor'], $turma);
}

if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {


    $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;

    $quantPagina = 10;
    $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT) + 1;
    $res = $turmasController->buscarTurmas($_SESSION['usuario']['cdProfessor']);
    $totalTurmas = $turmasController->numTurmas($res);
    $numPaginas = ceil($totalTurmas / $quantPagina);
    $resTurmas = $turmasController->buscarLIMIT($_SESSION['usuario']['cdProfessor'], $inicio, $quantPagina);
} else if (!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {

    $page = 1;
    $numdaPagina = 1;

    $res = $turmasController->buscarTurmas($_SESSION['usuario']['cdProfessor']);
    $totalTurmas = $turmasController->numTurmas($res);
    $quantPagina = 10;
    $numPaginas = ceil($totalTurmas / $quantPagina);

    $inicio = ($quantPagina * $page) - $quantPagina;

    $resTurmas = $turmasController->buscarLIMIT($_SESSION['usuario']['cdProfessor'], $inicio, $quantPagina);
    $totalTurmas = $turmasController->numTurmas($resTurmas);
}
if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {

    $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) - 10;
    $quantPagina = 10;
    $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT) - 1;
    $resTurmas = $turmasController->buscarLIMIT($_SESSION['usuario']['cdProfessor'], $inicio, $quantPagina);
}

if (filter_input(INPUT_POST, "sim", FILTER_SANITIZE_STRING)) {

    $_SESSION['modulo'] = filter_input(INPUT_POST, "modulo", FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['cdTurma'] = filter_input(INPUT_POST, "cdTurma", FILTER_SANITIZE_NUMBER_INT);
    $_SESSION['cdDisciplina'] = filter_input(INPUT_POST, "cdDisciplina", FILTER_SANITIZE_NUMBER_INT);
    echo $_SESSION['cdDisciplina'];
    echo '<script type="text/javascript"> window.location.href = "index.php?pagina=notas";</script>';
}