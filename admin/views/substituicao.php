<?php
include_once ("controllers/SubstituicaoController.php");
include_once ("controllers/SubstituicaoAction.php");
?>
<script>

    document.getElementById('sub').style.backgroundColor = '#dd4024';
    function buscar_cidades() {
        test = '#estado';
        load = '#load_cidades';
        var estado = $(test).val();
     



      
            var url = 'models/buscar_profTurma.php?estado=' + estado;
            $.get(url, function (dataReturn) {
                $(load).html(dataReturn);
            });
       
    }
   

//
//    function mudar(num) {
//        if (num === 1) {
//            document.getElementById('conteudo').style.display = "block";
//            document.getElementById('menu').style.display = "none";
//        } else {
//            document.getElementById('conteudo2').style.display = "block";
//            document.getElementById('menu').style.display = "none";
//        }
//
//
//    }
//
//    function voltar() {
//        document.getElementById('conteudo').style.display = "none";
//        document.getElementById('conteudo2').style.display = "none";
//        document.getElementById('menu').style.display = "block";
//
//    }


</script>
<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;">
        <div class="fonte" >

            <h1 class="header_paginas ">SUBSTITUIÇÃO</h1><br><br>

            <?php if (isset($alterarcadastro)) { ?>
                <?php if ($alterarcadastro == 1) { ?>
                    <script> AlteracaoSucesso();</script>
                <?php } else { ?>
                    <script> AlteracaoErro()();</script>
                    <?php
                }
            }
            ?>  

           


            <div class="row" id="conteudo" >
                
                <form method="POST" autocomplete="off">
                    <div class="form-group col-md-4">
                        <label>Escolha o professor que vai substituir</label>
                        <select class="form-control" required="" name="professor">
                            <option value="">Selecione...</option>
                            <?php foreach ($professores as $prof) { ?>
                                <option value="<?php echo $prof["cdProfessor"]; ?>"><?php echo $prof["nome"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Turma</label>
                        <select class="form-control" name="estado" id="estado" required=""   onchange="buscar_cidades()">
                            <option value="">Selecione...</option>
                            <?php foreach ($turmas as $turma) { ?>
                                <option value="<?php echo $turma["cdTurma"]; ?>"><?php echo $turma["nome"]; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Escolha o professor que irá ser substituido</label>
                        <div id="load_cidades">
                            <select  class="form-control" name="cidade" id="cidade" disabled required="">
                                <option value="">Selecione o Professor..</option> 
                            </select>
                        </div>

                    </div>
                    <div class="form-group col-md-12">
                        <input type="submit"  class="btn laranjaIMEP" name="Sub"  value="Substituir">
                        </form>
                    </div>    


            </div>
       
        </div>
    </div>