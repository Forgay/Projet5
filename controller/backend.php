<?php
require('../model/backend.php');

$errors = [];

function addInscription($pseudo, $email, $password, $passwordverif)
{

    if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == true) {

        header('location:../view/adlistPostsView.php');
    }
    if (isset($_POST['pseudo']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['passwordverif'])) {

        // verification du mail dans la base de données
        $verifemail = verifEmail($email);
        $verifpseudo = verifPseudo($pseudo);
        if ((strtolower($_POST['pseudo']) != strtolower($verifpseudo) && (strtolower($_POST['email']) != strtolower($verifemail)) && ($password == $passwordverif))) {
            // Ecriture dans la base de donnée
            isInscrip($_POST['pseudo'], $_POST['email'], $_POST['password']);
            $confirinscription = "L'inscription s'est bien passé !Connectez vous";

        }
        if (($_POST['pseudo'] == $verifpseudo) && ($_POST['email'] == $verifemail) && ($password != $passwordverif)) {

            $errors = ['pseudo' => "Ce pseudo existe déjà !"];
            $errors = ['email ' => "Cet email existe déjà !"];
            $errors = ['password ' => "Les mots de passe ne correspondent pas !"];

            // Si pseudo et mail sont KO
        } elseif ($_POST['pseudo'] == $verifpseudo && $_POST['email'] == $verifemail) {
            $errors = ['pseudo' => "Ce pseudo existe déjà !"];
            $errors = ['email ' => "Cet email existe déjà !"];

            // si pseudo et mot de passe sont KO
        } elseif ($_POST['pseudo'] == $verifpseudo && ($password == $passwordverif)) {
            $errors = ['pseudo' => "Ce pseudo existe déjà !"];
            $errors = ['password ' => "Les mots de passe ne correspondent pas !"];

            // si pseudo est KO
        } elseif ($_POST['pseudo'] == $verifpseudo) {
            $errors = ['pseudo' => "Ce pseudo existe déjà !"];

            // si mail et mot de passe sont KO
        } elseif ($_POST['email'] == $verifemail && ($password != $passwordverif)) {
            $errors = ['email ' => "Cet email existe déjà !"];
            $errors = ['password ' => "Les mots de passe ne correspondent pas !"];

            // si mail est KO
        } elseif ($_POST['email'] == $verifemail){
            $errors = ['email ' => "Cet email existe déjà !"];

            // Si mot de passe est KO
        } elseif (($password != $passwordverif)) {
            $errors = ['password ' => "Les mots de passe ne correspondent pas !"];
        }
    }
}

function addConnect()
{
    if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == true) {

        header('location:../view/adlistPostsView.php');
    }
    if (isset($_POST['pseudo']) && isset($_POST['password']))
    {

        $verifpass=isPass($_POST['pseudo']);
        $isPasswordCorrect = password_verify($_POST['password'],$verifpass);

        if (!$isPasswordCorrect)
        {
            $errors = ['baspassword'=> "Votre mot de passe est erronée"];
        }else{
            header('location:../view/adlistPostsView.php');
        }
    }

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

function validArticle()
{
    $valid = validPost($_GET['id']);
}

