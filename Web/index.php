<?php

require '../vendor/autoload.php';

$app=new kernel();
$app->boot($_SERVER['RESQUEST_URI']);