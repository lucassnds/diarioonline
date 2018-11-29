<?php

$professorController = new ProfessorController();

 if(filter_input(INPUT_POST, "Sim", FILTER_SANITIZE_STRING)){

          $cdUsuario = filter_input(INPUT_POST, "cdusuario", FILTER_SANITIZE_STRING);
          $status = filter_input(INPUT_POST, "status", FILTER_SANITIZE_STRING);



   $professorController->desativarProfessor($status, $cdUsuario);

}
    
    if (filter_input(INPUT_POST, "btnGravarTitu", FILTER_SANITIZE_STRING)) {
        
        $titulacao = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
      
         $cadastro = $professorController->cadastrartitulacao($titulacao);
        
    }
    
    if (filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)) {
        
        $titulacao['nome'] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
        $titulacao['login'] = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
        $titulacao['senha'] = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);
        $titulacao['titulacao'] = filter_input(INPUT_POST, "titulacao", FILTER_SANITIZE_NUMBER_INT);
    
         $cadastro = $professorController->cadastrarprofesor($titulacao);
        
    }
    
    
     if (filter_input(INPUT_POST, "btnUpdate", FILTER_SANITIZE_STRING)) {
      
       $professor['cdUsuario'] = filter_input(INPUT_POST,"cdUsuarioINFO", FILTER_SANITIZE_NUMBER_INT); 
       $professor['cdProfessor'] = filter_input(INPUT_POST,"cdProfessorINFO", FILTER_SANITIZE_NUMBER_INT); 
       $professor['nome'] = filter_input(INPUT_POST, "nomeINFO", FILTER_SANITIZE_STRING);
       $professor['senha'] = filter_input(INPUT_POST, "senhaINFO", FILTER_SANITIZE_STRING);
    
     
       if ($_POST['titulacao'] == 'f'){
            $professor['cdTitulacao'] =  filter_input(INPUT_POST, "tituINFO", FILTER_SANITIZE_NUMBER_INT);
         
     
     }else{
        $professor['cdTitulacao'] = $_POST['titulacao'];
     } 
     
    // var_dump($professor);
  $alterarcadastro = $professorController->alterarProfessor($professor);      
    }
    if (filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)) {
       
         $professor['buscar'] = filter_input(INPUT_POST, "buscar", FILTER_SANITIZE_STRING);
         $controle = 1;
         $page =  1;
         $numdaPagina = 1;
         $res = $professorController->buscarProfessore($professor); 
         $totalProfessor = $professorController->numProfessor($res);
         $quantPagina = 10;
         $numPaginas = ceil($totalProfessor/$quantPagina);
         $inicio = 0;
       
         $resProfessor = $professorController->buscarProfessore($professor);
      
    }else{
      
    }

      if (filter_input(INPUT_POST, "proximo", FILTER_SANITIZE_STRING)) {
          
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING) + 10;
        
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)+1;
         $res = $professorController->buscarProfessores();
         $totalProfessor = $professorController->numProfessor($res);
         $numPaginas = ceil($totalProfessor/$quantPagina);
         $resProfessor = $professorController->buscarLIMIT($inicio, $quantPagina);
    
        }else if(!filter_input(INPUT_POST, "btnBuscar", FILTER_SANITIZE_STRING)){
   
         $page =  1;
         $numdaPagina = 1;
         
         $res = $professorController ->buscarProfessores();  
         $totalProfessor = $professorController ->numProfessor($res);
         $quantPagina = 10;
         $numPaginas = ceil($totalProfessor/$quantPagina);

         $inicio = ($quantPagina*$page)-$quantPagina;

         $resProfessor = $professorController ->buscarLIMIT($inicio, $quantPagina);
         $totalProfessor = $professorController ->numProfessor($resProfessor);
         
         } 
         
       
        
        if (filter_input(INPUT_POST, "voltar", FILTER_SANITIZE_STRING)) {
          
         $inicio = filter_input(INPUT_POST, "inicio", FILTER_SANITIZE_STRING)-10 ;
         $quantPagina = 10;
         $numdaPagina = filter_input(INPUT_POST, "nPagina", FILTER_SANITIZE_NUMBER_INT)-1;
         $resProfessor = $professorController->buscarLIMIT($inicio, $quantPagina);
        }
    