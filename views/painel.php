
<?php include_once '../views/menu_opc.php';?>



<header>
    <h1 class="fL">
    <a href="?pagina=home" title="logo"><img id="logo" src="../files/img/logo.png" style="width: 180px"></a>
    </h1>
  
    <input type="checkbox" id="control-nav" hidden="" />
    <label for="control-nav" class="control-nav"></label>
    <label for="control-nav" class="control-nav-close"></label>

 
     <?php menu_adm() ?>
     

    </header>
  <div id="menu_lateral">
      
      <a href="?pagina=editarperfil" id="editar_perfil" style="text-decoration: none;"><span  class="glyphicon glyphicon-cog" ></span> &nbsp;Editar Perfil</a>
      
  </div>
<div >
                <div class="col-lg-912" id="dvConteudo">
                    <?php
                    include_once ('RequestPage.php');
                    ?>
                    <div class="clear"></div>
                </div>

            </div>
    



