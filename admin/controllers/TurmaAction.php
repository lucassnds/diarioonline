<?php

    $turmaController = new TurmasController();
if (!isset($_SESSION['carrinho'])) {
     $_SESSION['carrinho'] = array();
     $aluno = array();

     $_SESSION['param'] =  $_SESSION['matricula'];
   }




if(filter_input(INPUT_POST, "btnGravar", FILTER_SANITIZE_STRING)){

    $aluno["nome"] = filter_input(INPUT_POST, "nome", FILTER_SANITIZE_STRING);
    $aluno["matricula"] = filter_input(INPUT_POST, "matricula", FILTER_SANITIZE_STRING);
    $aluno["senha"] = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

   // $_SESSION["aluno"] = $aluno;
     $itensVendas = array();

      if(isset($_SESSION['carrinho'])){
       $itensVendas = $_SESSION['carrinho'];

   }

      $itensVendas[] =$aluno;
      $_SESSION['carrinho'] = $itensVendas;
      $_SESSION['vagas']--;
      $_SESSION['matricula'] += 1;

    }

    if(filter_input(INPUT_POST, "remover", FILTER_SANITIZE_STRING)){


      $itensVendas = $_SESSION['carrinho'];
      unset($itensVendas[$_POST['indice']]);
       $itensVendasNovo  = array();




      foreach($itensVendas as $item) {
        $itensVendasNovo[] = $item;
      }

     

      for($i = 0; $i < count($itensVendasNovo); $i++){
         for($j = 0; $j < count($itensVendasNovo); $j++){

         $itensVendasNovo[$i]["matricula"] = $_SESSION['param'];
         $itensVendasNovo[$i]["senha"] = $_SESSION['param'];
         }

     }

     for($i = 0; $i < count($itensVendasNovo); $i++){
         for($j = 0; $j < count($itensVendasNovo); $j++){

         $itensVendasNovo[$i]["matricula"] = $_SESSION['param'] + $i;
          $itensVendasNovo[$i]["senha"] = $_SESSION['param'] + $i;
         }

     }


      $_SESSION['carrinho'] = $itensVendasNovo;

    
      $_SESSION['vagas']++;
      $_SESSION['matricula'] -= 1;




    }

     if(filter_input(INPUT_POST, "Cancelar", FILTER_SANITIZE_STRING)){

           unset($_SESSION['nome']);
           unset($_SESSION['vagas']);
           unset($_SESSION['dataI']);
           unset($_SESSION['dataT']);
           unset($_SESSION['cdCurso']);
           unset($_SESSION['turno']);
           unset($_SESSION['carrinho']);
            unset($_SESSION['matricula']);
          echo '<script type="text/javascript"> window.location.href = "index.php?pagina=turmas";</script>';


     }

      if(filter_input(INPUT_POST, "FinalizareCadastrar", FILTER_SANITIZE_STRING)){

        $indice = $_POST['indice'];
        
        $profTurma= [];
        $turmaProf = [];
        
        for($i = 1; $i <=2; $i++){
            $cont = $_POST['estado'.$i];
            $profTurma['cdProfessor'] = $_POST['cidade'.$cont];
            $profTurma['cdDisciplina'] = $_POST['disci'.$i]; 
            
            $turmaProf[] = $profTurma;
        }
        
  
    

           $turma['nome'] =   $_SESSION['nome'];
           $turma['vagas'] =  $_SESSION['vagas'];
           $turma['dataI'] =  $turmaController->inverterdata($_SESSION['dataI']);
           $turma['dataT'] = $turmaController->inverterdata($_SESSION['dataT']);

           $turma['cdCurso'] = $_SESSION['cdCurso'];
           $turma['turno'] =  $_SESSION['turno'];

           $alunosTurma = $_SESSION['carrinho'];

      //     $indice = filter_input(INPUT_POST, "indice", FILTER_SANITIZE_NUMBER_INT);
      //     $professorTurma = [];
      //     for($i = 0; $i < $indice; $i++){
      //         if (isset($_POST["profe".$i])){

      //            $professor["cdProfessor"] = $_POST["profe".$i];
      //            $professor["cdDisciplina"] = $_POST["disci".$i];


      //             $professorTurma[] = $professor;
      //         }

      //     }
         
       $_SESSION['cadastro'] = $turmaController->cadastroTurma($turma, $alunosTurma, $turmaProf);

            unset($_SESSION['nome']);
            unset($_SESSION['vagas']);
            unset($_SESSION['dataI']);
            unset($_SESSION['dataT']);
            unset($_SESSION['cdCurso']);
            unset($_SESSION['turno']);
            unset($_SESSION['carrinho']);
             unset($_SESSION['matricula']);
          //  header("Location: index.php?pagina=turmas");
           echo '<script type="text/javascript"> window.location.href = "index.php?pagina=turmas";</script>';

      }

?>
