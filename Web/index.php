<?php

require '../vendor/autoload.php';

use App\Kernel;

$app=new Kernel();
$app->boot($_SERVER['RESQUEST_URI']);