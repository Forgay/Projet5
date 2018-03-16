<?php


namespace Model;

use Entity\Admins;
use Gthareau\Manager;

class AdminsManager extends Manager
{

    public function isAdmin($pseudo, $email, $password)
    {

        $z = [
            'pseudo' => $pseudo,
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)];

        // verifier l'administrateur existe
        $sql = "SELECT * FROM admins WHERE pseudo = :pseudo AND email = :email AND password=:password";
        $req = $this->setDb()->prepare($sql);
        $exist = $req->execute($z);
        return $exist;
    }

    public function adAdmin($pseudo, $email, $password)
    {
        $a = [
            'pseudo' => htmlspecialchars($pseudo),
            'email' => htmlspecialchars($email),
            'password' => password_hash($password, PASSWORD_DEFAULT)];

        $sql = "INSERT INTO admins (pseudo, password, email, date_inscription) VALUES (:pseudo,:password,:email,NOW())";
        $req = $this->setDb()->prepare($sql);
        $confirinscription = $req->execute($a);
        return $confirinscription;
    }

    public function CountPost()
    {

        $query = $this->setDb()->query("SELECT COUNT(id) FROM posts");
        return $nombre = $query->fetch();
    }

    public function isPass($pseudo)
    {

            $req = $this->setDb()-> prepare("SELECT password FROM admins WHERE pseudo=?");
            $req->execute(array($pseudo));
            $results=$req->fetch();
            return $results;
    }

}