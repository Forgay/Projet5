<?php

require ('../model/frontend.php');

function listPosts()
{
    $posts = getPosts();

    require('../view/listPostsView.php');
}

function post()
{


    $post = getPost($_GET['id']);
    $comments = getComments($_GET['id']);

    require ('../view/postView.php');
}

function addComment()
{
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $comment = $_POST['comment'];
    $postId = $_GET['id'];

    $affectComment=postComment($nom,$email,$comment,$postId);

    if ($affectComment === false)
    {
        die('impossible d\'ajouter un commentaire');
    }
    else
    {
        header('Location:index.php?action=article&id=');
    }

}