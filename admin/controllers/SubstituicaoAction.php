<?php

$subs = new SubstituicaoController();

$professores = $subs->BuscarProfessor();
$turmas = $subs->BuscarTurmas();


if (filter_input(INPUT_POST, "Sub", FILTER_SANITIZE_STRING)) {
    $dados["professor"] = filter_input(INPUT_POST, "professor", FILTER_SANITIZE_STRING);
    $dados["estado"] = filter_input(INPUT_POST, "estado", FILTER_SANITIZE_STRING);
    $dados["cidade"] = filter_input(INPUT_POST, "cidade", FILTER_SANITIZE_STRING);

  $alterarcadastro = $subs->Substituir($dados);
}
?>

