<?php
namespace Controller;

class Perfil{

public static function getPerfil(){
  return \Model\PerfilQuery::create()->find();
}

}
