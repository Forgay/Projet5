<?php
require '../controller/frontend.php';
require '../controller/backend.php';
require '../controller/contact.php';

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

        if (!empty($_POST['nom']) && !empty($_POST['email']) && !empty($_POST['message'])) {

            addContact($_POST['nom'], $_POST['email'], $_POST['message']);

        } else {


            echo 'Attention : Tous les champs ne sont pas remplis !';

        }


        break;

    case 'login':

        require('../view/logonView.php');

        break;

    case 'inscription':
        if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordverif'])) {

            addInscription($_POST['pseudo'], $_POST['email'], $_POST['password'], $_POST['passwordverif']);

        } else {
            echo 'Attention : Tous les champs ne sont pas remplis !';
        }
        break;

    case 'connexion':

        if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {

            addConnect();
            getsComment();


            include('../view/adlistPostsView.php');



        } else {

            echo 'Attention : Tous les champs ne sont pas remplis !';
        }

        break;

    case 'posted':

        if (isset($_GET['id']) && $_GET['id'] > 0) {

            validArticle();
            echo 'article validée';
            include ('../view/adlistPostsView.php');

        } else {
            echo 'Erreur : Aucun identifiant de l\'article';
        }

        break;

    case 'error':
        require('../view/404.php');
        break;

    default:
        header('HTTP/1.0 404 Not Found');
        require('../view/404.php');
        break;
}
