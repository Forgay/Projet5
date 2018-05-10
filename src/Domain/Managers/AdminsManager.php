<?php

namespace Src\Domain\Managers;

use App\Bdd\Manager;
use Src\Domain\Models\Admins;

class AdminsManager extends Manager
{

    public function isAdmin(Admins $admins)
    {

        $req = $this->getConnexion()->prepare("SELECT password FROM admins WHERE pseudo=:pseudo AND email = :email");

        $req->bindValue(':pseudo', htmlspecialchars($admins->getPseudo()), \PDO::PARAM_STR);
        $req->bindValue(':email', htmlspecialchars($admins->getEmail()), \PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetch();

        return password_verify($admins->getPassword(), $result['password']);

    }

    /**
     * @param Admins $admins
     * @return mixed
     */
    public function getAdmin(Admins $admins)
    {
        $req = $this->getConnexion()->prepare("SELECT pseudo, email, role FROM admins WHERE pseudo=:pseudo");
        $req->bindValue(':pseudo', htmlspecialchars($admins->getPseudo(), \PDO::PARAM_STR));
        $req->execute();

        return $req->fetch();
    }

    public function isRole(Admins $admins)
    {
        $req = $this->getConnexion()->prepare("SELECT role FROM admins WHERE pseudo=:pseudo AND email=:email");

        $req->bindValue(':pseudo', htmlspecialchars($admins->getPseudo()), \PDO::PARAM_STR);
        $req->bindValue(':email', htmlspecialchars($admins->getEmail()), \PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetch();

        return $result;

    }

    public function addAdmin(Admins $admins)
    {
        $req = $this->getConnexion()->prepare("INSERT INTO admins (pseudo, email, password,  dateInscription) VALUES (:pseudo,:email,:password,NOW())");

        $req->bindValue(':pseudo', htmlspecialchars($admins->getPseudo()), \PDO::PARAM_STR);
        $req->bindValue(':email', htmlspecialchars($admins->getEmail()), \PDO::PARAM_STR);
        $req->bindValue(':password', password_hash($admins->getPassword(), PASSWORD_DEFAULT), \PDO::PARAM_STR);

        $req->execute();

    }

    public function UpDateAdmin(Admins $admins)
    {
        $req = $this->getConnexion()->prepare("UPDATE admins SET email=:email, password=:password WHERE pseudo=:pseudo");

        $req->bindValue(':pseudo',htmlspecialchars($admins->getPseudo()),\PDO::PARAM_STR);
        $req->bindValue(':email',htmlspecialchars($admins->getEmail()),\PDO::PARAM_STR);
        $req->bindValue(':password',password_hash($admins->getPassword(),PASSWORD_DEFAULT),\PDO::PARAM_STR);

        $req->execute();
    }

    public function InTable($tables)
    {
        foreach ($tables as $table) {

            $req = $this->getConnexion()->query("SELECT COUNT(id) FROM $table");
            $req->execute();

            return $req->fetch();
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