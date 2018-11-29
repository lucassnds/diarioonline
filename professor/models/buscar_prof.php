<?php
include_once ("../../Conexao.php");
$banco = new Conexao();

$estado = $_GET['estado'];
if ($estado == 2) {


    $sql = "SELECT * FROM professor  ORDER BY nome";

    $res = $banco->executarQuery($sql);
    ?>
    <label>Professores</label>
    <select class="form-control" name="cidade" id="cidade">
    <?php
    foreach ($res as $value) {
        echo "<option value='{$value['cdProfessor']}'>{$value['nome']}</option>";
    }
    ?>
    </select>

<?php } else { ?>

    <label>Professores</label>
    <select  class="form-control" name="cidade" disabled="" id="cidade">
        <option value="">Selecione o Professor</option>
    </select>


<?php }
?>