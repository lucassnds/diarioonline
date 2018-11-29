<?php

 $aluno = [];
    $usuarioController = new AlunoController();

    if(filter_input(INPUT_POST, "Sim", FILTER_SANITIZE_STRING)){

          $cdUsuario = filter_input(INPUT_POST, "cdusuario", FILTER_SANITIZE_STRING);
          $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);



   $usuarioController->desativarAluno($status, $cdUsuario);

}
    
    if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
       
    $aluno['nome'] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $aluno['login'] = filter_input(INPUT_POST, "matricula", FILTER_SANITIZE_STRING);
    $aluno['senha'] = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);
  
        $usuarioController->Cadastrar($aluno);        
    }


    if (filter_input(INPUT_POST, "btnUpdate", FILTER_SANITIZE_STRING)) {
       
    $aluno['nome'] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
   
    $aluno['senha'] = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

    $aluno['cdAluno'] = filter_input(INPUT_POST, "cdAluno", FILTER_SANITIZE_NUMBER_INT);
    
    $aluno['cdUsuario'] = filter_input(INPUT_POST, "cdUsuario", FILTER_SANITIZE_NUMBER_INT);


  
       $alterarcadastro = $usuarioController->atualizarAluno($aluno);        
    }
    
    if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {
       
         $aluno['buscar'] = filter_input(INPUT_POST, "buscar", FILTER_SANITIZE_STRING);
         $controle = 1;
         $page =  1;
         $numdaPagina = 1;
         $res = $usuarioController->buscarAluno($aluno);  
         $totalAluno = $usuarioController->numAlunos($res);
         $quantPagina = 10;
         $numPaginas = ceil($totalAluno/$quantPagina);
         $inicio = 0;
       
         $resAlunos = $usuarioController->buscarAluno($aluno);
      
    }else{
      
    }

      if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {
          
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;
        
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)+1;
         $res = $usuarioController->buscarAlunos();  
         $totalAluno = $usuarioController->numAlunos($res);
         $numPaginas = ceil($totalAluno/$quantPagina);
         $resAlunos = $usuarioController->buscarLIMIT($inicio, $quantPagina);
    
        }else if(!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)){
   
         $page =  1;
         $numdaPagina = 1;
         
         $res = $usuarioController->buscarAlunos();  
         $totalAluno = $usuarioController->numAlunos($res);
         $quantPagina = 10;
         $numPaginas = ceil($totalAluno/$quantPagina);

         $inicio = ($quantPagina*$page)-$quantPagina;

         $resAlunos = $usuarioController->buscarLIMIT($inicio, $quantPagina);
         $totalAlunos = $usuarioController->numAlunos($resAlunos);
         
         } 
         
       
        
        if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING)-10 ;
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)-1;
         $resAlunos = $usuarioController->buscarLIMIT($inicio, $quantPagina);
        }


