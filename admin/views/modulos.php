<?php
include_once ("controllers/ModuloController.php");
include_once ("controllers/ModuloAction.php");
?>
<script>
    document.getElementById('modulo').style.backgroundColor = '#dd4024';
    
</script>

<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas ">MÓDULOS</h1>

            <?php if (isset($cadastro)) { ?>
                <?php if ($cadastro == 1) { ?>
                    <script> CadastroSucesso();</script>
                <?php } else { ?>
                    <script> CadastroErro()();</script>
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
                        <input type="text" class="form-control col-md-6 input-lg-novo" title="Digite sua Busca" x-moz-errormessage="Digite sua Busca." required="" name="buscar" id="buscar" placeholder="Nome do módulo">
                    </div>
                </form>

                <div class="form-group col-md-2 pull-left">
                    <button class="btn laranjaIMEP "
                            data-toggle="modal" data-target="#meu_modal" value=""><i class="glyphicon glyphicon-plus"></i> Novo Módulo</button>
                </div>

            </div> 

            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Módulos Cadastrados

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-hover table-condensed ">
                        <thead>
                            <tr>

                                <th >Nome</th>
                                <th class="centralizar col-md-2">Carga Horária</th>
                                <th class="centralizar col-md-2" >Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($resModulo as $modulos) { ?>

                                <tr>
                                    <td> <?php echo $modulos['nome']; ?></td>
                                    <td class="centralizar"> <?php echo $modulos['cargaHoraria']; ?></td>
                                    <td  class="centralizar" ><button class="btn btn-warning btn-sm" data-toggle="modal" data-id="<?= $modulos['cdModulo'] ?>"
                                                                      data-target="#modal_informacoes<?= $modulos['cdModulo'] ?>">Editar</button>

                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-id="<?= $modulos['cdModulo'] ?>"
                                                data-target="#modal_descricao<?= $modulos['cdModulo'] ?>">Descrição</button>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

<?php foreach ($resModulo as $modulos) { ?>
                        <!--MODAL DE EDITAR------------------------------------------------------------>
                        <div class="modal fade " id="modal_informacoes<?= $modulos['cdModulo'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"   >
                            <div class="modal-dialog " >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" id="myLargeModalLabel"><strong>Editar </strong></h4>
                                    </div>

                                    <form id="cadastro-form" method="POST" role="form">
                                        <div class="modal-body">
                                            <div class="form-group row wow fadeInDown">
                                                <div class="col-md-12">
                                                    <input class="form-control" type="hidden" hidden=""  name="cdModuloINFO" id="cdModuloINFOO" value="<?php echo $modulos['cdModulo']; ?>"/>
                                                    <label for="nome">Nome:</label>
                                                    <input class="form-control" type="text"  name="nomeINFO" id="nomeINFO" value="<?php echo $modulos['nome']; ?>"/><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nome">Carga horária:</label>
                                                    <input class="form-control" type="number"  name="chINFO" id="loginINFO" value="<?php echo $modulos['cargaHoraria']; ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nome">Descrição:</label>
                                                    <textarea class="form-control" type="text" name="descricaoINFO" id="descricaoINFO"  ><?php echo $modulos['descricao']; ?></textarea><br>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" name="btnUpdate" class="btn btn-success btn-send" value="Guardar Alterações">
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--MODAL DE Descrição--------------->
                    <div class="modal fade " id="modal_descricao<?= $modulos['cdModulo'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
                        <div class="modal-dialog " >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myLargeModalLabel"><strong>Descrição </strong></h4>
                                </div>

                                <div class="modal-body">
                                    <div class="form-group row wow fadeInDown">

                                        <div class="col-md-12">

                                            <?php
                                            if ($modulos['descricao'] == NULL) {
                                                echo "Esse módulo não possui nenhuma descrição";
                                            } else {
                                                echo $modulos['descricao'];
                                            }
                                            ?>
                                        </div>

                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

<?php } ?>
               </div> <!-----------------------------------------------FIM DO MODAL DESCRIÇAO------------------------------------------------------->

                <!-----------------------------------------------BOTOES PAGINAÇÃO------------------------------------------------------->


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
    <?php } ?>
                            </ul>
                            <div>Página <?php echo $numdaPagina; ?> de <?php echo $numPaginas; ?></div><br>
                        </div>
                    </form>
                <?php } else { ?>
                    <div class= "text-center"><?php echo $totalModulo; ?> Módulo(s) Encontrado(s)</div><br>
<?php } ?>
        


        <!----------------------------------------------MODAL DE CADASTRO Modulo------------------------------------------------------------>

        <div class="modal fade novo_aluno" id="meu_modal"   >
            <div class="modal-dialog " >
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myLargeModalLabel"><strong>Cadastrar Módulo</strong></h4>
                    </div>

                    <form id="cadastro-form" method="POST" autocomplete="off">
                        <div class="modal-body" >
                            <div class="form-group row wow fadeInDown">
                                <div class="col-md-12">
                                    <label for="nome">Nome:</label>
                                    <input class="form-control" type="text" title="Digite o Nome" x-moz-errormessage="Digite o Nome." required="" name="nome" id="nome" /><br />
                                </div>
                                <div class="col-md-6">
                                    <label for="nome">carga Horária:</label>
                                    <input class="form-control" type="number"  title="Coloque apenas numeros" x-moz-errormessage="Coloque apenas numeros" required="" name="ch" id="ch" value="" />
                                </div>
                            </div>
                            <div class="form-group row fadeInDown">
                                <div class="col-md-6">
                                    <label for="comment">Descrição:(Opcional)</label>
                                    <textarea class="form-control" type="text" rows="4" id="descricao" name="descricao"></textarea>
                                </div>

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