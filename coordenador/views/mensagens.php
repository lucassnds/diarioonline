<?php
include_once ("controllers/MensagensController.php");
include_once ("controllers/MensagensAction.php");
?>
<script>
    document.getElementById('msg').style.backgroundColor = '#dd4024';
    document.getElementById('carta').style.color = '#FFF';
</script>
<div id="page-wrapper" >
    <div class="container-fluid"  style="min-height:89vh;">
        <div class="fonte" style="height: 100%;">
            <h1 class="header_paginas ">MENSAGENS</h1>
                
            <?php if (isset($_SESSION["msg"])) { ?>
                <?php if ($_SESSION["msg"] == 1) { ?>
                    <script> MsgSucesso();</script>
                <?php unset($_SESSION["msg"]);} else { ?>
                    <script> AlteracaoErro()();</script>
                    <?php
                }
            }
            ?>

            <form method="POST">
                <div class="row">

                    <div class="form-group col-lg-6">
                        <label>Mensagem</label>
                        <textarea class="form-control" cols="1" rows="3" name="conteudo" required=""></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-lg-5">
                        <label>Destinatário</label>
                        <select class="form-control" name="destinatario" required="">
                            <option value="">Selecione....</option>
                            <?php foreach ($destinatario as $dest) { ?>
                                <option value="<?php echo $dest["cdUsuario"]; ?>"><?php echo $dest["nome"]; ?></option>

                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>&nbsp;</label><br>
                        <input type="submit" class="btn btn-success" value="Enviar" name="mandarMensagens">
                    </div>
                </div>
            </form>
            <div class="panel panel-primary panel-tabela ">
                <div class="panel-heading panel-titulo laranjaIMEP ">Mensagens Recebidas</div>
                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>
                                <th>Remetente</th>
                                <th class="centralizar col-md-2">Data</th>
                                <th class=" col-md-2">Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $msg = new MensagensController();
                            foreach ($meeeeeen as $men) {
                                $nome = $msg->BuscarNomes($men["remetente"]);
                                ?>
                                <tr>
                                    <td><?php echo $nome["nome"]; ?></td>
                                    <td class="centralizar"><?php echo $msg->inverterdata($men["dataMensagem"]); ?></td>
                                    <td class="centralizars"><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#myModal<?php echo$men["cdMensagem"]; ?>">Visualizar</button></td>
                                </tr>
                                <!-- Modal -->
                            <div id="myModal<?php echo $men["cdMensagem"]; ?>" class="modal fade" role="dialog">
                                <div class="modal-dialog">

                                    <!-- Modal content-->
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                            <h4 class="modal-title">Mensagem</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p><?php echo $men["conteudo"]; ?></p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
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

        </div>
    </div>
</div>