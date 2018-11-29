<?php

include_once ("../../Conexao.php");




    $banco = new Conexao();
    
                    
                $sql = "SELECT MAX(cdUsuario) FROM usuario WHERE cdNivel = 2";
    
                $res = $banco->executarQuery($sql);
    
                $cdUsuario = mysqli_fetch_array($res);
    
                $sql = "SELECT login from usuario where cdUsuario = {$cdUsuario[0]} and cdNivel = 2 ";

                $res = $banco->executarQuery($sql);

                 $login = mysqli_fetch_array($res);

                 $login[0]++;

                 echo $login[0];
                
          
    
    



	

