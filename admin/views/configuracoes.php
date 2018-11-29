<?php
if ($_SESSION['usuario']['cdNivel'] == 4) {
    include_once ("controllers/ConfigController.php");
    include_once ("controllers/ConfigAction.php");
    ?>
<script>
    document.getElementById('admin').style.backgroundColor = '#dd4024';
    
</script>
    <div id="page-wrapper">
        <div class="container-fluid" style="min-height:89vh;">
            <div class="fonte">
                <h1 class="header_paginas ">ADMINISTRADORES</h1>

                <?php if (isset($cadastro)) { ?>
                    <?php if ($cadastro == 1) { ?>
                        <script> CadastroSucesso();</script>
                    <?php } else { ?>
                        <script> LoginErro()();</script>
                    <?php }
                    ?>

                <?php } ?>

                <?php if (isset($alterarcadastro)) { ?>
                    <?php if ($alterarcadastro == 1) { ?>
                        <script> AlteracaoSucesso();</script>
                    <?php } else { ?>
                        <script> AlteracaoErro()();</script>
                        <?php
                    }
                }
                ?>  
                <div class="row ">
                    <form method="POST" autocomplete="off">
                        <div class="form-group col-md-2 pull-right">
                            <input type="submit" class=" laranjaIMEP form-control " value="Buscar" name="btnBuscar" >
                        </div>
                        <div class="form-group col-md-5 pull-right">
                            <input type="text" class="form-control col-md-6 input-lg-novo" title="Digite sua Busca" x-moz-errormessage="Digite sua Busca." required="" name="buscar" id="buscar" placeholder="Nome do administrador">
                        </div>
                    </form>

                    <div class="form-group col-md-2 pull-left">
                        <button class="btn laranjaIMEP "
                                data-toggle="modal" data-target="#meu_modal" value=""><i class="glyphicon glyphicon-plus"></i> Novo Administrador</button>
                    </div>

                </div> 


                <div class="panel panel-primary panel-tabela">
                    <div class="panel-heading panel-titulo laranjaIMEP ">Administradores Cadastrados

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>

                                    <th  >Nome</th>
                                    <th class="centralizar col-md-3">Login</th>
                                    <th class="centralizar col-md-1">Situação</th>
                                    <th class="centralizar col-md-1">Editar</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($resAdm as $adm) { ?>


                                    <tr>
                                        <td> <?php echo $adm['nome']; ?></td>
                                        <td class="centralizar"> <?php echo $adm['login']; ?></td>

                                        <?php if ($adm['status'] == 1) { ?>
                                            <td class="centralizar"><input class="btn btn-success btn-sm" type="button" value="Liberado"  data-toggle="modal" data-target="#meu_modal<?php echo $adm["cdUsuario"] ?>"  ></td>
                                        <?php } else { ?>
                                            <td class="centralizar"><input class="btn btn-danger btn-sm" type="button" value="Bloqueado"  data-toggle="modal" data-target="#meu_modal<?php echo $adm["cdUsuario"] ?>"  ></td>
                                        <?php } ?>

                                        <td  class="centralizar" ><button class="btn btn-warning btn-sm" data-toggle="modal" data-id="<?= $adm['cdUsuario'] ?>"
                                                                          data-target="#modal_editar<?= $adm['cdUsuario'] ?>"
                                                                          >EDITAR</button>

                                        </td>

                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!----------------------------FIM DO MODAL HISTORICO------------------------------------------------------>
                <?php if (!isset($controle)) { ?>
                    <form method="POST">
                        <div class= "text-center">
                            <ul class="pagination">
                                <li><input name="inicio" hidden=""  value="<?php echo $inicio; ?>" ></li>
                                <li><input name="nPagina" hidden=""  value="<?php echo $numdaPagina; ?>" ></li>
                                <?php if ($inicio <= 0) { ?>
                                    <li><input  type="submit" class="btn btn-primary disabled laranjaIMEP" disabled="" name="voltar" value="&larr;"></a></li>
                                <?php } else { ?>
                                    <li><input  type="submit" class="btn btn-primary laranjaIMEP" name="voltar" value="&larr;"></a></li>
                                <?php } ?>
                                <?php if ($numdaPagina >= $numPaginas) { ?>
                                    <li><input  type="submit" class="btn btn-primary disabled laranjaIMEP" disabled="" name="proximo" value="&rarr;"></a></li>
                                <?php } else { ?>
                                    <li><input  type="submit" class="btn btn-primary laranjaIMEP" name="proximo" value="&rarr;"></a></li>
                                <?php } ?>
                            </ul>
                            <div>Página <?php echo $numdaPagina; ?> de <?php echo $numPaginas; ?></div><br>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class= "text-center"><?php echo $totalAdm; ?> Administradore(s) Encontrado(s)</div><br>
                <?php } ?>


                <?php foreach ($resAdm as $adm) { ?>
                    <!----------------------------------------------MODAL DE EDITAR ADM------------------------------------------------------------>

                    <div class="modal fade novo_aluno" id="modal_editar<?php echo $adm['cdUsuario']; ?>"   >
                        <div class="modal-dialog " >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myLargeModalLabel"><strong>EDITAR ADMINISTRADOR</strong></h4>
                                </div>

                                <form id="cadastro-form" method="POST" autocomplete="off">
                                    <div class="modal-body">
                                        <div class="form-group row wow fadeInDown">
                                            <div class="col-md-12">
                                                <label for="nome">Nome:</label>
                                                <input class="form-control"  type="hidden" value="<?php echo $adm['cdUsuario']; ?>" name="cdusuario"  /><br />

                                                <input class="form-control"  type="text" value="<?php echo $adm['nome']; ?>" title="Digite o Nome" x-moz-errormessage="Digite o Nome." required="" name="nome"  /><br />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nome">Login:</label>
                                                <input class="form-control" type="text" value="<?php echo $adm['login']; ?>" disabled title="Digite o Login" x-moz-errormessage="Digite o Nome." required="" name="login"  /><br />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nome">Senha:</label>
                                                <input class="form-control" type="text" value="<?php echo $adm['senha']; ?>" title="Digite o Senha" x-moz-errormessage="Digite o Nome." required="" name="senha"  /><br />
                                            </div>
                                        </div>

                                        <div class="modal-footer">
                                            <input type="submit" name="btnUpdate" class="btn btn-success btn-send" value="Cadastrar">
                                            <input type="reset" value="Limpar" class="btn btn-primary btn-send" >
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <!---Modal Cursando-------------------------->

                <div class="modal fade  " id="meu_modal<?php echo $adm['cdUsuario']; ?>"   >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php if ($adm['status'] == 1) { ?>   <h4 class="modal-title" id="myLargeModalLabel">Deseja Desativar este administrador ?</h4>
                                <?php } else { ?>
                                    <h4 class="modal-title" id="myLargeModalLabel">Deseja ativar este administrador ?</h4>
                                <?php } ?>
                            </div>
                            <form method="POST">
                                <div class="modal-footer">
                                    <input type="hidden" value="<?php echo $adm['status']; ?>" name="status">
                                    <input type="hidden" value="<?php echo $adm['cdUsuario']; ?>" name="cdusuario">
                                    <input type="submit" name="Sim" value="Sim" class="btn btn-success btn-send" >
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>



            <!----------------------------------------------MODAL DE CADASTRO ADM------------------------------------------------------------>

            <div class="modal fade novo_aluno" id="meu_modal">
                <div class="modal-dialog " >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myLargeModalLabel"><strong>CADASTRO DE ADMINISTRADOR</strong></h4>
                        </div>

                        <form id="cadastro-form" method="POST" autocomplete="off">
                            <div class="modal-body">
                                <div class="form-group row wow fadeInDown">
                                    <div class="col-md-12">
                                        <label for="nome">Nome:</label>
                                        <input class="form-control" type="text"  autocomplete="off"title="Digite o Nome" x-moz-errormessage="Digite o Nome." required="" name="nome"  /><br />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nome">Login:</label>
                                        <input class="form-control" type="text" title="Digite o Login" x-moz-errormessage="Digite o Nome." required="" name="login"  /><br />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nome">Senha:</label>
                                        <input class="form-control" type="password" title="Digite o Senha" x-moz-errormessage="Digite o Nome." required="" name="senha"  /><br />
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <input type="submit" name="btnGravar" class="btn btn-success btn-send" value="Cadastrar">
                                    <input type="reset" value="Limpar" class="btn btn-primary btn-send" >
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
    <?php
} else {

    echo '<script type="text/javascript"> window.location.href = "index.php?pagina=home";</script>';
}?>