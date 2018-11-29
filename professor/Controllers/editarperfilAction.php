<?php
$perfilController = new EditarPerfilController();

if(filter_input(INPUT_POST, "btn", FILTER_SANITIZE_STRING)){
    
    $editarPerfil = [];
    
    $editarPerfil['senha'] = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);
    $editarPerfil['novasenha'] = filter_input(INPUT_POST, "novasenha", FILTER_SANITIZE_STRING);
    $editarPerfil['cdUsuario'] = $_SESSION['usuario']['cdUsuario'];
    $editarPerfil['login'] = $_SESSION['usuario']['login'];
    
   $alterarcadastro = $perfilController->novaSenha($editarPerfil);
    
}

