<?php

 function isAdmin($pseudo,$email,$password)
 {

     global $db;

     $z = [
         'pseudo'=>$pseudo,
         'email'=>$email,
         'password'=>password_hash($password,PASSWORD_DEFAULT)];

// verifier l'administrateur existe
     $sql = "SELECT * FROM admins WHERE pseudo = :pseudo AND email = :email AND password=:password";
     $req = $db->prepare($sql);
     $exist = $req->execute($z);
     return $exist;

 }
 function verifPseudo($pseudo)
 {
     global $db;

     $q ="SELECT pseudo FROM admins WHERE pseudo =:pseudo";
     $req = $db->prepare($q);
     $exist = $req->execute($pseudo);

     return $exist;

 }
function verifEmail($email)
{
    global $db;

    $sql ="SELECT email FROM admins WHERE email =:email";
    $req = $db->prepare($sql);
    $exist = $req->execute($email);

    return $exist;

}
function isInscrip($pseudo,$email,$password)
{
    global $db;

    $a =[
        'pseudo'  =>htmlspecialchars($pseudo),
        'email'   =>htmlspecialchars($email),
        'password'=>password_hash($password,PASSWORD_DEFAULT)];

    $sql="INSERT INTO admins (pseudo, password, email, date_inscription) VALUES (:pseudo,:password,:email,NOW())";
    $req = $db->prepare($sql);
    $confirinscription= $req->execute($a);
    return $confirinscription;
}



function isConnect($pseudo,$email)
{
    global $db;
    $req = $db->prepare("SELECT id FROM admins WHERE pseudo=:pseudo AND email=:email");
    $req->execute(array($pseudo,$email));
    $verifpass = $req->fetch();

    return $verifpass;
}

function isPass($pseudo)
{
    global $db;
    $req = $db->query("SELECT password FROM admins WHERE pseudo =$pseudo");
    $results = [];
    while($rows = $req->fetchObject()){
        $results[] = $rows;
    }
    return $results;


}

function inTable($table)
{

    global $db;

    $query = $db->query("SELECT COUNT(id) FROM $table");
    return $nombre = $query->fetch();

}
function get_comments(){

     global $db;

    $req = $db->query("
        SELECT  comments.id,
                comments.nom,
                comments.email,
                comments.date_comment,
                comments.post_id,
                comments.comment,
                posts.title
        FROM comments
        JOIN posts
        ON comments.post_id = posts.id
        WHERE comments.seen = '0'
        ORDER BY comments.date_comment ASC
    ");

    $results = [];
    while($rows = $req->fetchObject()){
        $results[] = $rows;
    }
    return $results;
}
function get_post(){

    global $db;

    $req = $db->query("SELECT * FROM posts WHERE posted = '0' ORDER BY date ASC");

    $results = [];
    while($rows = $req->fetchObject()){
        $results[] = $rows;
    }
    return $results;
}
function validPost($id)
{
    global  $db;
    $sql = "UPDATE posts SET  date=NOW(), posted='1' WHERE id = $id";
    $req = $db->prepare($sql);
    $req->execute();
}

