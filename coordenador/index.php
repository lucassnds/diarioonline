<?php session_start(); 


  if(isset($_GET['pagina'])){

    if($_GET['pagina'] === "sair"){
       session_destroy();
       header("Location: ../index.php");
    }
  }



if(isset($_SESSION['logado']) == false){

     header("Location: ../index.php");
 
}else{
?>

<?php include_once 'views/menu.php'; ?>
<!DOCTYPE html>

<html>
    <head>
        <meta  charset="utf-8">
       <title>INMEP</title>

         <link href="../files/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
         <link href="files/estilo_paginas.css" rel="stylesheet" type="text/css"/>
     
         <script src="../files/js/jquery-3.1.1.min.js" type="text/javascript"></script>
<!--         <script src="http://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->
         <script src="../files/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
         <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1, maximum-scale=1, user-scalable=no" />
         <script src="../files/js/jquery.mask.min.js" type="text/javascript"></script>
         <script src="../files/js/mascaras.js" type="text/javascript"></script>
<!--         <link href="files/estilo_menu.css" rel="stylesheet" type="text/css"/>-->
         <link href="files/sb-admin.css" rel="stylesheet" type="text/css"/>
         <link href="https://fonts.googleapis.com/css?family=Roboto+Slab" rel="stylesheet"> 
         <script src="../files/js/bootstrap-notify.min.js" type="text/javascript"></script>
         <script src="../files/js/notificacao.js" type="text/javascript"></script>
       
         
<!--      
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">-->

  
<!--  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>-->

  
  
    </head>
    <body>
    
<div id="wrapper">
<header><?php
    if ($_SESSION['usuario']['cdNivel'] == 1) { 
        menu_subadm();
    } else {
        menu();
    }
    ?>
</header>
  <?php
        include_once ('RequestPage.php');
        ?>
        <div class="clear"></div>
    




</div>
    </body>
</html>
<?php } ?>




