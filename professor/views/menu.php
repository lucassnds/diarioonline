<?php

function menu() { ?> 



    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top fonte" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle taumaporra" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand"  href="index.php"><div style="margin-top:-8px;"> <img  class="" src="../files/img/logo2.png" style="width: 150px;"></div> </a>

        </div>
        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown" id="msg" >
                    <a href="?pagina=msg" ><i class="glyphicon glyphicon-envelope" id="carta" ></i></a>
                   
                </li>

            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i> <?php echo $_SESSION['usuario']['nome']; ?> <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="?pagina=editarperfil"><i class="glyphicon glyphicon-user"></i>   Perfil</a>
                    </li>

                    <li class="divider"></li>
                    <li>
                        <a href="?pagina=sair"><i class="glyphicon glyphicon-log-out"></i>  Sair</a>
                    </li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li id="hom">
                    <a href="?pagina=home"><i class="glyphicon glyphicon-home"></i>  Início</a>
                </li>

                <li id="turmas" >
                    <a href="?pagina=turmas"><i class="glyphicon glyphicon-list"></i> Turmas</a>
                </li>
                <li id="ponto" >
                    <a href="?pagina=ponto"><i class="glyphicon glyphicon-list-alt"></i> Ponto</a>
                </li>

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>

<?php } ?>

