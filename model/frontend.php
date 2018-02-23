<?php


function getPosts()
{
    $db = dbConnect();
    $req = $db->query('SELECT id,title,content,writer,image,DATE_FORMAT(date,\'%d/%m/%Y à %Hh%imin%ss\') AS date_fr FROM posts WHERE posted = 1 ORDER BY id DESC');
    return $req;
}

function getPost($id)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id,title,content,writer,image,DATE_FORMAT(date, \'%d/%m/%Y à %Hh%imin%ss\') AS date_fr FROM posts WHERE posted=1 AND id = ?');
    $req->execute(array($id));
    $post = $req->fetch();
    return $post;

}

function getComments($id)
{
    $db = dbConnect();
    $req = $db->prepare('SELECT id,nom,email,comment,DATE_FORMAT(date,\'%d/%m /%Y à %Hh%imin%ss\') AS date_fr FROM comments WHERE  post_id=? ORDER BY date DESC ');
    $req->execute(array($id));
    $comments= $req->fetch();
    return $comments;

}

function postComment($nom, $email, $comment, $postId)
{
    $db = dbConnect();
    $comments = $db->prepare('INSERT INTO comments (nom,email,comment,postId,date) VALUES (?,?,?,?,NOW() )');
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
