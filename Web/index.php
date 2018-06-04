<?php

require_once '../vendor/autoload.php';

use Symfony\Component\Debug\ErrorHandler;
use Symfony\Component\Debug\ExceptionHandler;
use App\Kernel;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session;
use App\Services\TwigService;

// Register global error and exception handlers
ErrorHandler::register();
ExceptionHandler::register();
$session = new Session\Session();
$session->start();

$request = Request::createFromGlobals();
$request->setSession($session);
$app = new Kernel();
$app->boot($request);
TwigService::getTwig()->addGlobal('message',$app->getSession());
