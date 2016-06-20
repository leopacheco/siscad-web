<?php
namespace Controller;

class Usuario{

  public function getUsuario($id=null){
    if(is_null($id)){
      return \Model\UsuarioQuery::create()->find();
    }else{
      return \Model\UsuarioQuery::create()->findPK($id);
    }

  }

  public function setUsuario($params){
    $user = new \Model\Usuario;
    $user->setUsuario($params);
    return true;
  }


}
