<?php
include_once ("controllers/ChamadaController.php");
include_once ("controllers/NotasController.php");
include_once ("controllers/InserirNotasAction.php");
?>

<script>
    document.getElementById('turmas').style.backgroundColor = '#dd4024';
</script>
<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas">EDITAR NOTAS</h1>

            <div class="row">

                <form method="post" action="?pagina=notas">
                    <input type="hidden" name="cdDisciplina" value="<?php echo $disciplina ?>">
                    <input type="hidden" name="cdTurma" value="<?php echo $turma; ?>">
                    <div class="form-group col-md-2 pull-right">
                        <input type="submit" class="btn laranjaIMEP pull-right col-md-12" value="Voltar">
                    </div>

                </form>
            </div>

            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Alunos

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>

                        <form method="POST">
                            <th class="centralizar col-md-6">Nome</th>
                            <th class="centralizar col-md-1">Nota</th>
                            <th class="centralizar col-md-1">Status</th>
                            </tr>
                            </thead>
                            <tbody>
                                <?php
                                $indice = 1;
                                foreach ($alunos as $aluno) {
                                    ?>

                                    <tr>
                                <input type="hidden" name="indiceAluno[]" value="<?php echo $aluno['cdAluno']; ?>">
                                <td class="centralizar"><?php echo $aluno['nome']; ?></td>
                                <td class="centralizar"><input type="text" value="<?php echo $aluno['nota']; ?>"   name="notas[]"  class="form-control"></td>
                                <input type="hidden" name="indice" value="<?php echo $indice; ?>"> 
                                <input type="hidden" name="cdNota[]" value="<?php echo $aluno['cdNota']; ?>"> 
                                <td>
                                    <select class="form-control" name="status[]">
                                        <option value="1" <?php if ($aluno['status'] == 1) { ?> selected=""<?php } ?> >Presente</option>
                                        <option value="0"  <?php if ($aluno['status'] == 0) { ?> selected=""<?php } ?>>N/A</option>
                                    </select>

                                </td>
                                </tr>
                                <?php
                                $indice++;
                            }
                            ?>

                            </tbody>
                    </table>
                    </ul>

                </div>

            </div>
            <center>
                <input type="hidden" name="cardeneta" value="<?php echo $_POST['cardeneta']; ?>">

                <input type="submit" class="btn laranjaIMEP" value="Finalizar notas" name="editarnotas">
            </center>
            </form>

        </div>
    </div>
</div>
