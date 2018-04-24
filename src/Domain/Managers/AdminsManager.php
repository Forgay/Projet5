<?php

namespace Src\Domain\Managers;

use App\Bdd\Manager;
use Src\Domain\Models\Admins;

class AdminsManager extends Manager
{

    public function isAdmin(Admins $admins)
    {

        $req = $this->getConnexion()->prepare("SELECT password FROM admins WHERE pseudo=:pseudo AND email = :email");

        $req->bindValue(':pseudo', htmlspecialchars($admins->getPseudo()),\PDO::PARAM_STR);
        $req->bindValue(':email', htmlspecialchars($admins->getEmail()),\PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetch();

        return password_verify($admins->getPassword(),$result['password']);

    }

    public function addAdmin(Admins $admins)
    {
        $req = $this->getConnexion()->prepare("INSERT INTO admins (pseudo, email, password,  dateInscription) VALUES (:pseudo,:email,:password,NOW())");

        $req->bindValue(':pseudo', htmlspecialchars($admins->getPseudo()),\PDO::PARAM_STR);
        $req->bindValue(':email', htmlspecialchars($admins->getEmail()),\PDO::PARAM_STR);
        $req->bindValue(':password', password_hash($admins->getPassword(),PASSWORD_DEFAULT),\PDO::PARAM_STR);

        $req->execute();

    }

    public function isPass($pseudo)
    {

            $req = $this->setDb()-> prepare("SELECT password FROM admins WHERE pseudo=?");
            $req->execute(array($pseudo));
            $results=$req->fetch();
            return $results;
    }

    public function InTable($tables)
    {
        foreach ($tables as $table){

            $req = $this->getConnexion()->query("SELECT COUNT(id) FROM $table");
            $req->execute();

            dump($nombre = $req->fetch());
        }


    }

    public function getTables()
    {
        $tables = [
            "Publications" => "posts",
            "Commentaires" => "comments",
            "Administrateurs" => "admins"
        ];
        return $tables;
    }
}