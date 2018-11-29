<?php

include_once("Conexao.php");
$usu = [];
$banco = new Conexao();

if (filter_input(INPUT_POST, "go", FILTER_SANITIZE_STRING)) {
   

    $usu["login"] = filter_input(INPUT_POST, "login", FILTER_SANITIZE_STRING);
    $usu["senha"] = filter_input(INPUT_POST, "senha", FILTER_SANITIZE_STRING);

    $sql = "SELECT * FROM usuario WHERE login = '{$usu['login']}'";
    
   


    $result = mysqli_fetch_assoc($banco->executarQuery($sql));



    if ($result['login'] != '') {

        if ($result['senha'] == $usu['senha']) {
             
            if ($result['status'] == 1) {
                
                    $usu['cdUsuario'] = $result['cdUsuario'];
                    $usu['login'] = $result['login'];
                    $usu['status'] = $result['status'];
                    $usu['cdNivel'] = $result['cdNivel'];

                if ($result['cdNivel'] == 4) {
     
                    $usu['nome'] = $result['nome'];
                    $_SESSION['usuario'] = $usu;
                    $_SESSION['logado'] = true;
                    
                }else if ($result['cdNivel'] == 1) {
     
                    $usu['nome'] = $result['nome'];
                    $_SESSION['usuario'] = $usu;
                    $_SESSION['logado'] = true;
                    
                } else if ($result['cdNivel'] == 5) {
     
                    $usu['nome'] = $result['nome'];
                    $_SESSION['usuario'] = $usu;
                    $_SESSION['logado'] = true;
                    
                }else if ($result['cdNivel'] == 3) {
                    
                    $sql = "SELECT * FROM professor WHERE cdUsuario = '{$result['cdUsuario']}'";
                    $resultado = mysqli_fetch_assoc($banco->executarQuery($sql));

                    $usu['cdProfessor'] = $resultado['cdProfessor'];
                    $usu['cdTitulacao'] = $resultado['cdTitulacao'];
                    $usu['nome'] = $resultado['nome'];

                    $_SESSION['usuario'] = $usu;
                    $_SESSION['logado'] = true;
                }else if($result['cdNivel'] == 2){
                    
                    $sql = "SELECT * FROM aluno WHERE cdUsuario = '{$result['cdUsuario']}'";
                    $resultado = mysqli_fetch_assoc($banco->executarQuery($sql));

                    $usu['cdAluno'] = $resultado['cdAluno'];
                    $usu['nome'] = $resultado['nome'];

                    $_SESSION['usuario'] = $usu;
                    $_SESSION['logado'] = true;
                    
                }




                switch ($result['cdNivel']) {
                    case 1:
                        header("Location: admin/index.php");
                        break;
                    case 2:
                         header("Location: aluno/index.php");
                        break;
                    case 3:
                        header("Location: professor/index.php");
                        break;
                    case 4:
                        header("Location: admin/index.php");
                        break;
                    case 5:
                        header("Location: coordenador/index.php");
                        break;
                    default:
                        # code...
                        break;
                }
            } else {
                $_SESSION['erro'] = 1;

                //header("Location: index.php");
            }
        } else {
            $_SESSION['erro'] = "Usuário ou Senha inválido";

            //header("Location: index.php");
        }
    } else {
        $_SESSION['erro'] = "Usuário ou Senha inválido";
        ///header("Location: index.php");
    }
}
?>

