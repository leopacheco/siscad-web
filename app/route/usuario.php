<?php

$app->get('/usuario(/)', function () use ($app) {
  $user = new \Controller\Usuario;
  $userList = $user->getUsuario();
  $app->render('list_user.phtml', array('userList' => $userList, 'url'=>$app->request->getRootUri()));
});


$app->get('/usuario/editar/:id', function ($id) use ($app) {
  $user = new \Controller\Usuario;
  $userData =  $user->getUsuario($id);
  $perfis = \Controller\Perfil::getPerfil();
  $app->render('form_user.phtml', array('perfis' => $perfis, 'user'=>$userData, 'url'=>$app->request->getRootUri()));
});


$app->post('/usuario/editar/:id', function ($id) use ($app) {
  $params = $app->request->params();
  $user = new \Controller\Usuario;
  $userData = $user->setUsuario($params);
  $perfis = \Controller\Perfil::getPerfil();
  $app->render('form_user.phtml', array('perfis' => $perfis, 'user'=>$userData, 'url'=>$app->request->getRootUri()));
});


$app->get('/usuario/novo(/)', function () use ($app) {
  $perfis = \Controller\Perfil::getPerfil();
  $app->render('form_user.phtml', array('perfis' => $perfis, 'url'=>$app->request->getRootUri()));
});


$app->post('/usuario/novo(/)', function () use ($app) {
  $params = $app->request->params();
  $user = new \Controller\Usuario;
  $user->setUsuario($params);
  $perfis = \Controller\Perfil::getPerfil();
  $app->render('form_user.phtml', array('perfis' => $perfis, 'user'=>$user, 'url'=>$app->request->getRootUri()));
});
