<?php
include_once ("controllers/ChamadaController.php");
include_once ("controllers/NotasController.php");
include_once ("controllers/InserirNotasAction.php");
?>

<script>
    document.getElementById('turmas').style.backgroundColor = '#dd4024';
</script>
<div id="page-wrapper">
    <div class="container-fluid"  style="min-height:89vh;"> 
        <div class="fonte">
            <h1 class="header_paginas">INSERIR NOTAS</h1>

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

                      
                            <th class="centralizar col-md-6">Nome</th>
                            <th class="centralizar col-md-1">Nota</th>
                          
                            </tr>
                            </thead>
                            <tbody>  <form method="POST">
                                <?php
                                $indice = 1;
                                foreach ($alunos as $aluno) {
                                    ?>

                                    <tr>
                                <input type="hidden" name="indiceAluno[]" value="<?php echo $aluno['cdAluno']; ?>">
                                <td class="centralizar"><?php echo $aluno['nome']; ?></td>
                                <td class="centralizar"><input type="text"    name="presenca<?php echo $indice; ?>"  class="form-control"></td>
                                <input type="hidden" name="indice" value="<?php echo $indice; ?>">    
                            
                                </tr>
                                <?php
                                $indice++;
                            }
                            ?>

                            </tbody>
                    </table>
                   

                </div>

            </div>
            <center>
                <input type="hidden" name="assunto" value="<?php echo $_POST['assunto']; ?>">
                <input type="hidden" name="data" value="<?php echo $_POST['data']; ?>">
                <input type="hidden" name="disciplina" value="<?php echo $_POST['disciplina']; ?>">
                <input type="hidden" name="turma" value="<?php echo $_POST['turma']; ?>">
                <input type="hidden" name="modulo" value="<?php echo $_POST['modulo']; ?>">
                <input type="submit" class="btn laranjaIMEP" value="Finalizar notas" name="inserirnotas">
            </center>
            </form>

        </div>
    </div>
</div>
