<?php 

class Conexao{
   private $host = 'localhost';
   private $user = 'root';
   private $pass = '';
   private $database = 'diario';
   private $con;
 
   function __construct()
   {
       $this->conecta();
   }
 
   function conecta()
   {
        $this->con = mysqli_connect($this->host, $this->user, $this->pass, $this->database) or die("Erro ao conectar ao servidor &raquo; " . mysql_error());
        $this->con->query("SET NAMES 'utf8'");
	$this->con->query('SET character_set_connection=utf8');
	$this->con->query('SET character_set_client=utf8');
	$this->con->query('SET character_set_results=utf8');
       return $this->con;
       
   }
   
   function executarQuery ($sql){
       
       $result = mysqli_query($this->con, $sql);
       
       
     
           return $result ;
       
   }
   
   function numRows ($res){
       
       $result = mysqli_num_rows($res);

        return $result;
       
   }
   
   
}




