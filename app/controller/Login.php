<?php
namespace Controller;

class Login{

  public function login($params){
    if(\Model\UsuarioWeb::validateLogin($params)){
      $_SESSION['auth'] = true;
      $_SESSION['userName'] = $params['nome'];
      return true;
    }else{
      return false;
    }
  }
}
