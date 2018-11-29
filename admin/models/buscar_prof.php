<?php

	include_once ("../../Conexao.php");
    $banco = new Conexao();

$estado = $_GET['estado'];
$sql = "SELECT * FROM professor WHERE cdTitulacao = $estado ORDER BY nome";

$res = $banco->executarQuery($sql);



?>

<select class="form-control" name="cidade<?php echo $estado; ?>" id="cidade">
  <?php foreach($res as $value ){
    echo "<option value='{$value['cdProfessor']}'>{$value['nome']}</option>";
  }
?>
</select>