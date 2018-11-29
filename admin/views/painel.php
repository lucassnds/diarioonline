
<?php include_once 'views/menu_opc.php'; ?>
<?php include_once 'views/menu.php'; ?>

<div id="wrapper">

<header>

    <?php
    if ($_SESSION['usuario']['cdNivel'] == 1) {
        menu_adm();
    } else {
        menu();
    }
    ?>


</header>

<div >
 
        <?php
        include_once ('RequestPage.php');
        ?>
        <div class="clear"></div>
    

</div>


</div>
