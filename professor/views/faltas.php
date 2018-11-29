<?php
include_once ("controllers/FaltasController.php");
include_once ("controllers/FaltasAction.php");
?>

<script>
    document.getElementById('turmas').style.backgroundColor = '#dd4024';
</script>
<div id="page-wrapper">
    <div class="container-fluid"  style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas">FALTAS</h1>


            <div class="row">

                <div class="form-group col-md-3 ">
                    <label>Turma</label>
                    <input type="text" class="form-control col-md-6 input-lg-novo" disabled="" value="<?php echo $nomes["nome"]; ?>" >
                </div>
                <div class="form-group col-md-3 ">
                    <label>Disciplina</label>
                    <input type="text" class="form-control col-md-6 input-lg-novo" disabled="" value="<?php echo $nomes["Dnome"]; ?>">
                </div>

                <div class="form-group col-md-3 ">
                    <label>Módulo</label>
                    <input type="text" class="form-control col-md-6 input-lg-novo" disabled="" value="<?php echo $nome["nome"]; ?>">
                </div>
                <div class="form-group col-md-3">
                    <label>&nbsp;</label>
                    <a href="?pagina=aulas">  <button  class="btn laranjaIMEP col-md-12" >Voltar</button></a>
                </div>


            </div>  
            <div class="table-responsive">
                <table class="table table-bordered table-condensed table-hover">
                    <thead>
                        <tr>


                            <th class="centralizar col-md-1">Nome do aluno</th>
                            <th class="centralizar col-md-1">Quantidade Faltas</th>
                            <th class="centralizar col-md-1">Ação</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $falta = new FaltasController();
                        foreach ($alunos as $aluno) {

                            $dado = $falta->BuscarFaltas($aluno["cdAluno"], $disciplina, $modulo, $turma)
                            ?>
                            <tr>

                                <td class="centralizar"><?php echo $aluno['nome']; ?></td>
                                <td class="centralizar"><?php if($dado['faltas']> 0){ echo $dado['faltas'];}else{ echo "0"; }?></td>
                                <td class="centralizar">   <button class="btn btn-primary btn-sm"
                                                                   data-toggle="modal" data-id="<?= $aluno['cdAluno'] ?>"
                                                                   data-target="#modal_f<?= $aluno['cdAluno'] ?>">Visualizar</button>           </td>


                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>

            <?php foreach ($alunos as $aluno) { ?>
                <!---Modal Faltas------------------>

                <div class="modal fade  " id="modal_f<?php echo $aluno['cdAluno']; ?>" >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel">Faltas</h4>
                            </div>
                            <div class="modal-body">
                                <?php
                                $falta = new FaltasController();

                                $dados = $falta->BuscarFalta($aluno['cdAluno'], $disciplina, $modulo, $turma);
                                ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-hover">
                                        <thead>
                                            <tr>
                                                <th>N° Faltas</th>
                                                <th>Data</th>
                                                <th>Assunto</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($dados as $dado) { ?>
                                                <tr>
                                                    <td><?php echo $dado["quantaulas"];?></td>
                                                    <td><?php echo $falta->inverterdata($dado["data"]); ?></td>
                                                    <td><?php echo $dado["descricao"]; ?></td>

                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>


                            </div>
                        </div>
                    </div>
                </div>  
            <?php } ?>
        </div>
    </div>
</div>
</div>