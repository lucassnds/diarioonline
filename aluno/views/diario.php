    <?php
include_once ("controllers/DiarioController.php");
include_once ("controllers/DiarioAction.php");
?>
<script>
    document.getElementById('diario').style.backgroundColor = '#dd4024';
    
</script>
<div id="page-wrapper" >
    <div class="container-fluid"  style="min-height:89vh;">
        <div class="fonte" style="height: 100%;">
            <h1 class="header_paginas ">DIÁRIO</h1>
            <div class="row">
                <form method="POST">
                    <div class="form-group col-md-4">
                        <label>Turma - Curso</label>
                        <select class="form-control" name="curso">
                            <?php foreach ($turma as $tur) { ?>
                                <option value="<?php echo $tur["curso_cdCurso"]."/".$tur["cdTurma"]; ?>"><?php echo $tur["nomeTurma"]; ?> - <?php echo $tur["nomeCurso"]; ?> </option>
                            <?php } ?>
                        </select>

                    </div>

                    <div class="form-group col-md-4">
                        <label>&nbsp;</label><br>

                        <input type="submit" value="Buscar Notas" name="buscarNotas" class="btn btn-success btn-sm col-md-12">

                    </div>
                </form>
            </div>
            <div class="row"> 

                <?php
                if (isset($quantDisciplina)) {

                    foreach ($quantDisciplina as $disciplina) {
                        ?>
                        <div class="col-md-6">

                            <div class="panel panel-primary panel-tabela ">
                                <div class="panel-heading panel-titulo laranjaIMEP "><?php echo $disciplina["Dnome"]; ?> 

                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-condensed table-hover">
                                        <thead>
                                            <?php
                                            $diario = new DiarioController();
                                            $nomeModulos = $diario->BuscarModulos($disciplina["cdDisciplina"]);
                                            foreach ($nomeModulos as $nomeM) {
                                                $quant[] = $diario->QuantNotas($_SESSION["usuario"]["cdAluno"], $disciplina["cdDisciplina"], $nomeM["cdModulo"]);
                                            }


                                            $maior = $diario->Maior($quant);
                                            ?>
                                            <tr>
                                                <th class="centralizar col-md-4">Nome Módulo</th>
                                                <?php for ($i = 1; $i <= $maior; $i++) { ?>
                                                    <th class="centralizar col-md-1"><?php echo $i; ?>°Nota</th>
                                                <?php } unset($quant); ?>
                                                <th class="centralizar col-md-1">Média</th>
                                                <th class="centralizar col-md-1">Faltas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($nomeModulos as $nomeM) {
                                                ?>
                                                <tr>
                                                    <td class="centralizar"><?php echo $nomeM["nome"]; ?></td>
                                                    <?php
                                                    $notas = $diario->BuscarNotas($_SESSION["usuario"]["cdAluno"], $disciplina["cdDisciplina"], $nomeM["cdModulo"]);
                                                    $soma = 0;
                                                    $quantidade = $diario->QuantNotas($_SESSION["usuario"]["cdAluno"], $disciplina["cdDisciplina"], $nomeM["cdModulo"]);
                                                   $falta = $diario->BuscarFaltas($_SESSION["usuario"]["cdAluno"], $disciplina["cdDisciplina"], $nomeM["cdModulo"], $curso[1]);
                                                    if (mysqli_num_rows($notas) > 0) {
                                                        foreach ($notas as $nota) {
                                                            $soma += $nota["nota"];
                                                            ?>
                                                            <td class="centralizar"><?php echo $nota["nota"]; ?></td>
                                                            <?php
                                                        }
                                                    } else {
                                                        for ($i = 1; $i <= $maior; $i++) {
                                                            ?>
                                                            <td class="centralizar">&nbsp;</td>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <td class="centralizar"><?php
                                                        if ($nota["criterio"] == 2) {
                                                            if ($soma > 0) {
                                                                echo number_format($soma/$quantidade["quantidadeNotas"], 2, ',', '');
                                                            } else {
                                                                echo $soma;
                                                            }
                                                        } else {
                                                            echo $soma;
                                                        }
                                                        ?></td>
                                                    <td class="centralizar"><?php echo  $falta["faltas"]; ?></td>

                                                </tr>
                                          <?php } ?>
                                        </tbody>
                                    </table>
                                    </ul>
                                </div>
                            </div>
                        </div>

                         <?php
    }
} else {
    ?>
                    <div class="form-group col-md-12">
                        <h3>Escolha uma turma e clique em "Busca Notas"</h3>
<?php }
?>

                </div>
            </div>
        </div>
    </div>

