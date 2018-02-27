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
    $comments = $db->prepare("SELECT * AS date_fr FROM comments WHERE  post_id='{$_GET['id']}' ORDER BY date DESC");
    $comments->execute(array($id));

    return $comments;

}

function postComment($nom, $email, $comment, $postId)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO comments (nom,email,comment,postId,date,seen) VALUES (?,?,?,?,NOW(),0)');
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
