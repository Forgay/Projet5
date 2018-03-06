<?php

require('../model/frontend.php');

function listPosts()
{
    $posts = getPosts();

    require('../view/listPostsView.php');
}

function post()
{


    $post = getPost($_GET['id']);
    $postcomment = getComments($_GET['id']);

    require('../view/postView.php');
}

function addComment($nom, $email, $comment, $postId)
{


    $affectComment = postComment($nom, $email, $comment, $postId);

    if ($affectComment === false) {
        die('impossible d\'ajouter un commentaire');
    } else {
        header('Location:index.php?action=article&id=' . $postId);
    }

}
