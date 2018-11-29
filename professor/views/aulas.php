<?php
include_once ("controllers/AulasController.php");
include_once ("controllers/AulasAction.php");
include_once ("controllers/ChamadaController.php");
include_once ("views/horarios.php");
?>
<script>
    document.getElementById('turmas').style.backgroundColor = '#dd4024';
</script>
<div id="page-wrapper">
    <div class="container-fluid"  style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas">AULAS</h1>
            <?php if (isset($_SESSION['cadastro'])) { ?>
                <?php if ($_SESSION['cadastro'] == 1) { ?>
                    <script> ChamadaSucesso();</script>
                    <?php
                    unset($_SESSION['cadastro']);
                } else {
                    ?>
                    <script> ChamadaErro();</script>

                    <?php unset($_SESSION['cadastro']); ?>

                    <?php
                }
            }
            ?>

            <?php if (isset($_SESSION["alterar"])) { ?>
                <?php if ($_SESSION["alterar"] == 1) { ?>
                    <script> AlteracaoSucesso();</script>
                    <?php
                    unset($_SESSION["alterar"]);
                } else {
                    ?>
                    <script> AlteracaoErro();</script>   
                    <?php
                    unset($_SESSION["alterar"]);
                }
            }
            ?>
            <div class="row" >
                <form method="POST" autocomplete="off" action="?pagina=chamada">

                    <div class="form-group col-md-3 ">
                        <label>Assunto da aula</label>
                        <input type="text" class="form-control col-md-6 input-lg-novo" title="Descrição da aula" x-moz-errormessage="Descrição da aula" required="" name="assunto"  placeholder="Assunto da aula">
                    </div>

                    <div class="form-group col-md-3">
                        <label>Módulo aplicado</label>
                        <select class="form-control"  name="modulo" required="">
                            <option value="">Selecione..</option>
                            <?php foreach ($_SESSION['modulos'] as $mod) { ?>
                                <option value="<?php echo $mod['cdModulo']; ?>"><?php echo $mod['nome']; ?></option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2 " >
                        <label>Quantidade de aulas</label>
                        <select class="form-control" required="" name="numAulas">
                            <option value="">Selecione..</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                            <option value="7">7</option>
                            <option value="8">8</option>
                            <option value="9">9</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                        </select>
                    </div>

                    <div class="form-group col-md-2">
                        <label>Horário de entrada</label>
                        <select class="form-control"  name="horarioEntrada" required="">
                            <?php
                            switch ($periodo->turno) {
                                case 1:
                                    HorarioManha();
                                    break;
                                case 2:
                                    HorarioTarde();
                                    break;
                                case 3:
                                    HorarioNoite();
                                    break;
                            }
                            ?>
                        </select>
                    </div>
                    <div class="form-group col-md-2">
                        <label>Horário de saida</label>
                        <select class="form-control"  name="horarioSaida" required="">
                            <?php
                            switch ($periodo->turno) {
                                case 1:
                                    HorarioManha();
                                    break;
                                case 2:
                                    HorarioTarde();
                                    break;
                                case 3:
                                    HorarioNoite();
                                    break;
                            }
                            ?>
                        </select>
                    </div>


                    <div class="form-group col-md-3 ">
                        <label>Disciplina da aula </label>
                        <input type="text" class="form-control col-md-6 input-lg-novo" disabled=""  required="" value="<?php echo $_SESSION['nomeD']; ?>" >
                    </div>
                    <div class="form-group col-md-3">
                        <label>Data da aula</label>
                        <input type="text" class="form-control col-md-6 input-lg-novo" disabled="" value="<?php echo date('d/m/Y'); ?>" title="Digite a Data" x-moz-errormessage="Digite a Data" required="" name="data" placeholder="Data da Aula">
                    </div>

                    <div class="form-group col-md-2 ">
                        <label>Turma</label>
                        <input type="text" class="form-control col-md-6 input-lg-novo" disabled=""  required="" value="<?php echo $_SESSION['nomeT']; ?>" >
                        <input type="hidden"   required="" value="<?php echo $disciplina; ?>" name="disciplina" >
                        <input type="hidden"   required="" value="<?php echo $turma; ?>" name="turma">
                    </div>
                    <div class="form-group col-md-2">
                        <label>&nbsp;</label>
                        <input type="submit" class="btn laranjaIMEP col-md-12" value="Fazer a chamada">
                    </div>


                </form>
                <div class="form-group col-md-2">
                    <label>&nbsp;</label>
                    <a href="?pagina=turmas">  <button  class="btn laranjaIMEP col-md-12" >Voltar</button></a>
                </div>
            </div>  

            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Aulas

                </div>


                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>


                                <th class="centralizar col-md-1">Assunto</th>
                                <th class="centralizar col-md-1">Módulo</th>
                                <th class="centralizar col-md-1">Data</th>
                                <th class="centralizar col-md-1" >Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $modulo = new AulasController();
                            foreach ($resTurmas as $aula) {
                                ?>
                                <tr>
                                    <?php $nomeM = $modulo->BuscarModulo($aula['cdModulo']) ?>
                                    <td class="centralizar"><?php echo $aula['descricao']; ?></td>
                                    <td class="centralizar"><?php echo $nomeM['nome'] ?></td>
                                    <td class="centralizar"><?php echo $modulo->inverterdata($aula['data']); ?></td>

                                    <td class="centralizar"><button class="btn btn-primary btn-sm" data-toggle="modal" data-id="<?= $aula['cdAula'] ?>"
                                                                    data-target="#modal_visualizar<?= $aula['cdAula'] ?>" >Visualizar</button> <button class="btn btn-danger btn-sm"
                                                                    data-toggle="modal" data-id="<?= $aula['cdAula'] ?>"
                                                                    data-target="#meu_modal<?= $aula['cdAula'] ?>">Excluir</button>


                                        <button class="btn btn-warning btn-sm"
                                                data-toggle="modal" data-id="<?= $aula['cdAula'] ?>"
                                                data-target="#obs_modal<?= $aula['cdAula'] ?>">Editar</button>

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
                            data-toggle="modal" data-id="modal_faltas<?= $aula['cdAula'] ?>"
                            data-target="#modal_faltas<?= $aula['cdAula'] ?>">Faltas</button>
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
                <div class="modal fade " id="modal_visualizar<?= $aula['cdAula'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
                    <div class="modal-dialog" >
                        <div class="modal-content"   >
                            <div class="modal-header">
                                <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>Visualizar</strong> </h4>
                            </div>
                            <?php
                            $chamada = new AulasController();
                            $dados = $chamada->DadosDaAula($aula['cdAula']);
                            $dados = mysqli_fetch_object($dados);

                            $turma = $chamada->BuscarNomes($dados->cdTurma, $dados->cdDisciplina);
                            ?>

                            <div class="modal-body" style="overflow-y: scroll; overflow-x: hidden; max-height:70vh;  ">

                                <div class="row">
                                    <div class="col-md-6">
                                        <label class="">Nome da Turma</label>
                                        <input type="text" class="form-control" disabled="" value="<?php echo $turma['nome']; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="">Assunto</label>
                                        <input type="text" class="form-control" disabled="" value="<?php echo $dados->descricao; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="">Disciplina</label>
                                        <input type="text" class="form-control" disabled="" value="<?php echo $dados->Dnome; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="">Módulo</label>
                                        <input type="text" class="form-control" disabled="" value="<?php echo $dados->nome; ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="">Data da aula</label>
                                        <input type="text" class="form-control" disabled="" value="<?php echo $chamada->inverterdata($dados->data); ?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label class="">Observação</label>
                                        <input type="text" class="form-control" disabled="" value="<?php echo $dados->observacao; ?>">
                                    </div>

                                </div>



                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th class="centralizar" >Aluno</th>
                                                <th class="centralizar" >Presença</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $avnderson = $chamada->VisualizarChamada($aula['cdAula']);

                                            while ($obj = mysqli_fetch_object($avnderson)) {
                                                ?>
                                                <tr>
                                                    <td class="centralizar" > <?php echo $obj->nome; ?></td>
                                                    <td class="centralizar" > <?php echo $chamada->ConverterPresenca($obj->status); ?></td>

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

                <div class="modal fade  " id="meu_modal<?php echo $aula['cdAula']; ?>" >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                                <h4 class="modal-title" id="myLargeModalLabel">Tem certeza que você deseja apagar essa aula?</h4>

                            </div>
                            <form method="POST" action="Controllers/Excluir.php">
                                <div class="modal-footer">
                                    <input type="hidden" value="<?php echo $aula['cdAula']; ?>" name="cdaula">

                                    <input type="submit" name="Sim" value="Sim" class="btn btn-success btn-send" >
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!---Modal Editar----------------->

                <div class="modal fade  " id="obs_modal<?php echo $aula['cdAula']; ?>" >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel">Editar</h4>
                            </div>
                            <?php $mod = $chamada->BuscarModulos($aula['cdDisciplina']);
                            ?>
                            <form method="POST" >
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="form-group col-md-6">
                                            <label>Assunto</label>
                                            <input type="text" name="assunto"  required="" class="form-control" value="<?php echo $aula['descricao']; ?>" />
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Módulo</label>
                                            <select class="form-control" name="modulo" required="" >
                                                <?php foreach ($mod as $modu) { ?> 
                                                    <option value="<?= $modu["cdModulo"] ?>" <?php if ($aula["cdModulo"] == $modu["cdModulo"]) { ?> selected=""<?php } ?>  ><?= $modu["nome"] ?></option>
                                                <?php } ?> 
                                            </select>

                                        </div>
                                    </div>
                                    <label>Observação</label>
                                    <textarea class="form-control" name="obs" ><?php echo $aula['observacao']; ?></textarea>

                                </div>

                                <div class="modal-footer">
                                    <input type="hidden" value="<?php echo $aula['cdAula']; ?>" name="cdaula">

                                    <input type="submit" name="salvar" value="Salvar" class="btn btn-success btn-send" >
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            <?php } ?>
            <!---Modal Faltas------------------>

            <div class="modal fade  " id="modal_faltas<?php echo $aula['cdAula']; ?>" >
                <div class="modal-dialog " >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                            <h4 class="modal-title" id="myLargeModalLabel">Escolha o módulo para visualizar as faltas</h4>

                        </div>
                        <div class="modal-body">
                            <?php
                            $dados = $chamada->DadosDaAula($aula["cdAula"]);
                            $dados = mysqli_fetch_array($dados);

                            $mod = $chamada->BuscarModulos($dados['cdDisciplina']);
                            ?>
                            <form method="POST" action="index.php?pagina=faltas" > 
                                <select class="form-control"  name="modulo" required="">
                                    <option value="">Selecione</option>
                                    <?php foreach ($mod as $modu) { ?>
                                        <option value="<?php echo $modu['cdModulo']; ?>"><?php echo $modu['nome']; ?></option>

                                    <?php } ?>
                                </select>

                                <div class="modal-footer">

                                    <input type="hidden" name="cdDisciplina" value="<?php echo $dados['cdDisciplina']; ?>">
                                    <input type="hidden" name="cdTurma" value="<?php echo $dados['cdTurma']; ?>">
                                    <input type="submit" name="sim" value="Continuar" class="btn btn-success btn-send" >
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>


                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  



            <br><br><br>
        </div>

    </div>
</div>
