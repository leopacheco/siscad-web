<?php
// ERROR HANDLING
// 500
$app->error(function (\Exception $e) use ($app) {
    $app->response->setStatus($e->getCode());
    echo json_encode(["Code" => $e->getCode(),"Erro"=> $e->getMessage()]);
});

//404
$app->notFound(function () use ($app) {
  $app->response->setStatus(404);
  echo json_encode(["Code"=> 404, "Erro"=> "URL inválida"]);
});
