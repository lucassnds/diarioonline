<?php
include_once ("controllers/EditarPerfilController.php");
include_once ("controllers/editarperfilAction.php");
?>
<div id="page-wrapper">
    <div class="container-fluid">
        <div class="fonte" style="min-height:89vh;">
            <h1 class="header_paginas ">PERFIL</h1>
            <?php if (isset($alterarcadastro)) { ?>
                <?php if ($alterarcadastro == 1) { ?>
                    <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Sucesso!</strong> <?php echo "Alteração da senha feita com suceso"; ?></div>
                <?php } else { ?>
                    <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <strong>Erro!</strong><?php echo " Senha Incorreta! "; ?>
                    </div>
                <?php }
            }
            ?>
            <div>
                <form method="POST" autocomplete="off">
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Nome:</label>
                            <label  name="nome" class="form-control"><?php echo $_SESSION['usuario']['nome']; ?></label>

                        </div>
                        <div class="form-group col-md-6">
                            <label>Login:</label>
                            <label  name="nome" class="form-control"><?php echo $_SESSION['usuario']['login']; ?></label>
                        </div>

                    </div>
                    <div class="row">
                        <div class="form-group col-md-6">
                            <label>Senha:</label>
                            <input type="password"  name="senha" class="form-control">
                        </div>

                        <div class="form-group col-md-6">
                            <label>Nova Senha:</label>
                            <input type="password" name="novasenha" class="form-control">
                        </div>

                    </div>



                    <div class="row pull-right">
                        <div class="form-group col-md-6">
                            <input  type="submit" name="btn" value="Mudar Senha"class="btn btn-success">
                        </div>
                    </div>




                </form>

            </div>           

        </div>
    </div>
</div>

