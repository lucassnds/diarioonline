<?php
include_once ("controllers/MediaController.php");
include_once ("controllers/FaltasController.php");
include_once ("controllers/MediaAction.php");
?>
<script>
    document.getElementById('turmas').style.backgroundColor = '#dd4024';
</script>
<div id="page-wrapper">
    <div class="container-fluid"  style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas">MÉDIAS</h1>
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
                    <a href="?pagina=notas">  <button  class="btn laranjaIMEP col-md-12" >Voltar</button></a>
                </div>


            </div> 

            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Atividades

                </div>
                <?php  $notasController = new MediaController(); ?>

                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>

                                <th class="centralizar col-md-4">Alunos</th>
                                <?php for($i = 1; $i <= $quantNotas["quantnotas"]; $i++ ){ ?>
                                   <th class="centralizar col-md-1"><?= $i ?>° Nota</th>
                                <?php } ?>
                                   <th class="centralizar col-md-1">Média</th>      
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            foreach ($aluno as $al) {
                          
                                  $soma = 0;
                                ?>
                                <tr>
                                    <td class="centralizar"><?php echo $al['nome']; ?></td>
                                    <?php 
                                        foreach ($c as $s){
                                         
                                            $d = $notasController->BuscarNotas($s["cdCardeneta"], $al["cdAluno"]);
                                            
                                            $soma += $d["nota"];
                                             
                                            ?>
                                              <td class="centralizar"><?php echo $d['nota']; ?></td>
                                   <?php    } ?>
                                    
                                      <td class="centralizar"><?php  if($criterio == 1){ echo $soma; }else{ echo number_format($soma/$quantNotas["quantnotas"], 2, ',', ''); }?></td>          
                                </tr>
                      
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>