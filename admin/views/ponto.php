<?php
include_once ("controllers/PontoController.php");
include_once ("controllers/PontoAction.php");
?>
<script>
    document.getElementById('ponto').style.backgroundColor = '#dd4024';

</script>
<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas ">PONTOS</h1>
            
              <?php if (isset($cadastro)) { ?>
                <?php if ($cadastro == 1) { ?>
                    <script> CadastroSucesso();</script>
                <?php } else { ?>
                    <script> CadastroErro()();</script>
                    <?php
                }
            }
            ?>
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

                <div class="form-group col-md-2 pull-left">
                    <button class="btn laranjaIMEP " id="t" data-toggle="modal" data-target="#meu_modal_novo" value=""> <i class="glyphicon glyphicon-plus"></i> Nova descrição</button>
                </div>
                <div class="form-group col-md-2 pull-left">
                    <a href="?pagina=folha">  <button class="btn  laranjaIMEP " > Gerar folha de pontos</button></a>
                </div>

            </div>        

            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Descrições de pontos cadastrados
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-condensed"> 
                        <thead>
                            <tr>

                                <th>Nome</th>
                                <th class="centralizar col-md-1">Editar</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resT as $titu) { ?>


                                <tr>
                                    <td> <?php echo $titu['nome']; ?></td>                                                        
                                    <td  class="centralizar" ><button class="btn btn-warning btn-sm" data-toggle="modal" data-id="<?= $titu['cdUsuario'] ?>"
                                                                      data-target="#modal_editar<?= $titu['cdDescricaoPonto'] ?>">EDITAR</button>

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
                <div class="modal fade " id="modal_editar<?= $titu['cdDescricaoPonto'] ?>"  >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>Editar</strong> </h4>
                            </div>

                            <div class="modal-body">
                                <form method="POST">
                                    <label>Nome</label>
                                    <input type="text" required="" name="nome" class="form-control" value="<?php echo $titu["nome"] ?>">


                                    </div>


                                    <div class="modal-footer">
                                        <input type="hidden" name="titulacao"  value="<?= $titu['cdDescricaoPonto'] ?>">
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
            <!----------------------------------------------MODAL DE CADASTRO Titulação------------------------------------------------------------>    

            <div class="modal fade novo_aluno" id="meu_modal_novo" >
                <div class="modal-dialog " >
                    <div class="modal-content"> 
                        <div class="modal-header"> 
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myLargeModalLabel"><strong>Nova Descrição do Ponto</strong></h4> 
                        </div>

                        <form id="cadastro-form" method="POST" role="form" autocomplete="off"> 
                            <div class="modal-body">
                                <div class="form-group row wow fadeInDown">
                                    <div class="col-md-12">
                                        <label for="nome">Nome:</label>
                                        <input class="form-control" type="text" title="Digite o Nome" x-moz-errormessage="Digite o Nome." required="" name="nome" id="nome" /><br />
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="submit" name="btnGravarDesc" class="btn btn-success btn-send" value="Cadastrar">
                                <input type="reset" value="Limpar" class="btn btn-primary btn-send" >
                            </div>
                        </form> 
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>