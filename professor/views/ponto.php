<?php
include_once ("controllers/PontoController.php");
include_once ("controllers/PontoAction.php");
include_once ("views/horarios.php");
?>

<script>
    document.getElementById('ponto').style.backgroundColor = '#dd4024';
</script>
<div id="page-wrapper">
    <div class="container-fluid" style="height:100vh;">
        <div class="fonte">
            <h1 class="header_paginas">PONTO</h1>


            <div class="row ">

                <div class="form-group col-md-2 pull-left">
                    <button class="btn laranjaIMEP "
                            data-toggle="modal" data-target="#modal_novo" value=""><i class="glyphicon glyphicon-plus"></i> Novo Ponto</button>
                </div>

            </div>

            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Folha de ponto
                </div>

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
                            <?php foreach ($resTurmas as $point) { ?>
                                <?php
                                $name = new PontoController();
                                if(isset($point['turma'])){
                                     $nome = $name->BuscarNomes($point["turma"], $point["cdDescricaoPonto"]);
                                }else{
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
                <div class= "text-center"><?php echo $totalTurmas; ?> Pontos(s) Encontrado(s)</div><br>
            <?php } ?>  

            <div class="modal fade " id="modal_novo" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
                <div class="modal-dialog " >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myLargeModalLabel"><strong>Novo Ponto</strong></h4>
                        </div>
                        <?php    $name = new PontoController();  
                        $motivo = $name->Motivo(); ?>
                        <div class="modal-body">
                            <form method="POST">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label>Quantidade de horas</label>
                                    <select class="form-control" required="" name="numHoras">
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
                                <div class="form-group col-md-6">
                                    <label>Data</label>
                                    <input type="date" class="form-control" name="data">
                                </div>

                                <div class="form-group col-md-6">
                                    <label>Horário entrarda</label>
                                    <select class="form-control" required="" name="entrada">
                                        <?php Horario(); ?>

                                    </select>

                                </div>
                                <div class="form-group col-md-6">
                                    <label>Horário saída</label>
                                    <select class="form-control" required="" name="saida">
                                        <?php Horario(); ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label>Motivo</label>
                                    <select class="form-control" required="" name="motivo">
                                        <option value="">Selecione..</option>
                                        <?php foreach ($motivo as $mot) { ?>
                                            <option value="<?php echo $mot["cdDescricaoPonto"]; ?>"><?php echo $mot["nome"]; ?></option>
                                        <?php } ?>
                                    </select>
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
