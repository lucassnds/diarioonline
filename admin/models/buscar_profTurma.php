<?php
include_once ("../../Conexao.php");
$banco = new Conexao();

$estado = $_GET['estado'];
if ($estado > 0) {
$sql = "SELECT * FROM turmaprofessor, professor WHERE turmaprofessor.cdProfessor = professor.cdProfessor and turmaprofessor.cdTurma = {$estado}";

$res = $banco->executarQuery($sql);
?>

<select class="form-control" name="cidade" required="" id="cidade">
<?php
foreach ($res as $value) {
    echo "<option value='{$value['cdProfessor']}'>{$value['nome']}</option>";
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

