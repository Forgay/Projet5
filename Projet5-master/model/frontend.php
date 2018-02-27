<?php


function getPosts()
{
    $db = dbConnect();
    $req = $db->query('SELECT * FROM posts WHERE posted = 1 ORDER BY id DESC');
    return $req;
}

function getPost($id)
{
    $db = dbConnect();
    $req = $db->prepare("SELECT * FROM posts WHERE posted=1 AND id = {$_GET['id']}");
    $req->execute(array($id));
    $post = $req->fetch();
    return $post;

}

function getComments($id)
{
    $db = dbConnect();
    $req = $db->prepare("SELECT * FROM comments WHERE post_id={$_GET['id']} ORDER BY date_comment DESC");
    $req->execute(array($id));
    $postcomment = $req;
    return $postcomment;

}

function postComment($nom, $email, $comment, $postId)
{
    $db = dbConnect();
    $comments = $db->prepare("INSERT INTO comments(nom,email,comment,post_id,date_comment) VALUES (?, ?, ?, ?, NOW())");
    $affectComment = $comments->execute(array($nom, $email, $comment, $postId));
    return $affectComment;
}

function dbConnect()
{
    try {
        $db = new PDO('mysql:dbname=blog; host=localhost', 'root', '');
        return $db;
    } catch (Exception $e) {
        die('erreur :' . $e->getMessage());
    }
}
