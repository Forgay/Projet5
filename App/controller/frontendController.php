<?php

namespace src\controller;

use src\model\PostManager;


function listPost()
{
    $posts = new PostManager();
    $this->getPosts();

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
        header('Location:index1.php?action=article&id=' . $postId);
    }

}
