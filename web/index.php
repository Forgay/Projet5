<?php

$page = 'home';

if (isset($_GET['action'])) {
    $page = $_GET['action'];
}

switch ($page) {
    case 'home':
        require ('../view/home.php');
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        require ('../view/404.php');
        break;
}