<?php
namespace Middleware;

class Autenticacao extends \Slim\Middleware{

  public function call(){
    // Get reference to application
    $app = $this->app;
    $req = $app->request;

    try{
     $this->_authenticate($req);

    }catch (\Exception $e) {
     die($e->getMessage());
    }

    $this->next->call();
  }

  private function _authenticate($req){
    $uri = $req->getResourceUri();

    if($uri != '/' && $uri != '/login'){
      if(!isset($_SESSION['auth'])){
        //$app->redirect($req->getRootUri().'/');
        throw new \Exception('Usuário não autenticado', 403);
      }
    }
  }
}
