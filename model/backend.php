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

     $reqpseudo= $db ->prepare('SELECT pseudo FROM admins WHERE pseudo = ?');
     $reqpseudo->execute(array($pseudo));
     $verifpseudo = $reqpseudo->fetch();
        return $verifpseudo;
 }
function verifEmail($email)
{
    global $db;

    $reqemail= $db->prepare( "SELECT email FROM admins WHERE email = ?");
    $reqemail->execute(array($email));
    $verifemail = $reqemail->fetch();

    return $verifemail;

}
function addAdmin ($pseudo,$email,$password)
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

/**
 * @param $pseudo
 * @param $email
 * @return mixed
 */

function isConnect($pseudo,$email)
{
    global $db;
    $req = $db->prepare("SELECT id FROM admins WHERE pseudo=:pseudo AND email=:email");
    $req->execute(array($pseudo,$email));
    $verifpass = $req->fetch();

    return $verifpass;
}

/**
 * @param $pseudo
 * @return mixed
 */
function isPass($pseudo)
{
    global $db;
    $req = $db->prepare("SELECT password FROM admins WHERE pseudo=?");
    $req->execute(array($pseudo));
    $results=$req->fetch();
    return $results;

}

/**
 * @param $table
 * @return mixed
 */
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

/**
 * @param $id
 * @return bool
 */
function validCom($id)
{
    global  $db;
    $req = $db->prepare("UPDATE comments SET  seen='1' WHERE id=?" );
    $valid=$req->execute(array($id));
    return $valid;
}

function delCom($id)
{
    global $db;
    $req = $db->prepare("DELETE FROM comments WHERE id=? ");
    $req->execute(array($id));

}
function postAd($title,$content,$posted)
{
    global $db;
    $p=[
        'title'     => $title,
        'content'   => $content,
        'posted'    => $posted
    ];
    $sql = "INSERT INTO posts(title,content,writer,date,posted) VALUES (:title,:content,'admin',NOW(),:posted)";
    $req = $db->prepare($sql);
    $req ->execute($p);
}

function postImg($tmpname,$extension)
{
    global  $db;
    $id = $db->lastInsertId();
    $i = [
        'id'    => $id,
        'image' => $id.$extension
    ];
    $sql = "UPDATE posts SET image=:image WHERE id=:id";
    $req = $db->prepare($sql);
    $req->execute($i);
    move_uploaded_file($tmpname,"../web/img/posts/".$id.$extension);
}

function edit($title,$content,$posted,$id)
{
    global $db;
    $a=[
        'title'     => $title,
        'content'   => $content,
        'posted'    => $posted,
        'id'        => $id
    ];
    $sql = "UPDATE posts SET title=:title, content=:content, datemodify=NOW(), posted=:posted WHERE id=:id";
    $req = $db->prepare($sql);
    $req->execute($a);
}

/**
 * @param $id
 * @return bool
 */
function adgetPost($id)
{
    global $db;
    $req = $db->prepare("SELECT title,content FROM posts WHERE id =?");
    $req->execute(array($id));
    $results=$req->fetch();
    return $results;

}