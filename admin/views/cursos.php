<?php
include_once ("controllers/CursoController.php");
include_once ("controllers/DisciplinaController.php");
include_once ("controllers/CursoAction.php");
?>
<script>
    document.getElementById('curso').style.backgroundColor = '#dd4024';
    
</script>
<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;">
        <div class="fonte" >

            <h1 class="header_paginas ">CURSOS</h1>

            <?php if (isset($resposta)) { ?>
                <?php if ($resposta == 1) { ?>
                    <script> CadastroSucesso();</script>
                <?php } else { ?>
                    <script> CadastroErro();</script>
                <?php }
                ?>

            <?php } ?>

            <?php if (isset($alterarcadastro)) { ?>
                <?php if ($alterarcadastro == 1) { ?>
                    <script> AlteracaoSucesso();</script>
                <?php } else { ?>
                    <script> AlteracaoErro();</script>
                    <?php
                }
            }
            ?>  

            <div class="row ">
                <form method="POST" autocomplete="off">
                    <div class="form-group col-md-2 pull-right">
                        <input type="submit" class=" laranjaIMEP form-control " value="Buscar" name="btnBuscar" >
                    </div>
                    <div class="form-group col-md-5 pull-right">
                        <input type="text" class="form-control col-md-6 input-lg-novo" title="Digite sua Busca" x-moz-errormessage="Digite sua Busca." required="" name="buscar" id="buscar" placeholder="Nome do curso">
                    </div>
                </form>

                <div class="form-group col-md-2 pull-left">
                    <button class="btn laranjaIMEP "
                            data-toggle="modal" data-target="#meu_modal" value=""><i class="glyphicon glyphicon-plus"></i> Novo Curso</button>
                </div>

            </div>        


            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Cursos Cadastrados

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover ">
                        <thead>
                            <tr>

                                <th  >Nome</th>
                                <th class="centralizar col-md-2">Carga Horária</th>
                                <th class="centralizar col-md-2" >Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resCurso as $dis) { ?>

                                <tr>
                                    <td> <?php echo $dis['nome']; ?></td>
                                    <td class="centralizar"> <?php echo $dis['cargaHoraria']; ?></td>
                                    <td class="centralizar" ><button class="btn btn-warning btn-sm" data-toggle="modal" data-id="<?= $dis['cdDisciplina'] ?>"
                                                                     data-target="#modal_informacoes<?= $dis['cdCurso'] ?>">Editar</button>

                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-id="<?= $dis['cdDisciplina'] ?>"
                                                data-target="#modal_descricao<?= $dis['cdCurso'] ?>">Disciplinas</button>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php foreach ($resCurso as $dis) { ?>
                        <!----------------------------------------------MODAL DE EDITAR------------------------------------------------------------>
                        <div class="modal fade " id="modal_informacoes<?= $dis['cdCurso'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"    >
                            <div class="modal-dialog " >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" style="color:#fff;" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" id="myLargeModalLabel"><strong>Editar</strong> </h4>
                                    </div>

                                    <form id="cadastro-form" method="POST" role="form">
                                        <div class="modal-body" style="overflow-y: scroll; max-height:70vh;">


                                            <div class="col-md-12">
                                                <input class="form-control" type="hidden" hidden=""  name="cdDisciINFO" id="cdDisciINFO" value="<?php echo $dis['cdCurso']; ?>"/>
                                                <label for="nome">Nome:</label>
                                                <input class="form-control" type="text"  name="nomeINFO" id="nomeINFO" value="<?php echo $dis['nome']; ?>"/><br />
                                            </div>
                                            <div class="col-md-6">
                                                <label for="nome">Carga horária:</label>
                                                <input class="form-control" type="number" disabled=""  name="chINFO" id="" value="<?php echo $dis['cargaHoraria']; ?>" />
                                            </div><br>

                                            <div class="modal-header col-md-12" style="margin-bottom:8px;">
                                                <h5 class="modal-title" id="myLargeModalLabel"><strong> Disciplinas do Curso</strong> </h5>
                                            </div>
                                            <div class="row">
                                                <?php
                                                $cursoController = new CursoController();

                                                $res = $cursoController->buscarDisciplinaCurso($dis['cdCurso']);

                                                $t = mysqli_fetch_assoc($res);
                                                ?>
                                                <div class="form-group col-md-12">    
                                                    <?php foreach ($res as $valor) { ?>
                                                        <div class="form-group col-md-4">
                                                            <input type="checkbox" name="disciplinas[]"  checked=""  autocomplete="off"  value="<?php echo $valor['cdDisciplina']; ?>"> <?php echo $valor['Dnome']; ?>
                                                        </div>
                                                    <?php } ?>
                                                </div>
                                            </div>

                                            <div class="modal-header col-md-12" style="margin-bottom:8px;">
                                                <h5 class="modal-title" id="myLargeModalLabel"><strong>Disciplinas Disponíveis</strong></h5>
                                            </div>
                                            <div class="row">
                                                <?php if ($t != NULL) { ?>

                                                    <?php
                                                    $disciplinaController = new DisciplinaController();
                                                    $result = $disciplinaController->buscarDisciplinas()
                                                    ?>
                                                    <?php
                                                    $c = NULL;
                                                    $g = NULL;
                                                    $Teste = false;

                                                    foreach ($result as $valor) {
                                                        foreach ($res as $val) {

                                                            if (($valor['cdDisciplina'] == $val['cdDisciplina'])) {
                                                                $g = $val['cdDisciplina'];
                                                            }
                                                        }
                                                        foreach ($res as $val) {
                                                            if (($valor['cdDisciplina'] == $val['cdDisciplina'])) {
                                                                $c = $val['cdDisciplina'];
                                                            } else if (($g != $valor['cdDisciplina']) && ($c != $valor['cdDisciplina']) && ($Teste == false)) {
                                                                $Teste = true;
                                                                ?>
                                                                <div class="form-group col-md-4">
                                                                    <input type="checkbox" name="disciplinas[]" s   autocomplete="off"  value="<?php echo $valor['cdDisciplina']; ?>"> <?php echo $valor['Dnome']; ?> 
                                                                </div>
                                                                <?php
                                                            }
                                                        }$Teste = false;
                                                    }
                                                    ?>

                                                <?php } else { ?>

                                                    <?php
                                                    $disciplinaController = new DisciplinaController();
                                                    $result = $disciplinaController->buscarDisciplinas()
                                                    ?>
                                                    <?php foreach ($result as $valor) { ?>
                                                        <div class="form-group col-md-4">
                                                            <input type="checkbox" name="disciplinas[]"   autocomplete="off"  value="<?php echo $valor['cdDisciplina']; ?>"> <?php echo $valor['Dnome']; ?> 
                                                        </div>
                                                    <?php } ?>

                                                <?php } ?>

                                            </div>

                                            <div class="modal-footer">
                                                <input type="submit" name="btnUpdate" class="btn btn-success btn-send" value="Guardar Alterações">
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>

                    <!----------------------------------------------MODAL DE Descrição------------------------------------------------------------>
                    <div class="modal fade " id="modal_descricao<?= $dis['cdCurso'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
                        <div class="modal-dialog " >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title" id="myLargeModalLabel"><strong>Disciplinas</strong></h4>
                                </div>

                                <div class="modal-body">
                                    <div class="row">



                                        <?php foreach ($res as $valor) { ?>
                                            <div class="col-md-4">
                                                <?php echo $valor['Dnome']; ?><strong> <?php echo $valor['cargaHoraria']; ?> H</strong>

                                            </div>
                                        <?php } ?>


                                    </div>


                                </div>
                            </div>
                        </div>
                    </div>

                <?php } ?>
            </div>
            <!-----------------------------------------------BOTOES PAGINAÇÃO------------------------------------------------------>

        </div>
        <?php if (!isset($controle)) { ?>
            <form method="POST">
                <div class= "text-center">
                    <ul class="pagination">
                        <li><input name="inicio" hidden=""  value="<?php echo $inicio; ?>" ></li>
                        <li><input name="nPagina" hidden=""  value="<?php echo $numdaPagina; ?>" ></li>
                        <?php if ($inicio <= 0) { ?>
                            <li><input  type="submit" class="btn btn-primary disabled laranjaIMEP" disabled="" name="voltar" value="&larr;"></a></li>
                        <?php } else { ?>
                            <li><input  type="submit" class="btn btn-primary laranjaIMEP" name="voltar" value="&larr;"></a></li>
                        <?php } ?>
                        <?php if ($numdaPagina >= $numPaginas) { ?>
                            <li><input  type="submit" class="btn btn-primary disabled laranjaIMEP" disabled="" name="proximo" value="&rarr;"></a></li>
                        <?php } else { ?>
                            <li><input  type="submit" class="btn btn-primary laranjaIMEP" name="proximo" value="&rarr;"></a></li>
                        <?php } ?>
                    </ul>
                    <div>Página <?php echo $numdaPagina; ?> de <?php echo $numPaginas; ?></div><br>
                </div>
            </form>
        <?php } else { ?>
            <div class= "text-center"><?php echo $totalCurso; ?> Curso(s) Encontrada(s)</div><br>
        <?php } ?>

    </div>

    <!----------------------------------------------MODAL DE CADASTRO Curso------------------------------------------------------------>

    <div class="modal fade fonte " id="meu_modal" >
        <div class="modal-dialog "  >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myLargeModalLabel"><strong>Cadastrar Curso</strong></h4>
                </div>

                <form id="cadastro-form" method="POST" autocomplete="off">
                    <div class="modal-body"  style="overflow-y: scroll; max-height:70vh;">
                        <div class="form-group row wow fadeInDown">
                            <div class="col-md-12">
                                <label for="nome">Nome:</label>
                                <input class="form-control" type="text" title="Digite o Nome" x-moz-errormessage="Digite o Nome." required="" name="nome" id="nome" /><br />
                            </div>
                        </div>
                        <div class="modal-header">

                            <h4 class="modal-title" id="myLargeModalLabel"><strong>Disciplinas</strong></h4>
                        </div>


                        <?php
                        $disciplinaController = new DisciplinaController();
                        $disciplinas = $disciplinaController->buscarDisciplinas();
                        ?>
                        <div class="row">
                             <div class="form-group col-md-12">
                            <?php foreach ($disciplinas as $valor) { ?>

                                <div class="form-group col-md-4">
                                    <input type="checkbox" name="disciplinas[]" autocomplete="off"  value="<?php echo $valor['cdDisciplina']; ?>"> <?php echo $valor['Dnome']; ?>
                                </div>

                            <?php } ?>
                             </div>

                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" name="btnGravar" class="btn btn-success btn-send" value="Cadastrar">
                        <input type="reset" value="Limpar" class="btn btn-primary btn-send" >
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>


