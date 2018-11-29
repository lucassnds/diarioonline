<?php
include_once ("controllers/CursoController.php");
include_once ("controllers/TurmasController.php");
include_once ("controllers/TurmasAction.php");
?><script>
    document.getElementById('turma').style.backgroundColor = '#dd4024';

</script>

<script>
    $(function () {
        $("#datepicker").datepicker({dateFormat: 'dd/mm/yy'});
    });
    $(function () {
        $("#datepicker2").datepicker({dateFormat: 'dd/mm/yy'});
    });


    function carregardados() {

        var xhttp;


        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState === 4) {


                document.getElementById("matricula").value = xhttp.responseText;



            }
        };
        xhttp.open("POST", "models/geradorMatricula.php", true);
        xhttp.send();
    }
    function carregardado() {

        var xhttp;


        xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (xhttp.readyState === 4) {


                document.getElementById("matricul").value = xhttp.responseText;
                document.getElementById("senha").value = xhttp.responseText;



            }
        };
        xhttp.open("POST", "models/geradorMatricula.php", true);
        xhttp.send();
    }
</script>
<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas">TURMAS</h1>

            <?php if (isset($_SESSION['cadastro'])) { ?>
                <?php if ($_SESSION['cadastro'] == 1) { ?>
                    <script> CadastroSucesso();</script>
                    <?php
                    unset($_SESSION['cadastro']);
                } else {
                    ?>
                    <script> CadastroErro();</script>

                    <?php unset($_SESSION['cadastro']); ?>

                    <?php
                }
            }
            ?>

            <?php if (isset($alterarcadastro)) { ?>
                <?php if ($alterarcadastro == 1) { ?>
                    <script> AlteracaoSucesso();</script>
                <?php } else { ?>
                    <script> AlteracaoErro();</script>   
                    <?php
                }
            }
            ?>
            <?php if (isset($cadastro)) { ?>
                <?php if ($cadastro == 1) { ?>
                    <script> AlunoSucesso();</script>
                <?php } else { ?>
                    <script> AlunoErro();</script>   
                    <?php
                }
            }
            ?>


            <?php if (isset($_SESSION['resposta'])) { ?>
                <?php if ($_SESSION['resposta'] == 1) { ?>
                    <script> NomeErro();</script>
                    <?php
                    unset($_SESSION['resposta']);
                }
            }
            ?>
            <div class="row ">
                <form method="POST" autocomplete="off">
                    <div class="form-group col-md-2 pull-right">
                        <input type="submit" class=" laranjaIMEP form-control " value="Buscar" name="btnBuscar" >
                    </div>
                    <div class="form-group col-md-5 pull-right">
                        <input type="text" class="form-control col-md-6 input-lg-novo" title="Digite sua Busca" x-moz-errormessage="Digite sua Busca." required="" name="buscar" id="buscar" placeholder="Nome da Turma">
                    </div>
                </form>

                <div class="form-group col-md-2 pull-left">
                    <button class="btn laranjaIMEP "
                            data-toggle="modal" data-target="#meu_modal" value=""><i class="glyphicon glyphicon-plus"></i> Nova Turma</button>
                </div>

            </div>  
            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Turmas Cadastradas

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>

                                <th>Nome</th>
                                <th class="centralizar col-md-1">Vagas</th>
                                <th class="centralizar col-md-1">Data Início</th>
                                <th class="centralizar col-md-2">Data Término</th>
                                <th class="centralizar col-md-1">Turno</th>
                                <th class="centralizar col-md-1">Status</th>
                                <th class="centralizar col-md-3" >Ação</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resTurmas as $turmas) { ?>
                                <tr>
                                    <td> <?php echo $turmas["nome"] ?></td>
                                    <td class="centralizar"> <?php echo $turmas["vagas"] ?></td>
                                    <td class="centralizar"><?php echo $turmasController->inverterdata($turmas["dataInicio"]); ?></td>
                                    <td class="centralizar"><?php echo $turmasController->inverterdata($turmas["dataTermino"]); ?></td>
                                    <td class="centralizar"><?php echo $turmasController->turno($turmas["turno"]) ?></td>
                                    <?php if ($turmas['status'] == 1) { ?>
                                        <td class="centralizar"><input class="btn btn-success btn-sm" type="button" value="Cursando"  data-toggle="modal" data-target="#meu_modal<?php echo $turmas["cdTurma"] ?>"  ></td>
                                    <?php } else { ?>
                                        <td class="centralizar"><input class="btn btn-danger btn-sm" type="button" value="Finalizado"  data-toggle="modal" data-target="#meu_modal<?php echo $turmas["cdTurma"] ?>"  ></td>
                                    <?php } ?>

                                    <td class="centralizar"><button class="btn btn-warning btn-sm" data-toggle="modal" data-id="<?= $turmas['cdTurma'] ?>"
                                                                    data-target="#modal_editar<?= $turmas['cdTurma'] ?>"
                                                                    >Editar</button> <input class="btn btn-primary btn-sm" type="button" data-toggle="modal" data-target="#modal_infor<?php echo $turmas["cdTurma"] ?>" value="Informações"  >
                                        <button class="btn btn-info btn-sm" data-toggle="modal" data-id="<?= $turmas['cdTurma'] ?>"
                                                data-target="#modal_novoaluno<?= $turmas['cdTurma'] ?>"
                                                >Novo Aluno</button>
                                    </td>

                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                    </ul>
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
                            <?php } ?>
                        </ul>
                        <div>Página <?php echo $numdaPagina; ?> de <?php echo $numPaginas; ?></div><br>
                    </div>
                </form>
            <?php } else { ?>
                <div class= "text-center"><?php echo $totalTurmas; ?> Turmas(s) Encontrada(s)</div><br>
            <?php } ?>


            <?php foreach ($resTurmas as $turmas) { ?>
                <!---Modal Cursando-------------------------->

                <div class="modal fade  " id="meu_modal<?php echo $turmas['cdTurma']; ?>">
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <?php if ($turmas['status'] == 1) { ?>   <h4 class="modal-title" id="myLargeModalLabel">Deseja finalizar este curso ?</h4>
                                <?php } else { ?>
                                    <h4 class="modal-title" id="myLargeModalLabel">Deseja reativar este curso ?</h4>
                                <?php } ?>
                            </div>
                            <form method="POST">
                                <div class="modal-footer">
                                    <input type="hidden" value="<?php echo $turmas['status']; ?>" name="status">
                                    <input type="hidden" value="<?php echo $turmas['cdTurma']; ?>" name="cdturma">
                                    <input type="submit" name="Sim" value="Sim" class="btn btn-success btn-send" >
                                    <button  value="Fechar" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Não</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <!--MODAL DE EDITAR TURMA------------------>

                <div class="modal fade novo_aluno" id="modal_editar<?php echo $turmas['cdTurma']; ?>">
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>Editar Turma</strong></h4>
                            </div>

                            <form id="cadastro-form" method="POST" role="form">
                                <div class="modal-body">
                                    <div class="form-group row wow fadeInDown">

                                        <div class="col-md-6">
                                            <label  for="Turno">Turno:</label>
                                            <select class="form-control" name="turno">
                                                <option value="1" <?php
                                                if ($turmas['turno'] == 1) {
                                                    echo "selected";
                                                }
                                                ?>>Manhã</option>
                                                <option value="2" <?php
                                                if ($turmas['turno'] == 2) {
                                                    echo "selected";
                                                }
                                                ?>>Tarde</option>
                                                <option value="3" <?php
                                                if ($turmas['turno'] == 3) {
                                                    echo "selected";
                                                }
                                                ?>>Noite</option>

                                            </select>
                                        </div>

                                    </div>
                                    <div class="form-group row fadeInDown">
                                        <div class="col-md-6">
                                            <label for="comment">Data Inicio:</label>
                                            <input class="form-control" type="hidden" name="cdturma" value="<?php echo $turmas['cdTurma']; ?>">
                                            <input class="form-control" type="date" name="dataI" id="data" placeholder="Ex: 01/04/2010">

                                        </div>
                                        <div class="col-md-6">
                                            <label for="comment">Data Término:(Opcional)</label>
                                            <input class="form-control" type="date"  name="dataT" id="data" placeholder="Ex: 01/04/2010">
                                        </div>

                                    </div>



                                </div>
                                <div class="modal-footer">

                                    <input type="submit" name="btnUpdate" value="Guarda Alterações" class="btn btn-success btn-send" >
                                    <button  value="Fechar" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Fechar</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <!---MOdal CuInformações------------------------------------------>

                <div class="modal fade  " id="modal_infor<?php echo $turmas['cdTurma']; ?>" >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>Informãções da turma</strong></h4>

                            </div>
                            <div class="modal-body">
                                <div class=" row form-group">
                                    <div class="col-md-6">
                                        <label>Nome da Turma:  <?php echo $turmas['nome']; ?></label>
                                        <label >Vagas disponiveis:  <?php echo $turmas['vagas']; ?></label>
                                        <label >Data Inicio:  <?php echo $turmas['dataInicio']; ?></label>
                                        <label >Data Termino:  <?php echo $turmas['dataTermino']; ?></label>

                                    </div>
                                    <div class="col-md-6">
                                        <?php ?>
                                        <label class="label-control">Turno:  <?php echo $turmasController->turno($turmas['turno']); ?></label>


                                    </div>

                                </div>
                            </div>

                            <div class="modal-footer">
                                <input type="hidden" value="<?php echo $turmas['status']; ?>" name="status">
                                <input type="hidden" value="<?php echo $turmas['cdTurma']; ?>" name="cdturma">

                                <button  value="Fechar" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Fechar</button>
                            </div>

                        </div>
                    </div>
                </div>

                <!---MOdal NovoAluno------------------------------------------>

                <div class="modal fade  " id="modal_novoaluno<?php echo $turmas['cdTurma']; ?>" >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>Cadastro novo aluno</strong></h4>

                            </div>
                            <form method="POST">
                                <div class="modal-body">
                                    <div class=" row form-group">
                                        <div class="col-md-6">
                                            <label>Nome do Aluno</label>
                                            <input type="text" class="form-control" required="" name="nome">
                                        </div>


                                        <div class="col-md-6">
                                            <label for="nome">Matricula/Login</label>
                                            <input class="form-control" type="text"  required="" name="matricula" id="matricul"  />

                                        </div>
                                        <div class="col-md-6">
                                            <label>Senha</label>
                                            <input type="text" class="form-control"  name="senha" id="senha">
                                        </div>
                                        <div class="col-md-6 ">
                                            <label style="color:rgba(0,0,0,0);"> gerar matricula
                                            </label><br>
                                            <button class="btn btn-gerar"  onclick="carregardado()">GERAR MATRÍCULA</button><br>
                                        </div>
                                    </div>
                                </div>

                                <div class="modal-footer">

                                    <input type="hidden" value="<?php echo $turmas['cdTurma']; ?>" name="turma">
                                    <input type="submit"  class="btn btn-success" name="novoAluno" value="Cadastrar Aluno">   
                                    <button  value="Fechar" class="btn btn-danger" data-dismiss="modal" aria-label="Close">Fechar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>



            <?php } ?>

            <!--MODAL DE CADASTRO TURMA-->

            <div class="modal fade novo_aluno" id="meu_modal">
                <div class="modal-dialog " >
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                            <h4 class="modal-title" id="myLargeModalLabel"><strong>Cadastrar Turma</strong></h4>
                        </div>

                        <form id="cadastro-form" method="POST" role="form" autocomplete="off">
                            <div class="modal-body" style="overflow-y: scroll; max-height:70vh;">
                                <div class="form-group row wow fadeInDown">
                                    <div class="col-md-12">
                                        <label for="nome">Nome:</label>
                                        <input class="form-control" type="text" title="Digite o Nome" x-moz-errormessage="Digite o Nome." required="" name="nome" id="nome" /><br />
                                    </div>
                                    <div class="col-md-6">
                                        <label  for="Turno">Turno:</label>
                                        <select class="form-control" name="turno">
                                            <option value="1">Manhã</option>
                                            <option value="2">Tarde</option>
                                            <option value="3">Noite</option>

                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="nome">Vagas:</label>
                                        <input class="form-control" type="number" title="Digite o numros de vagas" x-moz-errormessage="Digite o numros de vagas." required="" name="vagas" id="vagas" /><br />
                                    </div>
                                </div>
                                <div class="form-group row fadeInDown">
                                    <div class="col-md-6">
                                        <label for="comment">Data Inicio:</label>
                                        <input class="form-control" type="date" name="dataI" id="datepicker">

                                    </div>
                                    <div class="col-md-6">
                                        <label for="comment">Data Término:(Opcional)</label>
                                        <input class="form-control" type="date"  name="T" id="datepicker2">
                                    </div>

                                </div>
                                <div class="form-group row fadeInDown">
                                    <div class="col-md-6">
                                        <label for="nome">Paramêtro Matricula:</label>
                                        <input class="form-control" type="text"  title="Clique em Gearar MatrÃ­cula." x-moz-errormessage="Clique em Gearar MatrÃ­cula." required="" name="matricula" id="matricula" value="" />

                                    </div>

                                    <div class="col-md-6 ">

                                        <label style="color:rgba(0,0,0,0);"> gerar matricula
                                        </label><br>
                                        <button class="btn btn-gerar"  onclick="carregardados()">GERAR MATRÍCULA</button><br>
                                    </div>

                                </div>
                                <?php
                                $cursoController = new CursoController();
                                $curso = $cursoController->buscarCursos();
                                ?>
                                <div class="form-group row fadeInDown">
                                    <div class="col-md-12">

                                        <label  for="Curso">Curso:</label>

                                        <select class="form-control" name="curso">
                                            <?php foreach ($curso as $valor) { ?>
                                                <option value="<?php echo $valor['cdCurso']; ?>"><?php echo $valor['nome']; ?></option>
                                            <?php } ?>

                                        </select>
                                    </div>
                                </div>

                            </div>
                            <div class="modal-footer">

                                <input type="submit" name="Gravar" value="Próximo" class="btn btn-success btn-send" >
                                <input type="reset" value="Limpar" class="btn btn-primary btn-send" >
                            </div>
                        </form>
                    </div>
                </div>
            </div>



        </div>
    </div>
</div>
