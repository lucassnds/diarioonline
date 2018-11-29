<?php
include_once ("../../Conexao.php");
$banco = new Conexao();

$estado = $_GET['estado'];
if ($estado > 0) {
    $sql = "SELECT * FROM aluno, turmaaluno WHERE aluno.cdAluno = turmaaluno.cdAluno and turmaaluno.cdTurma =  $estado ORDER BY nome";

    $res = $banco->executarQuery($sql);
    ?>

    <select class="form-control" name="aluno" id="aluno">
        <?php
        foreach ($res as $value) {
            echo "<option value='{$value['cdAluno']}'>{$value['nome']}</option>";
        }
        ?>
    </select>

<?php } else { ?>
    <select class="form-control" name="aluno" id="aluno" disabled="">
        <?php
      
            echo "<option value=''>Selecione...</option>";
        
        ?>
    </select>

<?php } ?>