<?php

require_once '../vendor/autoload.php';

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;

$request = Request::createFromGlobals();

$app = new Kernel();
$app->boot($request->server->get('REQUEST_URI'));
