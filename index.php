<?php
session_start();
require 'app/config/app.php';
require 'vendor/autoload.php';
require 'app/loader.php';

// Initialize Propel with the runtime configuration
Propel::init("app/model/build/conf/siscad-api-conf.php");

// Add the generated 'classes' directory to the include path
set_include_path("app/model/build/classes" . PATH_SEPARATOR . get_include_path());

//Iniciando a aplicação
$app = new \Slim\Slim(array(
    'debug' => false,
    'mode' => 'development'
));
$app->response->headers->set('Content-Type', 'text/html;charset=utf-8');
$app->config(array( 'templates.path' => 'app/view/', ));
$app->add(new Middleware\Autenticacao);
//routes
require 'app/route/index.php';
require 'app/route/usuario.php';
require 'app/route/error.php';

$app->run();
