
<?php
if (!isset($_SESSION['matricula'])) {
    echo '<script type="text/javascript"> window.location.href = "index.php?pagina=turmas";</script>';
} else {
    include_once ("controllers/CursoController.php");
    include_once ("controllers/ProfessorController.php");
    include_once ("controllers/TurmasController.php");
    include_once ("controllers/TurmaAction.php");
    ?>

    <script>
        function carregardados() {

            var xhttp;


            xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (xhttp.readyState === 4) {


                    document.getElementById("matricula").value = xhttp.responseText;
                    document.getElementById("senha").value = xhttp.responseText;


                }
            };
            xhttp.open("POST", "admin/models/geradorMatricula.php", true);
            xhttp.send();


        }

        function buscar_cidades(num) {
            test = '#estado' + num;
            load = '#load_cidades' + num;
            var estado = $(test).val();


            if (estado) {
                var url = 'models/buscar_prof.php?estado=' + estado;
                $.get(url, function (dataReturn) {
                    $(load).html(dataReturn);
                });
            }
        }


    </script>

    <div id="page-wrapper">
        <div class="container-fluid" style="min-height:89vh;">
            <div class="fonte">
                <h1 class="header_paginas ">CADASTRO DOS ALUNOS NA TURMA <?php echo $_SESSION['matricula']; ?></h1> 

                <div class="row">


                    <div class="col-md-3">
                        <label>Nome:</label>
                        <label><?php echo $_SESSION['nome']; ?></label>

                    </div>
                    <div class="col-md-3">
                        <label>Vagas:</label>
                        <label><?php echo $_SESSION['vagas']; ?></label>

                    </div>
                    <div class="col-md-3">
                        <label>data Ínicio:</label>
                        <label><?php echo $_SESSION['dataI']; ?></label>

                    </div>
                    <div class="col-md-3">
                        <label>data Término:</label>
                        <label><?php
                            if (isset($_SESSION['dataT'])) {
                                echo $_SESSION['dataT'];
                            }
                            ?></label>

                    </div>
                    <div class="col-md-3">
                        <label>Curso:</label>
                        <label><?php
                            $cursoController = new CursoController();
                            $result = $cursoController->buscarCursoID($_SESSION['cdCurso']);
                            $curso = mysqli_fetch_assoc($result);
                            echo $curso['nome'];
                            ?></label>

                    </div>
                    <div class="col-md-3">
                        <label>Turno:</label>
                        <label><?php
                            if (isset($_SESSION['turno'])) {
                                if ($_SESSION['turno'] == 1) {
                                    echo "Manhã";
                                }
                                if ($_SESSION['turno'] == 2) {
                                    echo "Tarde";
                                }
                                if ($_SESSION['turno'] == 3) {
                                    echo "Noite";
                                }
                            }
                            ?></label>




                    </div>
                </div>
                <br>
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="col-md-4">
                        <?php if ($_SESSION['vagas'] <= 0) { ?>

                            <button class="btn btn-default btn-primary laranjaIMEP col-md-12 " 
                                    disabled=""  ><i data-toggle="modal" disabled="" data-target="#meu_modal" value=""class="glyphicon glyphicon-plus"></i>Novo Aluno</button>

                        <?php } else { ?>

                            <button class="btn btn-default btn-primary laranjaIMEP col-md-12 " 
                                    data-toggle="modal" data-target="#meu_modal" value="" > <i class="glyphicon glyphicon-plus"></i> Novo Aluno</button>

                        <?php } ?>
                        </div>
                        <div class="col-md-4">
                        <form method="POST">
                            <input class="btn btn-default btn-danger  vermelhoIMEP col-md-12  " type="submit" name="Cancelar"
                                   value="cancelar" >
                        </form>
                         </div>

                        <div class="col-md-4">
                        <a class="btn btn-default btn-success verdeIMEP  col-md-12 " 
                           data-toggle="modal" data-target="#modal_professor" name="cadastar"
                           value="Próximo" >Próxima etapa</a>
                        </div>
                    </div>
                </div>


                <div class="panel panel-primary panel-tabela">
                    <div class="panel-heading panel-titulo laranjaIMEP ">Lista de Alunos 

                    </div>

                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-condensed ">
                            <thead>
                                <tr>

                                    <th >Nome</th>
                                    <th class="centralizar">Matrícula</th>
                                    <th class="centralizar">Senha</th>
                                    <th class="centralizar col-md-1">Ação</th>
                                    <?php
                                    $total = 0;
                                    $indice = 0;
                                    ?>
                                </tr>
                            </thead>
                            <tbody>

                                <?php $itensVendas = $_SESSION['carrinho'] ?>
                                <?php foreach ($itensVendas as $produto) {
                                    ?>
                                    <tr>

                                        <td><?php echo $produto["nome"]; ?></td>
                                        <td class="centralizar"><?php echo $produto["matricula"]; ?></td>
                                        <td class="centralizar"><?php echo $produto["senha"]; ?></td>

                                        <td class="centralizar"><form class="" method="POST" >

                                                <input type="hidden"  name="indice"  value="<?php echo $indice; ?>"/>
                                                <button type="submit" class="btn btn-danger btn-sm" name="remover" value="remover">Apagar</button>
                                            </form></td>

                                    </tr>
                                    <?php $indice += 1; ?>
                                <?php } ?>
                            </tbody>
                        </table>
                        </ul>
                    </div>

                </div>
                <!--MODAL professro turma-->    


                <div class="modal fade novo_aluno" id="modal_pofessor"  >
                    <div class="modal-dialog "style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;" >
                        <div class="modal-content"> 
                            <div class="modal-header"> 
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>Selecione os Professores</strong></h4> 
                            </div>

                            <form id="cadastro-form" method="POST" role="form">
                                <div class="modal-body">
                                    <div class="form-group row wow fadeInDown">
                                        <div class="col-md-12 checkbox">
                                            <?php
                                            $professorController = new ProfessorController();
                                            $professor = $professorController->buscarProfessores();
                                            $titula = $professorController->buscarTitulacao();
                                            $disciplinaController = new CursoModel();
                                            $disciplina = $disciplinaController->buscarDisciplinaCurso($_SESSION["cdCurso"]);
                                            $in = 0;
                                            ?> <?php foreach ($titula as $prof) { ?>

                                                <h4 class="modal-title" id="myLargeModalLabel" style="border-bottom: 1px solid #fff;"> Titulação:  <?php echo $prof["Tnome"]; ?></h4><br>

                                                <?php $professor = $professorController->buscarProfessorNivel($prof['cdTitulacao']); ?>

                                                <?php foreach ($professor as $valor) { ?>
                                                    <div class="btn-group"  style="margin-bottom: 3px; ">
                                                        <label class="btn"   style="background-color:  #fff !important; color: #000 !important; width: 180px; height:50px!important; text-align:center;">
                                                            <div style="height:1px ; font-weight:bold ; "><?php echo $valor['nome']; ?></div><br>
                                                            <input type="radio" name=" profe<?php echo $in; ?>" autocomplete="off" style="margin-left: -4px!important;"  value="<?php echo $valor['cdProfessor']; ?>">
                                                        </label>			

                                                    </div>
                                                <?php } ?>
                                                <div >

                                                    <select class="form-control" name="disci<?php echo $in; ?>">
                                                        <?php foreach ($disciplina as $dis) { ?>
                                                            <option value="<?php echo $dis["cdDisciplina"]; ?>"><?php echo $dis["Dnome"]; ?></option>
                                                        <?php } ?>
                                                    </select>

                                                </div>

                                                <br><br>
                                                <?php
                                                $in++;
                                            }
                                            ?>
                                            <input type="hidden" name="indice" value="<?php echo $in; ?>">

                                        </div>
                                    </div>	
                                </div>
                                <div class="modal-footer">
                                    <input type="submit" name="FinalizareCadastrar" class="btn btn-success btn-send" value="Finalizar e Cadastrar">
                                    <input type="reset" value="Limpar" class="btn btn-primary btn-send" >
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>


                <!-- Modal professro -->

                <div class="modal fade novo_aluno" id="modal_professor"   >
                    <div class="modal-dialog" style="overflow-y: scroll; max-height:85%;  margin-top: 50px; margin-bottom:50px;" >
                        <div class="modal-content"> 
                            <div class="modal-header"> 
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span  aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>Selecione os Professores</strong></h4> 
                            </div>

                            <form id="cadastro-form" method="POST" role="form">
                                <div class="modal-body">
                                    <div class="form-group row wow fadeInDown">
                                        <div class="col-md-12">
                                            <div class="modal-header"> 
                                                <div class="row">
                                                    <h5 class="col-md-4">Disciplinas</h5> 
                                                    <h5 class="col-md-4">Titulação</h5> 
                                                    <h5 class="col-md-4">Professor</h5> 
                                                </div>
                                            </div> <br>
                                            <?php
                                            $cursoController = new CursoController();

                                            $result = $cursoController->buscarDisciplinaCurso($_SESSION['cdCurso']);
                                            $titula = $professorController->buscarTitulacao();
                                            $i = 1;
                                            foreach ($result as $key) {
                                                ?>

                                                <div class="col-md-4">
                                                  <input type="hidden" name="disci<?php echo $i; ?>" value="<?php echo $key['cdDisciplina']; ?>"><?php echo $key['Dnome']; ?><br>
                                                </div>

                                                <div class="col-md-4">

                                                    <select class="form-control " name="estado<?php echo $i; ?>" id="estado<?php echo $i; ?>"   onchange="buscar_cidades(<?php echo $i; ?>)">
                                                        <option value="">Selecione...</option>
                                                        <?php foreach ($titula as $value) { ?>
                                                            <option value='<?php echo $value['cdTitulacao'] ?>'> <?php echo $value['Tnome']; ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>

                                                <div class="form-group col-md-4">
                                                    <div id="load_cidades<?php echo $i; ?>">

                                                        <select  class="form-control" name="cidade" id="cidade">
                                                            <option value="">Selecione o Professor</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="indice" value="<?php echo $i; ?>">

                                                <?php
                                                $i++;
                                            }
                                            ?>

                                        </div>


                                    </div>

                                </div>


                                <div class="modal-footer">
                                    <input type="submit" name="FinalizareCadastrar" class="btn btn-success btn-send" value="Finalizar e Cadastrar">
                                    <input type="reset" value="Limpar" class="btn btn-primary btn-send" >
                                </div>
                            </form> 
                        </div>
                    </div>
                </div>


                <!---MODAL Cadatro aluno-->    


                <div class="modal fade novo_aluno" id="meu_modal"  >
                    <div class="modal-dialog " >
                        <div class="modal-content"> 
                            <div class="modal-header"> 
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                <h4 class="modal-title" id="myLargeModalLabel"><strong>Cadastrar Alunos</strong></h4> 
                            </div>

                            <form id="cadastro-form" method="POST" role="form" autocomplete="off">
                                <div class="modal-body">
                                    <div class="form-group row wow fadeInDown">
                                        <div class="col-md-12">
                                            <label for="nome">Nome:</label>
                                            <input class="form-control" autofocus autocomplete="off" type="text" title="Digite o Nome" x-moz-errormessage="Digite o Nome." required="" name="nome" id="nome" /><br />
                                        </div>
                                        <div class="col-md-6">
                                            <label for="nome">Matricula:</label>
                                            <input class="form-control" type="text"  required="" name="matricula" id="matricula" value="<?php echo $_SESSION["matricula"] ?>" />     

                                        </div>

                                        <div class="col-md-6">
                                            <label for="nome">Senha:</label>
                                            <input class="form-control" type="password" name="senha" id="senha" value="<?php echo $_SESSION["matricula"] ?>"  /><br />
                                        </div>
                                    </div>

                                    <div class="form-group row wow fadeInDown">



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

            <?php } ?>

        </div>
    </div>