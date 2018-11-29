<?php
include_once ("controllers/TitulacoesController.php");
include_once ("controllers/TitulacoesAction.php");
?>
<script>
    document.getElementById('titu').style.backgroundColor = '#dd4024';

</script>
<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas ">TITULAÇÕES</h1>
            
              <?php if (isset($alterarcadastro)) { ?>
                <?php if ($alterarcadastro == 1) { ?>
                    <script> AlteracaoSucesso();</script>
                <?php } else { ?>
                    <script> AlteracaoErro()();</script>
                    <?php
                }
            }
            ?>


            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Titulações Cadastrados

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-condensed">
                        <thead>
                            <tr>

                                <th  >Nome</th>
                                <th class="centralizar col-md-1">Editar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resT as $titu) { ?>


                                <tr>
                                    <td> <?php echo $titu['Tnome']; ?></td>                                                        
                                    <td  class="centralizar" ><button class="btn btn-warning btn-sm" data-toggle="modal" data-id="<?= $titu['cdUsuario'] ?>"
                                                                      data-target="#modal_editar<?= $titu['cdTitulacao'] ?>">EDITAR</button>

                                    </td>


                                <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
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
                            <?php } ?>  <div>Página <?php echo $numdaPagina; ?> de <?php echo $numPaginas; ?></div>
                        </ul>

                    </div>
                </form>
            <?php } else { ?>
                <div class= "text-center"><?php echo $totalAluno; ?> Aluno(s) Encontrado(s)</div><br>
            <?php } ?>
            <?php foreach ($resT as $titu) { ?>

                </tr>
                <!---MODAL DE EDITAR-->
                <div class="modal fade " id="modal_editar<?= $titu['cdTitulacao'] ?>"  >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>Editar</strong> </h4>
                            </div>

                            <div class="modal-body">
                                <form method="POST">
                                    <label>Nome</label>
                                    <input type="text" required="" name="nome" class="form-control" value="<?php echo $titu["Tnome"] ?>">
                                

                            </div>


                            <div class="modal-footer">
                                <input type="hidden" name="titulacao"  value="<?= $titu['cdTitulacao'] ?>">
                                <input type="submit" name="btnUpdate" class="btn btn-success btn-send" value="Guardar Alterações">
                                </form>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        <!---FIM DO MODAL EDIDAR-->
    </div>
</div>
</div>