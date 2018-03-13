<?php
require('../model/backend.php');

$errors = [];

function addInscription()
{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);
    $passwordverif = htmlspecialchars($_POST['passwordverif']);

    if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == true) {

        require('../view/adlistPostsView.php');
    }
    if (isset($pseudo) && isset($email) && isset($password) && isset($passwordverif)) {

        // verification du pseudo et mail dans la base de données
        $verifpseudo = verifPseudo($pseudo);
        $verifemail = verifEmail($email);

        if ($pseudo != $verifpseudo && $email != $verifemail && $password == $passwordverif) {

            // Ecriture dans la base de donnée
            addAdmin($_POST['pseudo'], $_POST['email'], $_POST['password']);

            $confirinscription = "L'inscription s'est bien passé !Connectez vous";
            header('location:../view/logonView.php');
        }
        if ($pseudo == $verifpseudo && $email == $verifemail && $password != $passwordverif) {

            $errors ['pseudo'] = "Ce pseudo existe déjà !";
            $errors ['email '] = "Cet email existe déjà !";
            $errors ['password '] = "Les mots de passe ne correspondent pas !";

            // Si pseudo et mail sont KO
        } elseif ($pseudo == $verifpseudo && $email == $verifemail) {
            $errors ['pseudo'] = "Ce pseudo existe déjà !";
            $errors ['email '] = "Cet email existe déjà !";

            // si pseudo et mot de passe sont KO
        } elseif ($pseudo == $verifpseudo && $password == $passwordverif) {
            $errors ['pseudo'] = "Ce pseudo existe déjà !";
            $errors ['password '] = "Les mots de passe ne correspondent pas !";

            // si pseudo est KO
        } elseif ($pseudo == $verifpseudo) {
            $errors  ['pseudo'] = "Ce pseudo existe déjà !";

            // si mail et mot de passe sont KO
        } elseif ($email == $verifemail && ($password != $passwordverif)) {
            $errors ['email '] = "Cet email existe déjà !";
            $errors ['password '] = "Les mots de passe ne correspondent pas !";

            // si mail est KO
        } elseif ($email == $verifemail) {
            $errors ['email'] = "Cet email existe déjà !";

            // Si mot de passe est KO
        } elseif (($password != $passwordverif)) {
            $errors ['password'] = "Les mots de passe ne correspondent pas !";
        }
    }
}

function addConnect()

{
    $pseudo = htmlspecialchars($_POST['pseudo']);
    $email = htmlspecialchars($_POST['email']);
    $password = htmlspecialchars($_POST['password']);

    if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == true) {

        require('../view/adlistPostsView.php');
    }
    if (isset($pseudo) && isset($email) && isset($password)) {

        $verifpass = isPass($pseudo);
        $isPasswordCorrect = password_verify($password, $verifpass['password']);

        if (!$isPasswordCorrect) {
            $errors ['baspassword'] = "Votre mot de passe est erronée";
        } else {
            require('../view/adlistPostsView.php');
        }
    }

}

function logout()

{
    session_start();
    $_SESSION = array();
    session_destroy();
    header('Location:../view/listPostView.php');
}

function addTable($tables)
{
    $table = inTable($tables);
    return $table;
}

function getsComment()
{
    $comments = get_comments();
    return $comments;
}


function validComment()
{

    if (isset($_GET['id'])) {
        $valid = validCom($_GET['id']);

        require("../view/adlistPostsView.php");
    } else {
        echo "pas bon";
    }
}

function delComment()
{
    if (isset($_GET['id'])) {
        $delete = delCom($_GET['id']);
        require("../view/adlistPostsView.php");
    }

}

function writePost()
{
    if (isset($_POST['post'])) {
        $title = htmlspecialchars(trim($_POST['title']));
        $content = htmlspecialchars(trim($_POST['content']));
        $posted = isset($_POST['public']) ? "1" : "0";

        $errors = [];

        if (empty($title) || empty($content)) {
            $errors['empty'] = "Veuillez remplir tous les champs";
        }

        if (!empty($_FILES['image']['name'])) {
            $file = $_FILES['image']['name'];
            $extensions = ['.png', '.jpg', '.jpeg', '.gif', '.PNG', '.JPG', '.JPEG', '.GIF'];
            $extension = strrchr($file, '.');

            if (!in_array($extension, $extensions)) {
                $errors['image'] = "Cette image n'est pas valable";
            }
        }
    }
    if (!empty($errors)) {

        //envoyer l'affichage des erreurs

    } else {

        postAd($title, $content, $posted);

        if (!empty($_FILES['image']['name'])) {
            postImg($_FILES['image']['tmp_name'], $extension);
        }

    }
}

function adpost()
{
    if (isset($_GET['id'])) {


        $postad = adgetPost($_GET['id']);


        require('../view/upPostView.php');


        if (isset($_POST['submit'])) {

            $title = htmlspecialchars(trim($_POST['title']));
            $content = htmlspecialchars(trim($_POST['content']));
            $posted = isset($_POST['public']) ? "1" : "0";
            $errors = [];

            if (empty($title) || empty($content)) {
                $errors['empty'] = "Veuillez remplir tous les champs";
            }
            if (!empty($errors)) {
                // envoyer des erreurs
            } else {

                edit($title, $content, $posted, $_GET['id']);

            }

        }
    }
}
