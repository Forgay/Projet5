<?php
namespace Projet5\web;

require '../vendor/autoload.php';

$page = 'home';

if (isset($_GET['action'])) {
    $page = $_GET['action'];
}

switch ($page) {

    case 'home':
        listPost();
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

                $nom = htmlspecialchars($_POST['nom']);
                $email = htmlspecialchars($_POST['email']);
                $comment = htmlspecialchars($_POST['comment']);
                $postId = htmlspecialchars($_GET['id']);

                addComment($nom, $email, $comment, $postId);

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

        if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {
            addConnect();
        }

        require('../View/logonView.php');

        break;

    case 'inscription':
        if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password']) && !empty($_POST['passwordverif'])) {

            addInscription();

        } else {
            echo 'Attention : Tous les champs ne sont pas remplis !';
        }
        break;

    case 'connexion':

        if (!empty($_POST['pseudo']) && !empty($_POST['email']) && !empty($_POST['password'])) {

            addConnect();
            getsComment();


            include('../View/adlistPostsView.php');


        } else {

            echo 'Attention : Tous les champs ne sont pas remplis !';
        }

        break;
    case 'logout':

        logout();


        break;
    case 'posted':

        validComment();

        include('../View/adlistPostsView.php');

        break;


    case 'delete':

        delComment();

        include('../View/adlistPostsView.php');

        break;

    case 'write':

        if (!empty($_POST['post'])) {

            writePost();
        } else {
            include('../View/writePostView.php');
        }
        break;
    case 'list':

    include('../View/showPostView.php');

    break;

    case 'post':

        if (isset($_GET['id']) && $_GET['id'] > 0) {

            adpost();

        } else {
            echo 'Erreur : Aucun identifiant de l\'article';
        }
        break;

    case 'error':

        require('../View/404.php');

        break;

    default:
        header('HTTP/1.0 404 Not Found');
        require('../View/404.php');
        break;
}
