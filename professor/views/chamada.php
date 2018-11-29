<?php
include_once ("controllers/ChamadaController.php");
include_once ("controllers/ChamadaAction.php");
?>

<script>
    function sub() {
        // alert("Lbdfiuhuflckdhskcla");
        // var el = document.getElementById('che');
        document.getElementById('sub').disabled = false;
        document.getElementById('label').innerHTML = "[  X ]Aula substituta";

    }
    function buscar_cidades() {
        
       test = '#estado';
        load = '#load_cidades' ;
        var estado = $(test).val();


        if (estado) {
            var url = 'models/buscar_prof.php?estado=' + estado;
            $.get(url, function (dataReturn) {
                $(load).html(dataReturn);
            });
        }
    }
    document.getElementById('turmas').style.backgroundColor = '#dd4024';
</script>
<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;" >
        <div class="fonte">
            <h1 class="header_paginas">CHAMADA</h1>

            <div class="row">
                <form method="post" action="?pagina=aulas">
                    <input type="hidden" name="cdDisciplina" value="<?php echo $disciplina; ?>">
                    <input type="hidden" name="cdTurma" value="<?php echo $turma; ?>">
                    <div class="form-group col-md-2 pull-right">
                        <input type="submit" class="btn laranjaIMEP pull-right col-md-12" value="Voltar">
                    </div>
            </div>
            </form>
            <form method="POST">
                <div class="row">
                    <div class="form-group col-md-6">
                        <label>Observação</label>
                        <textarea class="form-control" name="obs" ></textarea>
                    </div>
                    <div class="form-group col-md-2">
                        <label  id="label">Aula substituta?</label>
                        <select class="form-control col-md-" name="estado" id="estado" onchange="buscar_cidades()">
                            <option value="1">Não</option>
                            <option value="2">Sim</option>
                        </select>

                    </div>
                    <div class="form-group col-md-4">
                        <div id="load_cidades">
                            <label>Professores</label>
                            <select  class="form-control" name="cidade" disabled="" id="cidade">
                                <option value="">Selecione o Professor</option>
                            </select>
                        </div>
                    </div>

                </div>


                <div class="panel panel-primary panel-tabela">
                    <div class="panel-heading panel-titulo laranjaIMEP ">Alunos

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-condensed table-hover">
                            <thead>
                                <tr>


                                    <th class="centralizar col-md-4">Nome</th>
                                    <th class="centralizar col-md-2">Presença</th>
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
                                <td class="centralizar"><input type="checkbox" value="1" checked="" name="presenca<?php echo $indice; ?>"  class="form-control"></td>
                                <input type="hidden" name="indice" value="<?php echo $indice; ?>">    

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
                    <input type="hidden" name="assunto" value="<?php echo $_POST['assunto']; ?>">
                    <input type="hidden" name="data" value="<?php echo $_POST['data']; ?>">
                    <input type="hidden" name="numAulas" value="<?php echo $_POST['numAulas']; ?>">
                    <input type="hidden" name="horarioEntrada" value="<?php echo $_POST['horarioEntrada']; ?>">
                    <input type="hidden" name="horarioSaida" value="<?php echo $_POST['horarioSaida']; ?>">
                    <input type="hidden" name="disciplina" value="<?php echo $_POST['disciplina']; ?>">
                    <input type="hidden" name="turma" value="<?php echo $_POST['turma']; ?>">
                    <input type="hidden" name="modulo" value="<?php echo $_POST['modulo']; ?>">
                    <input type="submit" class="btn laranjaIMEP" value="Finalizar chamada" name="fazerchamada">

                </center>
            </form>

        </div>
    </div>
</div>
