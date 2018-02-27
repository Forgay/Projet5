<?php

 function isAdmin($email,$password)
 {
     global $db;

     $z = [
         'email'=>$email,
         'password'=>sha1($password)
     ];
// verifier l'administrateur existe
     $sql = "SELECT * FROM admins WHERE email = :email AND password = :password ";
     $req = $db->prepare ($sql);
     $req->execute($z);
     $exist = $req->rowCount($sql);
     return $exist;

 }