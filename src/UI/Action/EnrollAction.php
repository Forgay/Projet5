<?php


//namespace Src\UI\Action;



//class EnrollAction
{
$errors = [];

    function addInscription()
    {
        $pseudo = htmlspecialchars($_POST['pseudo']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $passwordverif = htmlspecialchars($_POST['passwordverif']);

        if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == true) {

            require(
        }
        if (isset($pseudo) && isset($email) && isset($password) && isset($passwordverif)) {

            // verification du pseudo et mail dans la base de données
            $verifpseudo = verifPseudo($pseudo);
            $verifemail = verifEmail($email);

            if ($pseudo != $verifpseudo && $email != $verifemail && $password == $passwordverif) {

                // Ecriture dans la base de donnée
                addAdmin($_POST['pseudo'], $_POST['email'], $_POST['password']);

                $confirinscription = "L'inscription s'est bien passé !Connectez vous";
                header('location:../View/logonView.php');
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

}