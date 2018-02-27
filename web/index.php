<?php
require '../controller/frontend.php';
require '../controller/backend.php';

$page = 'home';

if (isset($_GET['action'])) {
    $page = $_GET['action'];
}

switch ($page) {
    case 'home':
        listPosts();
        break;

    case 'article':
        if (isset($_GET['id']) && $_GET['id'] > 0) {

            post();

        } else {
            echo 'Erreur : Aucun identifiant de l\'article';
        }
        break;

    case 'ajoutComment':

        if (isset($_GET['id']) && $_GET['id'] > 0) {
            if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['comment'])) {

                addComment($_POST['nom'], $_POST['email'], $_POST['comment'], $_GET['id']);

            } else {
                echo 'Attention : Tous les champs ne sont pas remplis !';
            }
        }
        break;
    case 'contact':


        break;


    case 'error':
        require('../view/404.php');
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        require('../view/404.php');
        break;
}
