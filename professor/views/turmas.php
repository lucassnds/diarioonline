<?php
include_once ("controllers/TurmasController.php");
include_once ("controllers/TurmasAction.php");
include_once ("controllers/AulasController.php");
?>
<script>
    document.getElementById('turmas').style.backgroundColor = '#dd4024';
</script>
<div id="page-wrapper">
    <div class="container-fluid"  style="min-height:89vh;">
        <div class="fonte">
            <h1 class="header_paginas">TURMAS</h1>

          
            <div class="row ">
                <form method="POST" autocomplete="off">
                    <div class="form-group col-md-2 pull-right">
                        <input type="submit" class=" laranjaIMEP form-control " value="Buscar" name="btnBuscar" >
                    </div>
                    <div class="form-group col-md-5 pull-right">
                        <input type="text" class="form-control col-md-6 input-lg-novo" title="Digite sua Busca" x-moz-errormessage="Digite sua Busca." required="" name="buscar" id="buscar" placeholder="Nome da Turma">
                    </div>
                </form>



            </div>  
            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Minhas Turmas
                    <button class="btn btn-primary btn-xs">FILTAR</button>
                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>

                                <th>Nome</th>
                                <th class="centralizar col-md-1">Disciplina</th>
                                <th class="centralizar col-md-1">Data Início</th>
                                <th class="centralizar col-md-2">Data Término</th>
                                <th class="centralizar col-md-1">Turno</th>
                                <th class="centralizar col-md-1">Status</th>
                                <th class="centralizar col-md-1" ></th>
                                <th class="centralizar col-md-1" ></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($resTurmas as $turma) {
                                $novaTurma = new TurmasController();
                                $turmas = $novaTurma->BuscarDadosTurma($turma['cdTurma']);
                                $disciplina = $novaTurma->BuscarDisciplina($turma['disciplina_cdDisciplina']);
                                ?>
                                <tr>
                                    <td> <?php echo $turmas["nome"] ?></td>
                                    <td class="centralizar"><?php echo $disciplina["Dnome"]; ?></td>
                                    <td class="centralizar"><?php echo $turmasController->inverterdata($turmas["dataInicio"]); ?></td>
                                    <td class="centralizar"><?php echo $turmasController->inverterdata($turmas["dataTermino"]); ?></td>
                                    <td class="centralizar"><?php echo $turmasController->turno($turmas["turno"]) ?></td>
                                    <?php if ($turmas['status'] == 1) { ?>
                                    <td class="centralizar "><div style="color:green;"   <?php echo $turmas["cdTurma"] ?> >Cursando</div></td>
                                    <?php } else { ?>
                                    <td class="centralizar"><div <div style="color:red;"    <?php echo $turmas["cdTurma"] ?> >Finalizado</div></td>
                                    <?php } ?>
                                    <td class="centralizar"> 
                                        <form method="post" action="?pagina=aulas">
                                            <input type="hidden" name="cdDisciplina" value="<?php echo $turma['disciplina_cdDisciplina']; ?>">
                                            <input type="hidden" name="cdTurma" value="<?php echo $turma['cdTurma']; ?>">
                                            <input type="submit" class="btn btn-primary btn-sm" value="Chamada">

                                        </form>
                                    </td>
                                    <td class="centralizar"> 

                                        <!--                                        <form method="post" action="?pagina=notas">
                                                                                    <input type="hidden" name="cdDisciplina" value="<?php echo $turma['disciplina_cdDisciplina']; ?>">
                                                                                    <input type="hidden" name="cdTurma" value="<?php echo $turma['cdTurma']; ?>">
                                                                                    <input type="submit" class="btn btn-warning btn-sm" value="Notas">-->
                                        <button class="btn btn-danger btn-sm" data-toggle="modal" data-id="<?= $turma['cdTurma'] ?>"
                                                data-target="#meu_modal<?= $turma['cdTurma'] ?>">Notas</button>

                                        <!--                                        </form>-->


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
            <?php foreach ($resTurmas as $turma) { ?>


                <!---Modal Ativar e desativar------------------>

                <div class="modal fade  " id="meu_modal<?php echo $turma['cdTurma']; ?>" >
                    <div class="modal-dialog " >
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>

                                <h4 class="modal-title" id="myLargeModalLabel">Escolha o módulo para inserir as notas</h4>

                            </div>
                            <div class="modal-body">
                                <?php
                                $modulos = new AulasController();

                                $modulo = $modulos->buscarModulos($turma['disciplina_cdDisciplina']);
                                ?>
                                <form method="POST" > 
                                    <select class="form-control"  name="modulo" required="">
                                        <option value="">Selecione</option>
                                        <?php foreach ($modulo as $mod) { ?>
                                            <option value="<?php echo $mod['cdModulo']; ?>"><?php echo $mod['nome']; ?></option>

                                        <?php } ?>
                                    </select>

                                    <div class="modal-footer">

                                        <input type="hidden" name="cdDisciplina" value="<?php echo $turma['disciplina_cdDisciplina']; ?>">
                                        <input type="hidden" name="cdTurma" value="<?php echo $turma['cdTurma']; ?>">
                                        <input type="submit" name="sim" value="Continuar" class="btn btn-success btn-send" >
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Fechar</button>


                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <br><br><br><br>

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
                            <div class="modal-body">
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
