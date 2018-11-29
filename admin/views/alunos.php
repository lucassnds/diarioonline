<?php
include_once ("controllers/AlunoController.php");
include_once ("controllers/alunoAction.php");
?>
<script>
    document.getElementById('aluno').style.backgroundColor = '#dd4024';
    
</script>

<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas ">ALUNOS</h1>

            <?php if (isset($alterarcadastro)) { ?>
                <?php if ($alterarcadastro == 1) { ?>
                    <script> AlteracaoSucesso();</script>
                <?php } else { ?>
                    <script> AlteracaoErro()();</script>
                    <?php
                }
            }
            ?>

            <div class="row ">

                <form method="POST" autocomplete="off">



                    <div class="form-group col-md-2 pull-right">
                        <input type="submit" class=" laranjaIMEP form-control" value="Buscar" name="btnBuscar">
                    </div>
                    <div class="form-group col-md-5 pull-right">
                        <input type="text" class="form-control col-md-6 input-lg-novo" title="Digite sua Busca" x-moz-errormessage="Digite sua Busca." required="" name="buscar" id="buscar" placeholder="Nome ou Matrícula">
                    </div>


                </form>


            </div>



            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Alunos Cadastrados 

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>

                                <th data-field="nome"  >Nome</th>
                                <th class="centralizar" >Matrícula</th>
                                <th class="centralizar">Turma</th>
                                <th class="centralizar col-md-1" >Situação</th>
                                <th class="centralizar col-md-2"  >Ações</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resAlunos as $prof) { ?>
                                <?php
                                $turma = $usuarioController->turmaAluno($prof['cdAluno']);
                                $nomeTurma = mysqli_fetch_assoc($turma);
                                ?>

                                <tr>


                                    <td> <?php echo $prof['nome']; ?></td>
                                    <td class="centralizar"> <?php echo $prof['login']; ?></td>
                                    <td class="centralizar"><?php echo $nomeTurma['nome']; ?></td>


                                    <?php if ($prof['status'] == 1) { ?>
                                        <td class="centralizar"><input class="btn btn-success btn-sm" type="button" value="Liberado"  data-toggle="modal" data-target="#meu_modal<?php echo $prof["cdUsuario"]; ?>"  ></td>
                                    <?php } else { ?>
                                        <td class="centralizar"><input class="btn btn-danger btn-sm" type="button" value="Bloqueado "  data-toggle="modal" data-target="#meu_modal<?php echo $prof["cdUsuario"]; ?>"  ></td>
                                    <?php } ?>

                                    <td class="centralizar"><button class="btn btn-warning btn-sm" data-toggle="modal" data-id="<?= $prof['cdUsuario'] ?>"
                                                                    data-target="#modal_informacoes<?= $prof['cdUsuario'] ?>"
                                                                    >Editar</button>


                                        <button class="btn btn-primary btn-sm" data-toggle="modal" data-id="<?= $prof['cdUsuario'] ?>"
                                                data-target="#myModal<?= $prof['cdUsuario'] ?>"
                                                >Histórico</button>

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>

                    <?php foreach ($resAlunos as $prof) { ?>
                        <!---MODAL DE EDITAR-->
                        <div class="modal fade " id="modal_informacoes<?= $prof['cdUsuario'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"  >
                            <div class="modal-dialog " >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" id="myLargeModalLabel"><strong>Editar</strong> </h4>
                                    </div>
                                    <?php
                                    $usuarioController = new AlunoController();
                                    $cdTurma = 1;
                                    ?>
                                    <form id="cadastro-form" method="POST" role="form" autocomplete="off">
                                        <div class="modal-body">
                                            <div class="form-group row fadeInDown">
                                                <div class="col-md-12">
                                                    <label for="nome">Nome:</label>
                                                    <input type="hidden" name="cdAluno" value="<?php echo $prof['cdAluno']; ?>">
                                                    <input type="hidden" name="cdUsuario" value="<?php echo $prof['cdUsuario']; ?>">
                                                    <input class="form-control" type="text"  name="nome" id="nomeINFO" value="<?php echo $prof['nome']; ?>"/><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nome">Matricula:</label>
                                                    <input class="form-control" type="text" disabled=""  name="loginINFO" id="loginINFO" value="<?php echo $prof['login']; ?>" />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nome">Senha:</label>
                                                    <input class="form-control" type="text" name="senha" id="senhaINFO" value="<?php echo $prof['senha']; ?>" required="" /><br />
                                                </div>

                                            </div>


                                            <div class="modal-footer">
                                                <input type="submit" name="btnUpdate" class="btn btn-success btn-send" value="Guardar Alterações">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                                            </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!---FIM DO MODAL EDIDAR-->

                    <!-- MODAL HISTORICO-->

                    <!-- Modal -->
                    <div id="myModal<?= $prof['cdUsuario'] ?>" class="modal  fade ">
                        <div class="modal-dialog " >
                            <?php
                            $turma2 = $usuarioController->turmaAluno($prof['cdAluno']);
                            $cdturma = mysqli_fetch_assoc($turma2);
                            $modululosAluno = $usuarioController->buscarModulosAluno($cdturma['cdturma']);
                            $professorDis = $usuarioController->buscaProfessorDisciplina($cdturma['cdturma']);
                            //$pro = mysqli_fetch_array($professorDis);

                            $num = $usuarioController->numdisciplinas($cdturma['cdturma']);
                            ?>
                            <!-- Modal content-->
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal">x</button>
                                    <h4 class="modal-title"><strong>Histórico</strong></h4>
                                </div>
                                <div class="modal-body table-responsive" style="overflow-y: scroll; max-height:70vh;">

                                    <?php foreach ($professorDis as $valor) { ?>
                                        <div><strong>Professor: </strong><?php echo $valor['nome'] ?><br> <strong> Disciplina:</strong><?php echo $valor['Dnome'] ?> </div>
                                        <?php $modulos = $usuarioController->buscarModulo($valor['cdDisciplina']); ?>
                                        <table border="1" class="table">
                                            <thead>
                                                <tr>
                                                    <th>Módulos</th>
                                                    <th>Nota 1</th>
                                                    <th>Nota 2</th>
                                                    <th>Média</th>
                                                    <th>Faltas</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($modulos as $modulo) { ?>
                                                    <tr>

                                                        <td><?php echo $modulo['nome']; ?></td>

                                                        <?php
                                                        for ($i = 1; $i <= 2; $i++) {

                                                            $nota = $usuarioController->buscarNotas($prof['cdAluno'], $modulo['cdModulo'], $i);
                                                            $val = mysqli_fetch_assoc($nota);
                                                            ?>
                                                            <td><?php echo $val['nota']; ?></td>
                                                            <?php
                                                        }

                                                        $media = $usuarioController->buscarMediaFaltas($prof['cdAluno'], $modulo['cdModulo']);

                                                        $medias = mysqli_fetch_array($media);
                                                        ?>
                                                        <td><?php echo $medias['media']; ?></td>
                                                        <td><?php echo $medias['falta']; ?></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    <?php } ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!---Modal Ativar e desativar------------------>

                    <div class="modal fade  " id="meu_modal<?php echo $prof['cdUsuario']; ?>" >
                        <div class="modal-dialog " >
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <?php if ($prof['status'] == 1) { ?>   <h4 class="modal-title" id="myLargeModalLabel">Deseja Desativar este aluno ?</h4>
                                    <?php } else { ?>
                                        <h4 class="modal-title" id="myLargeModalLabel">Deseja ativar este aluno ?</h4>
                                    <?php } ?>
                                </div>
                                <form method="POST">
                                    <div class="modal-footer">
                                        <input type="hidden" value="<?php echo $prof['status']; ?>" name="status">
                                        <input type="hidden" value="<?php echo $prof['cdUsuario']; ?>" name="cdusuario">
                                        <input type="submit" name="Sim" value="Sim" class="btn btn-success btn-send" >
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>

</div>

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
                            <?php } ?>  <div>Página <?php echo $numdaPagina; ?> de <?php echo $numPaginas; ?></div>
                        </ul>

                    </div>
                </form>
            <?php } else { ?>
                <div class= "text-center"><?php echo $totalAluno; ?> Aluno(s) Encontrado(s)</div><br>
            <?php } ?>

        

    </div>


    <!----------------------------------------------MODAL DE CADASTRO ALUNO------------------------------------------------------------>

    <div class="modal fade novo_aluno" id="meu_modal"    >
        <div class="modal-dialog " >
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                    <h4 class="modal-title" id="myLargeModalLabel"><strong>Cadastro de Alunos</strong></h4>
                </div>

                <form id="cadastro-form" method="POST" role="form">
                    <div class="modal-body">
                        <div class="form-group row wow fadeInDown">
                            <div class="col-md-12">
                                <label for="nome">Nome:</label>
                                <input class="form-control" type="text" title="Digite o Nome" x-moz-errormessage="Digite o Nome." required="" name="nome" id="nome" /><br />
                            </div>
                            <div class="col-md-6">
                                <label for="nome">Matricula:</label>
                                <input class="form-control" type="text"  title="Clique em Gearar Matrícula." x-moz-errormessage="Clique em Gearar Matrícula." required="" name="matricula" id="matricula" value="" />

                            </div>

                            <div class="col-md-6 ">

                                <label style="color:rgba(0,0,0,0);"> gerar matricula
                                </label><br>
                                <button class="btn btn-gerar" data-toggle="collapse" data-target="#demo" onclick="carregardados()">GERAR MATRÍCULA</button><br>
                            </div>
                        </div>

                        <div class="form-group row wow fadeInDown">
                            <div class="col-md-6">
                                <label for="nome">Senha:</label>
                                <input class="form-control" type="password" name="senha" id="senha" value="" disabled="" /><br />
                            </div>
                            <div class="col-md-6">
                                <label for="Turma">Turma:</label>
                                <select class="form-control">
                                    <option>kefco</option>
                                </select>
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
</div>