<?php

include_once("models/ConfiguracaoModel.php");
class ConfigController {

     private $configModel;

    public function __construct() {
        $this->configModel = new ConfigModel();
    }

    public function cadastrarAdm($adm) {

           return $this->configModel->cadastrarAdm($adm);
    }

    public function atualizarAdm($adm) {

           return $this->configModel->atualizarAdm($adm);
    }

    public function buscarAdms(){
           return $this->configModel->buscarAdms();
    }

    public function buscarAdm($adm){
           return $this->configModel->buscarAdm($adm);
    }

    public function numAdms($sql){

         return $this->configModel->numAdms($sql);

    }

    public function BuscarLIMIT($inicio, $quantPagina){

          return $this->configModel->BuscarLIMIT($inicio, $quantPagina);
      }

      public function desativarAdm($status, $cdusuario){

          if($status == 1){
              $status = 0;
          }else{
               $status = 1;
          }
      return  $this->configModel->desativarAdm($status, $cdusuario);
      }


}
