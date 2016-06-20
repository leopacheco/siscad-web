<?php

$app->get('/', function () use ($app) {
  $app->response->setStatus(200);
  $app->render('index.phtml', array('url'=>$app->request->getRootUri()));
});


$app->post('/login', function () use ($app) {
  $params = $app->request->params();
  $login = new \Controller\Login;
  if($login->login($params)){
    $app->redirect($app->request->getRootUri().'/usuario');
  }else{
    $app->redirect($app->request->getRootUri().'/');
  }
});

$app->get('/logout', function () use ($app) {
  session_destroy();
  $app->redirect($app->request->getRootUri().'/');
});
