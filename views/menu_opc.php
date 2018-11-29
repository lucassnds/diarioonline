<?php

function menu_adm(){ ?>

 <nav class="fR">
        <ul class="l2">
             <a href="?pagina=home" id="home"><li onmouseover="mudaletra(1)" onmouseout="voltaletra(1)">
              <span id="sphome" class="glyphicon glyphicon-home"  > INÍCIO
          </li></a>
           <a href="?pagina=alunos" id="aluno"><li onmouseover="mudaletra(1)" onmouseout="voltaletra(1)">
              <span id="spaluno" class="glyphicon glyphicon-user"  > ALUNOS
          </li></a>
         <a href="?pagina=professores" id="professor"> <li  onmouseover="mudaletra(2)" onmouseout="voltaletra(2)">
            <span id="spprofessor" class="glyphicon glyphicon-education"  > PROFESSORES
          </li></a>
          <a href="?pagina=turmas" id="turmas"><li  onmouseover="mudaletra(3)" onmouseout="voltaletra(3)">
           <span id="spturmas" class="glyphicon glyphicon-list" > TURMAS
          </li></a>
           <a href="?pagina=cursos" id="cursos"><li  onmouseover="mudaletra(6)" onmouseout="voltaletra(6)">
            <span id="spcursos" class="glyphicon glyphicon-book" > CURSOS
          </li></a>
          <a href="?pagina=disciplinas" id="disciplinas"><li  onmouseover="mudaletra(4)" onmouseout="voltaletra(4)">
            <span id="spdisciplinas" class="glyphicon glyphicon-list-alt"  > DISCIPLINAS
          </li></a>
           <a href="?pagina=modulos" id="modulos"><li  onmouseover="mudaletra(5)" onmouseout="voltaletra(5)">
            <span id="spmodulos" class="glyphicon glyphicon-th-list"  > MODULOS
          </li></a>
            <a href="?pagina=editarperfil" id="perfil" style="display: none; "><li  onmouseover="mudaletra(8)" onmouseout="voltaletra(8)" >
            <span id="spperfil" class="glyphicon glyphicon-cog" > EDITAR PERFIL
          </li></a>
            <a href="?pagina=adms" id="config" ><li id="liconfig"  onmouseover="mudaletra(7)" onmouseout="voltaletra(7)">
            <span id="spconfig" class="glyphicon glyphicon-cog" > ADMINS
          </li></a>
             <a href="?pagina=sair" id="sair" ><li id="lisair"  onmouseover="mudaletra(9)" onmouseout="voltaletra(9)">
            <span id="spsair" class="glyphicon glyphicon-log-out" > SAIR
          </li></a>

        </ul>
      </nav>



<?php }

function menu_aluno(){ ?>

 <nav class="fR">
        <ul class="l2">
            <a href="?pagina=editarperfil" id="perfil" style="display: none; "><li  onmouseover="mudaletra(8)" onmouseout="voltaletra(8)" >
            <span id="spperfil" class="glyphicon glyphicon-cog" > EDITAR PERFIL
          </li></a>
            <a href="?pagina=configuracoes" id="config" ><li id="liconfig"  onmouseover="mudaletra(7)" onmouseout="voltaletra(7)">
            <span id="spconfig" class="glyphicon glyphicon-cog" > CONFIGURAÇÕES
          </li></a>
             <a href="?pagina=sair" id="sair" ><li id="lisair"  onmouseover="mudaletra(9)" onmouseout="voltaletra(9)">
            <span id="spsair" class="glyphicon glyphicon-log-out" > SAIR
          </li></a>

        </ul>
      </nav>



<?php }

function menu_professor(){ ?>

 <nav class="fR">
        <ul class="l2">
            <a href="?pagina=editarperfil" id="perfil" style="display: none; "><li  onmouseover="mudaletra(8)" onmouseout="voltaletra(8)" >
            <span id="spperfil" class="glyphicon glyphicon-cog" > EDITAR PERFIL
          </li></a>
            <a href="?pagina=configuracoes" id="config" ><li id="liconfig"  onmouseover="mudaletra(7)" onmouseout="voltaletra(7)">
            <span id="spconfig" class="glyphicon glyphicon-cog" > CONFIGURAÇÕES
          </li></a>
             <a href="?pagina=sair" id="sair" ><li id="lisair"  onmouseover="mudaletra(9)" onmouseout="voltaletra(9)">
            <span id="spsair" class="glyphicon glyphicon-log-out" > SAIR
          </li></a>

        </ul>
      </nav>



<?php }
