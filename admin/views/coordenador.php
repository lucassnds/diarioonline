<?php
include_once ("controllers/CoordenadorController.php");
include_once ("controllers/CoordenadorAction.php");
?>
<script>
    document.getElementById('coor').style.backgroundColor = '#dd4024';
    
</script>

<div id="page-wrapper">
    <div class="container-fluid" style="min-height:89vh;">
        <div class="fonte"> 

            <h1 class="header_paginas ">COORDENADORES</h1> 
            <?php if (isset($cadastro)) { ?>
                <?php if ($cadastro == 1) { ?>
                    <script> CadastroSucesso();</script>
                <?php } else { ?>
                    <script> LoginErro()();</script>
                    <?php
                } ?>
               
            <?php } ?>

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
                        <input type="submit" class=" laranjaIMEP form-control " value="Buscar" name="btnBuscar" >
                    </div>
                    <div class="form-group col-md-5 pull-right">
                        <input type="text" class="form-control col-md-6 input-lg-novo" title="Digite sua Busca" x-moz-errormessage="Digite sua Busca." required="" name="buscar" id="buscar" placeholder="Nome do coordenador">
                    </div>
                </form>
                <div class="form-group col-md-2 pull-left">
                    <button class="btn laranjaIMEP " id="t" data-toggle="modal" data-target="#meu_modal" value=""> <i class="glyphicon glyphicon-plus"></i> Novo Coordenador</button>

                </div>
              

            </div>

            <div class="panel panel-primary panel-tabela">
                <div class="panel-heading panel-titulo laranjaIMEP ">Coordenadores Cadastrados

                </div>

                <div class="table-responsive">
                    <table class="table table-bordered table-condensed table-hover">
                        <thead>
                            <tr>

                                <th data-field="nome"  data-sortable="true" >Nome</th>
                                <th class="centralizar">Login</th>
                       
                                <th class="centralizar col-md-1">Situação</th>
                                <th class="centralizar col-md-2">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($resProfessor as $prof) { ?>
                                <tr>
                                    <td> <?php echo $prof['nome']; ?></td>
                                    <td class="centralizar"> <?php echo $prof['login']; ?></td>
                                  


                                    <?php if ($prof['status'] == 1) { ?>
                                        <td class="centralizar"><input class="btn btn-success btn-sm" type="button" value="Liberado"  data-toggle="modal" data-target="#meu_modal<?php echo $prof["cdUsuario"]; ?>"  ></td>
                                    <?php } else { ?>
                                        <td><input class="btn btn-danger btn-sm" type="button" value="Bloqueado "  data-toggle="modal" data-target="#meu_modal<?php echo $prof["cdUsuario"]; ?>"  ></td>
                                    <?php } ?>

                                    <td class="centralizar"><button class="btn btn-warning btn-sm" data-toggle="modal" data-id="<?= $prof['cdUsuario'] ?>" 
                                                                    data-target="#modal_informacoes<?= $prof['cdUsuario'] ?>">Editar</button>

                                        

                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>  
                    <?php foreach ($resProfessor as $prof) { ?>
                        <!---Modal Ativar e desativar-->

                        <div class="modal fade  " id="meu_modal<?php echo $prof['cdUsuario']; ?>"  >
                            <div class="modal-dialog " >
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <?php if ($prof['status'] == 1) { ?>   <h4 class="modal-title" id="myLargeModalLabel">Deseja Desativar este professor ?</h4>
                                        <?php } else { ?>
                                            <h4 class="modal-title" id="myLargeModalLabel">Deseja ativar este professor ?</h4>
                                        <?php } ?>
                                    </div>
                                    <form method="POST">
                                        <div class="modal-footer">
                                            <input type="hidden" value="<?php echo $prof['status']; ?>" name="status">
                                            <input type="hidden" value="<?php echo $prof['cdUsuario']; ?>" name="cdusuario">
                                            <input type="submit" name="Sim" value="Sim" class="btn btn-success btn-send" >
                                            <input type="reset" value="Não" class="btn btn-danger btn-send" >
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <!--MODAL DE EDITAR-->
                        <div class="modal fade " id="modal_informacoes<?= $prof['cdUsuario'] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"   >
                            <div class="modal-dialog " >
                                <div class="modal-content"> 
                                    <div class="modal-header"> 
                                        <button type="button" class="close"  data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                        <h4 class="modal-title" id="myLargeModalLabel"><strong>Editar</strong> </h4> 
                                    </div>

                                    <form id="cadastro-form" method="POST" role="form">
                                        <div class="modal-body">
                                            <div class="form-group row wow fadeInDown">
                                                <div class="col-md-12">
                                                    <input class="form-control" type="hidden" hidden=""  name="cdUsuarioINFO" id="cdusuarioINFO" value="<?php echo $prof['cdUsuario']; ?>"/>
                                                    <input class="form-control" type="hidden" hidden=""  name="cdProfessorINFO" id="cdprofessorINFO" value="<?php echo $prof['cdProfessor']; ?>"/>
                                                    <label for="nome">Nome:</label>
                                                    <input class="form-control" type="text"  name="nomeINFO" id="nomeINFO" value="<?php echo $prof['nome']; ?>"/><br />
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nome">Login:</label>
                                                    <input class="form-control" type="text" disabled="" name="loginINFO" id="loginINFO" value="<?php echo $prof['login']; ?>" />     
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="nome">Senha:</label>
                                                    <input class="form-control" type="text" name="senhaINFO" id="descricaoINFO"  value="<?php echo $prof['senha']; ?>"><br>
                                                </div>
                                            
                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" name="btnUpdate" class="btn btn-success btn-send" value="Guardar Alterações">            
                                            </div>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div> 

                
                <?php } ?>

                <!-----------------------------------------------FIM DO MODAL HISTORICO------------------------------------------------------->   
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
                    <div class= "text-center"><?php echo $totalProfessor; ?> Aluno(s) Encontrado(s)</div><br>
                <?php } ?>

     








        <!----------------------------------------------MODAL DE CADASTRO COORDENADOR------------------------------------------------------------>    

        <div class="modal fade novo_aluno" id="meu_modal" >
            <div class="modal-dialog " >
                <div class="modal-content"> 
                    <div class="modal-header"> 
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                        <h4 class="modal-title" id="myLargeModalLabel"><strong>Cadastrar Coordenador </strong></h4> 
                    </div>

                    <form id="cadastro-form" method="POST"  autocomplete="off">
                        <div class="modal-body">
                            <div class="form-group row wow fadeInDown">
                                <div class="col-md-12">
                                    <label for="nome">Nome:</label>
                                    <input class="form-control" type="text" autocomplete="off" title="Digite o Nome" x-moz-errormessage="Digite o Nome." required="" name="nome" id="nome" /><br />
                                </div>
                                <div class="col-md-6">
                                    <label for="nome">Login:</label>
                                    <input class="form-control" type="text"  title="Coloque seu Login." x-moz-errormessage="Coloque seu Login." required="" name="login" id="matricula" value="" />     

                                </div>
                                <div class="col-md-6">
                                    <label for="nome">Senha:</label>
                                    <input class="form-control" type="password" required="" title="Coloque sua Senha." x-moz-errormessage="Coloque sua Senha."name="senha" id="senha" value=""  /><br />
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
