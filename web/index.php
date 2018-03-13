<?php

require '../src/vendor/autoload.php';




$router = new src\controller\Router($_GET['url']);

$router->get('/posts',function (){echo 'tous les articles'; });
$router->get('/posts/:id',function ($id){echo 'afficher l\'article .sid'; });
$router->post('/posts/:id',function ($id){echo 'afficher l\'article .sid'; });

$router->run();