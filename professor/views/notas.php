<?php
include_once ("controllers/AulasController.php");
include_once ("controllers/NotasController.php");
include_once ("controllers/MediaController.php");
include_once ("controllers/NotasAction.php");
?>

<script>
    document.getElementById('turmas').style.backgroundColor = '#dd4024';
</script>
<div id="page-wrapper">
    <div class="container-fluid"  style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas">NOTAS</h1>
            <?php if (isset($_SESSION['cadastro'])) { ?>
                <?php if ($_SESSION['cadastro'] == 1) { ?>
                    <script> NotaSucesso();</script>
                    <?php
                    unset($_SESSION['cadastro']);
                } else {
                    ?>
                    <script> NotaErro();</script>

                    <?php unset($_SESSION['cadastro']); ?>

                    <?php
                }
            }
            ?>

            <?php if (isset($_SESSION['alterar'])) { ?>
                <?php if ($_SESSION['alterar'] == 1) { ?>
                    <script> AlteracaoSucesso();</script>
                    <?php
                    unset($_SESSION['alterar']);
                } else {
                    ?>
                    <script> AlteracaoErro();</script>   
                    <?php
                    unset($_SESSION['alterar']);
                }
            }
            ?>

            <div class="row" >
                <form method="POST" autocomplete="off" action="?pagina=inserir">

                    <div class="form-group col-md-3 ">
                        <label>Nome da atividade</label>
                        <input type="text" class="form-control col-md-6 input-lg-novo" title="Descrição da aula" x-moz-errormessage="Descrição da aula" required="" name="assunto"  placeholder="Nome da atividade">
                    </div>
                    <div class="form-group col-md-3">
                        <label>Data da atividade</label>
                        <input type="date" class="form-control col-md-6 input-lg-novo"   title="Digite a Data" x-moz-errormessage="Digite a Data" required="" name="data" placeholder="Data da Aula">
                    </div>

                    <div class="form-group col-md-2 ">
                        <label>Módulo </label>
                        <input type="text" class="form-control col-md-6 input-lg-novo" disabled=""  required="" value="<?php echo $_SESSION['modulos']['nome']; ?>" >
                    </div>

                    <div class="form-group col-md-2 ">
                        <label>Disciplina da aula </label>
                        <input type="text" class="form-control col-md-6 input-lg-novo" disabled=""  required="" value="<?php echo $_SESSION['nomeD']; ?>" >
                    </div>

                    <div class="form-group col-md-2 ">
                        <label>Turma</label>
                        <input type="text" class="form-control col-md-6 input-lg-novo" disabled=""  required="" value="<?php echo $_SESSION['nomeT']; ?>" >
                        <input type="hidden"   required="" value="<?php echo $disciplina; ?>" name="disciplina" >
                        <input type="hidden"   required="" value="<?php echo $turma; ?>" name="turma">
                        <input type="hidden"   required="" value="<?php echo $_SESSION['modulo']; ?>" name="modulo">
                    </div>
                    <div class="form-group col-md-2 pull-left">
                        <input type="submit" class="btn laranjaIMEP" value="Inserir Notas">
                    </div>


                </form>
                <div class="form-group col-md-2 pull-right">
                    <a href="?pagina=turmas">  <button  class="btn laranjaIMEP col-md-12" >Voltar</button></a>
                </div>
            </div> 
            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Atividades

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>


                                <th class="centralizar col-md-4">Assunto</th>
                                <th class="centralizar col-md-3">Módulo</th>
                                <th class="centralizar col-md-2">Data</th>
                                <th class="centralizar col-md-1"></th>
                                <th class="centralizar col-md-1" ></th>
                                <th class="centralizar col-md-1"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $modulo = new AulasController();
                            foreach ($resTurmas as $aula) {
                                ?>
                                <tr>
                                    <?php $nomeM = $modulo->BuscarModulo($aula['cdModulo']) ?>
                                    <td class="centralizar"><?php echo $aula['assunto']; ?></td>
                                    <td class="centralizar"><?php echo $nomeM['nome'] ?></td>
                                    <td class="centralizar"><?php echo $aula['dataAtividade']; ?></td>

                                    <td class="centralizar"> <button class="btn btn-primary btn-sm" data-toggle="modal" data-id="<?= $aula['cdCardeneta'] ?>"
                                                                     data-target="#modal_visualizar<?= $aula['cdCardeneta'] ?>" >Visualizar</button> 

                                    </td> <td class="centralizar"><button class="btn btn-danger btn-sm  "
                                                                          data-toggle="modal" data-id="<?= $aula['cdCardeneta'] ?>"
                                                                          data-target="#meu_modal<?= $aula['cdCardeneta'] ?>">Excluir</button></td><td class="centralizar"><form method="POST" action="?pagina=editar">
                                            <input type="hidden" value="<?php echo $aula['cdCardeneta']; ?>"name="cardeneta" >
    <!--                                         <input type="hidden" value="<?php // echo $aula['cdTurma'];                 ?>"name="turma" >
                                              <input type="hidden" value="<?php // echo $aula['cdDisciplina'];                 ?>"name="disciplina" >-->
                                            <input type="submit" class="btn btn-warning btn-sm" value="Editar">
                                        </form>    

                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="row">
                <div class=" form-group col-md-3 pull-right">
                    <button class="btn btn-info btn-sm col-md-12"
                            data-toggle="modal" data-id="modal_medias"
                            data-target="#modal_medias">Médias</button>
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
                            <?php } ?>
                        </ul>
                        <div>Página <?php echo $numdaPagina; ?> de <?php echo $numPaginas; ?></div><br>
                    </div>
                </form>
            <?php } else { ?>
                <div class= "text-center"><?php echo $totalTurmas; ?> Turmas(s) Encontrada(s)</div><br>
            <?php } ?>

            <?php foreach ($resTurmas as $aula) { ?>
                <!---MODAL DE VISUALIZAR-->
                <div class="modal fade " id="modal_visualizar<?= $aula['cdCardeneta'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>Visualizar</strong> </h4>
                            </div>
                            <?php
                            $notas = new NotasController();

                            $dados = $notas->VisualizarCardeneta($aula['cdCardeneta']);

                            $dados = mysqli_fetch_object($dados);


                            $turm = $notas->BuscarAlunos($aula['cdTurma']);
                            ?>

                            <div class="modal-body" style="overflow-y: scroll; overflow-x: hidden; max-height:70vh;">
                                <div class="container">


                                    <div class="row">
                                        <label>Data da Atividade:</label>
                                        <label><?php echo $dados->dataAtividade; ?></label>
                                    </div>
                                    <div class="row">
                                        <label>Assunto:</label>
                                        <label><?php echo $dados->assunto; ?></label>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="centralizar" >Aluno</th>
                                                <th class="centralizar" >Nota</th>
                                                <th class="centralizar" >Status</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $avnderson = $notas->BuscarNotas($aula['cdCardeneta']);

                                            while ($obj = mysqli_fetch_object($avnderson)) {
                                                ?>
                                                <tr>
                                                    <td class="centralizar" > <?php echo $obj->nome; ?></td>
                                                    <td class="centralizar" > <?php echo $obj->nota; ?></td>
                                                    <td class="centralizar" > <?php echo $notas->StatusNota($obj->status); ?></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>

                                </div>


                            </div>
                            <div class="modal-footer">
                                <input type="hidden" name="btnUpdate" class="btn btn-success btn-send" value="Gerar PDF">
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!---FIM DO MODAL Visualizar-->

                <!---Modal Ativar e desativar------------------>

                <div class="modal fade  " id="meu_modal<?php echo $aula['cdCardeneta']; ?>" >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                                <h4 class="modal-title" id="myLargeModalLabel">Tem certeza que você deseja apagar essa atividade?</h4>

                            </div>
                            <form method="POST" action="Controllers/Excluir.php">
                                <div class="modal-footer">
                                    <input type="hidden" value="<?php echo $aula['cdCardeneta']; ?>" name="cdCardeneta">

                                    <input type="submit" name="Sim" value="Sim" class="btn btn-success btn-send" >
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>

            <div class="modal fade" id="modal_medias" >
                <div class="modal-dialog " >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myLargeModalLabel">Qual será o criterio da média?</h4>
                        </div>
                        <?php $buscaC = new MediaController();
                                $cri = $buscaC->BuscarCriterio($disciplina, $_SESSION['modulo'], $turma, $_SESSION["usuario"]["cdProfessor"]);
                        ?>
                        <form method="POST" action="index.php?pagina=medias">

                            <div class="modal-body">
                                <?php var_dump($cri);?>
                                <div class="row">
                                    <div class=" form-group col-md-12 ">
                                        <label>Critério</label>

                                        <select class="form-control"name="criterio" required="">
                                            <option value="">Selecione..</option>
                                            <option value="1" <?php if($cri["criterio"] == 1){ ?> selected="" <?php } ?> >Soma +</option>
                                            <option value="2" <?php if($cri["criterio"] == 2){ ?> selected="" <?php } ?>>Divisão ÷</option>

                                        </select>
                                    </div>
                                  
                                </div>

                            </div>
                            <div class="modal-footer">
                                <input type="hidden"   required="" value="<?php echo $disciplina; ?>" name="disciplina" >
                                <input type="hidden"   required="" value="<?php echo $turma; ?>" name="turma">
                                 <input type="hidden"   required="" value="<?php echo $cri["criterio"]; ?>" name="opc">
                                <input type="hidden"   required="" value="<?php echo $_SESSION['modulo']; ?>" name="modulo">
                                <input type="submit" name="Sim" value="Sim" class="btn btn-success btn-send" >
                                <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>


                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!---Modal Medias------------------>


        </div>
    </div>
</div>



