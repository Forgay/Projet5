<?php

require_once '../vendor/autoload.php';

use App\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;

ErrorHandler::register();
ExceptionHandler::register();
$request = Request::createFromGlobals();

$app = new Kernel();
$app->boot($request->server->get('REQUEST_URI'));
