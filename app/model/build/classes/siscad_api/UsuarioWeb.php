<?php

namespace Model;

use Model\om\BaseUsuarioWeb;


/**
 * Skeleton subclass for representing a row from the 'usuario_web' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.siscad_api
 */
class UsuarioWeb extends BaseUsuarioWeb
{
  public static function validateLogin($params){

    if((!empty($params['nome'])) && (!empty($params['senha']))){
      $user = filter_var($params['nome'], FILTER_SANITIZE_STRING);
      $pass = md5(filter_var($params['senha'], FILTER_SANITIZE_STRING));

      if(!is_null(UsuarioWeb::_getUser($user, $pass))){
        return true;
      }else{
        return false;
      }
    }else{
      return false;
    }
  }

  private static function _getUser($user, $pass){
    return UsuarioWebQuery::create()
                                ->filterBySenha($pass)
                                ->findOneByNome($user);
  }
}
