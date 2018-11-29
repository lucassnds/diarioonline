<?php
session_start();

include_once("autenticar.php");
?>
<!DOCTYPE html>

<html>
    <head>
        <meta  charset="utf-8">
        <title> INMEP </title>
        <link href="files/estiloLogin.css" rel="stylesheet" type="text/css"/>
          <link href="files/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="files/js/jquery-3.1.1.min.js" type="text/javascript"></script>
        <script src="files/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="files/js/bootstrap-notify.min.js" type="text/javascript"></script>
        <script src="files/js/notificacao.js" type="text/javascript"></script>
        <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
    <script language="JavaScript">
        function putFocus(formInst, elementInst) { if (document.forms.length > 0) { document.forms[formInst].elements[elementInst].focus(); } }
    </script>
    
    </head>
    <body onLoad="putFocus(0,0);">
        <?php if (!isset($_SESSION['logado'])) { ?> 
            <div class="login">
                <h1>Login</h1>

                <form class="form" method="post"name="form" >
                    <div id="img"> <img src="files/img/logo2.png"></div>
                    <br>
                    <p class="field" >
                       
                        <input style=" color: #000!important;"  type="text" name="login" placeholder="Usuário" required/>
                         <i style=" color: #000!important;" class="glyphicon glyphicon-user"></i>
                    </p>

                    <p class="field">
                        <input style=" color: #000!important;" type="password" name="senha" placeholder="Senha" required/>
                            <i  class="glyphicon glyphicon-lock"></i>
                    </p>

                    <p class="submit"><input type="submit" name="go" value="Login"></p>


                </form>
            </div> <!--/ Login-->


            <?php if (isset($_SESSION['erro'])) {
                if ($_SESSION['erro'] == 1) {
                    ?>
                    <script> LoginErro2();</script>
                <?php }else{ ?>
                <script> LoginErro();</script>
                <?php unset($_SESSION['erro']);
            } }
            ?>

        <?php
        } else if (isset($_SESSION['usuario']['cdNivel'])) {

            switch ($_SESSION['usuario']['cdNivel']) {
                case 1:
                    header("Location: admin/index.php");
                    break;
                case 2:
                    # code...
                    break;
                case 3:
                    header("Location: professor/index.php");
                    break;
                case 4:
                    header("Location: admin/index.php");
                    break;
                default:
                    # code...
                    break;
            }
        } else {
            header("Location: index.php");
        }
        ?>


    </body>
</html>
