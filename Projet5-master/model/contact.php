<?php

$errors =[];

if(!array_key_exists('nom',$_POST)|| $_POST['nom']=='' ){
    $errors['nom']="vous n'avez pas renseigné votre nom !";
}
if(!array_key_exists('email',$_POST)|| $_POST['email']==''|| !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)){
    $errors['nom']="vous n'avez pas renseigné un email valide !";
}
if(!array_key_exists('message ',$_POST)|| $_POST['message']=='' ){
    $errors['nom']="vous n'avez pas renseigné votre message !";
}

if (!empty($errors)){
    session_start();
    $_SESSION['errors'];
    header('Location:web/index.php');
}


$message = $_POST['message'];
$headers = 'FROM:site@local.fr';
mail('gthareau1@gmail.com','Formaulaire de Contact',$message,$headers);

