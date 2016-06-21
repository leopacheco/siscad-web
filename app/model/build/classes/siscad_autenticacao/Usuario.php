<?php
namespace Model;

use Model\om\BaseUsuario;

/**
 * Skeleton subclass for representing a row from the 'usuario' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.siscad_autenticacao
 */
class Usuario extends BaseUsuario
{

  public static function getUserByName($name){
    return \Model\UsuarioQuery::create()
                            ->filterByAtivo(1)
                            ->findOneByNome($name);

  }

  public function setUsuario($params){
    if(empty($params['id'])){
      $user = new Usuario;
    }else{
      $user = UsuarioQuery::create()->findPK($params['id']);
    }

    $user->setNome($params['nome']);
    $user->setDescricao($params['descricao']);
    $user->setSecret($params['secret']);
    $user->setPerfilId($params['perfil_id']);
    $user->setNome($params['nome']);
    if(isset($params['ativo'])){
      $user->setAtivo(1);
    }else{
      $user->setAtivo(0);
    }
    if($user->validate()){
      $user->save();
      return true;
    }else{
      $errorMsg = '';
      foreach ($user->getValidationFailures() as $failure) {
        $errorMsg .= $failure->getMessage() . "<br>";
      }
      return $errorMsg;
    }
  }

}
