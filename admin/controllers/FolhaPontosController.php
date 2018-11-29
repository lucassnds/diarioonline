
<?php

include_once("models/FolhaPontosModel.php");

class FolhaPontosController{
    private $folhaModel;

    public function __construct() {
        $this->folhaModel = new FolhaPontosModel();
    }
    
     public function BuscarPonto($mes, $cdProfessor, $cdDesc){
        return $this->folhaModel->BuscarPonto($mes, $cdProfessor, $cdDesc);       
    }
    
    public function BuscarDescPonto(){
      
        
        return $this->folhaModel->BuscarDescPonto();
    }
    
      public function BuscarProf(){
   
       
       return $this->folhaModel->BuscarProf();
      }
      
        public function Pontosregistrados($professor, $mes) {
      
        return $this->folhaModel->Pontosregistrados($professor, $mes);
    }
    
      public function BuscarNomes($turma, $motivo) {

        return $this->folhaModel->BuscarNomes($turma, $motivo);
    }

    public function BuscarNome($motivo) {

        return $this->folhaModel->BuscarNome($motivo);
    }
    
    
      function inverterdata($data) {

        if (count(explode("/", $data)) > 1) {
            return implode("-", array_reverse(explode("/", $data)));
        } elseif (count(explode("-", $data)) > 1) {
            return implode("/", array_reverse(explode("-", $data)));
        }
    }
    
   
    
}
