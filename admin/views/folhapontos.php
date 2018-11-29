<?php
include_once ("controllers/FolhaPontosController.php");
include_once ("controllers/FolhaPontosAction.php");
?>
<script>
    document.getElementById('ponto').style.backgroundColor = '#dd4024';

</script>
<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas ">FOLHA DE PONTOS</h1>


            <div class="row">
                <form method="POST">      
                    <div class="form-group col-md-3 ">
                        <label>Mês</label>
                        <select class="form-control" name="mes" required="">
                            <option value="">Selecione..</option>
                            <option value="1">Janeiro</option>
                            <option value="2">Fevereiro</option>
                            <option value="3">Março</option>
                            <option value="4">Abril</option>
                            <option value="5">Maio</option>
                            <option value="6">Junho</option>
                            <option value="7">Julho</option>
                            <option value="8">Agosto</option>
                            <option value="9">Setembro</option>
                            <option value="10">Outubro</option>
                            <option value="11">Novembro</option>
                            <option value="12">Dezembro</option>
                        </select>
                    </div>
                    <div class="form-group col-md-3 ">
                        <label>&nbsp;</label><br>
                        <input type="submit" class="btn btn-success"  name="gerar" value="Gerar Pontos" >
                    </div>
                </form>

                <div class="form-group col-md-2 pull-right">
                    <label>&nbsp;</label><br>
                    <a href="?pagina=ponto" class="btn laranjaIMEP pull-right col-md-12" >Voltar</a>
                </div>


            </div>

            <?php if (isset($desc)) { ?>

                <div class="panel panel-primary panel-tabela">
                    <div class="panel-heading panel-titulo laranjaIMEP ">Folha

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-condensed">
                            <thead>
                                <tr>

                                    <th>Nome do Professor</th>
                                    <?php foreach ($desc as $de) { ?>
                                        <th class="centralizar col-md-1"><?php echo $de["nome"]; ?></th>
                                    <?php } ?>
                                    <th class="centralizar col-md-1">Ação</th>


                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($professores as $prof) {
                                    ?>
                                    <tr>
                                        <td><?php echo $prof["nome"]; ?></td>
                                        <?php
                                        $folhaController = new FolhaPontosController();
                                        $aff = $folhaController->BuscarDescPonto();

                                        foreach ($aff as $dess) {

                                            $dados = $folhaController->BuscarPonto($mes, $prof["cdProfessor"], $dess["cdDescricaoPonto"]);

                                            if ($dados["horas"] != NULL) {
                                                ?>
                                                <td  class="centralizar"><?php echo $dados["horas"]; ?> </td>
                                            <?php } else { ?>
                                                <td  class="centralizar"><?php echo "0"; ?>  </td> 
                                                <?php
                                            }
                                        }
                                        ?>

                                        <td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal_visualizar<?= $prof['cdProfessor'] ?>">Visualizar</button></td>

                                    </tr>

                                <?php }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php
                foreach ($professores as $prof) {
                    ?>
                    <!---MODAL DE EDITAR-->
                    <div class="modal fade " id="modal_visualizar<?= $prof['cdProfessor'] ?>"  >
                        <div class="modal-dialog " >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myLargeModalLabel"><strong>Pontos Registrados</strong> </h4>
                                </div>
                                <?php
                                $folhaController = new FolhaPontosController();

                                $dados = $folhaController->Pontosregistrados($prof["cdProfessor"], $mes);
                                ?>
                                <div class="modal-body">
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-condensed table-hover">
                                            <thead>
                                                <tr>
                                                    <th class="centralizar">N⁰ Horas</th>
                                                    <th class="centralizar">Data</th>
                                                    <th class="centralizar">Turma</th>
                                                    <th class="centralizar">Entrada</th>
                                                    <th class="centralizar">Saída</th>
                                                    <th class="centralizar">Motivo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($dados as $point) { ?>
                                                    <?php
                                                    $name = new FolhaPontosController();
                                                    if (isset($point['turma'])) {
                                                        $nome = $name->BuscarNomes($point["turma"], $point["cdDescricaoPonto"]);
                                                    } else {
                                                        $nome = $name->BuscarNome($point["cdDescricaoPonto"]);
                                                        $nome["turma"]["nome"] = "N/T";
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td class="centralizar"> <?php echo $point['numHoras']; ?></td>
                                                        <td class="centralizar"> <?php echo $name->inverterdata($point['data']); ?></td>
                                                        <td class="centralizar"><?php echo $nome['turma']["nome"]; ?></td>
                                                        <td class="centralizar"><?php echo $point['entrada']; ?></td>
                                                        <td class="centralizar"><?php echo $point['saida']; ?></td>
                                                        <td class="centralizar"><?php echo $nome['motivo']["nome"]; ?></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">

                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
            ?>


        </div>
    </div>
</div>