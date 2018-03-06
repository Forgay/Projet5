<?php

session_start();


try {
    $db = new PDO('mysql:dbname=blog; host=localhost', 'root', '', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
    return $db;
} catch (Exception $e) {
    die('erreur :' . $e->getMessage());
}

function getPosts()
{
    global $db;
    $req = $db->query('SELECT * FROM posts WHERE posted = 1 ORDER BY id DESC');
    $results = array();
    while ($rows = $req->fetchObject()) {
        $results[] = $rows;
    }
    return $results;
}

function getPost($id)
{
    global $db;
    $req = $db->prepare("SELECT * FROM posts WHERE posted= 1 AND id = {$_GET['id']}");
    $req->execute(array($id));
    $post = $req->fetch();
    return $post;

}

function getComments($id)
{
    global $db;
    $req = $db->prepare("SELECT * FROM comments WHERE post_id={$_GET['id']} AND seen=1  ORDER BY date_comment DESC");
    $req->execute(array($id));
    $postcomment = $req;
    return $postcomment;

}

function postComment($nom, $email, $comment, $postId)
{
    global $db;
    $comments = $db->prepare("INSERT INTO comments(nom,email,comment,post_id,date_comment) VALUES (?, ?, ?, ?, NOW())");
    $affectComment = $comments->execute(array($nom, $email, $comment, $postId));
    return $affectComment;
}
