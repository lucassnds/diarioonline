<?php

include_once("../../Conexao.php");

$banco = new Conexao();
if (isset($_POST['cdaula'])) {

   

    $sql = "DELETE from chamada Where chamada.cdAula = {$_POST['cdaula']}";
    $banco->executarQuery($sql);
    $sql = "DELETE from aula Where aula.cdAula = {$_POST['cdaula']}";
    $banco->executarQuery($sql);
    
    header("Location: http://localhost/diario/professor/index.php?pagina=aulas ");
   
}

if (isset($_POST['cdCardeneta'])) {

   

    $sql = "DELETE FROM nota Where nota.cdCardeneta = {$_POST['cdCardeneta']}";
    $banco->executarQuery($sql);
    $sql = "DELETE FROM cardeneta Where cardeneta.cdCardeneta = {$_POST['cdCardeneta']}";
    $banco->executarQuery($sql);
    
    header("Location: http://localhost/diario/professor/index.php?pagina=notas");
   
}

