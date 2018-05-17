<?php

namespace Src\Domain\Managers;

use App\Bdd\Manager;
use Src\Domain\Models\Admins;

class AdminsManager extends Manager
{
    /**
     * @param Admins $admins
     *
     * @return bool
     */
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
     *
     * @return mixed
     */
    public function getAdmin(Admins $admins)
    {
        $req = $this->getConnexion()->prepare("SELECT pseudo, email, role FROM admins WHERE pseudo=:pseudo");
        $req->bindValue(':pseudo', htmlspecialchars($admins->getPseudo(), \PDO::PARAM_STR));
        $req->execute();

        return $req->fetch();
    }

    /**
     * @param Admins $admins
     *
     * @return mixed
     */
    public function isRole(Admins $admins)
    {
        $req = $this->getConnexion()->prepare("SELECT role FROM admins WHERE pseudo=:pseudo AND email=:email");

        $req->bindValue(':pseudo', htmlspecialchars($admins->getPseudo()), \PDO::PARAM_STR);
        $req->bindValue(':email', htmlspecialchars($admins->getEmail()), \PDO::PARAM_STR);
        $req->execute();

        $result = $req->fetch();

        return $result;

    }

    /**
     * @param Admins $admins
     */
    public function addAdmin(Admins $admins)
    {
        $req = $this->getConnexion()->prepare("INSERT INTO admins (pseudo, email, password, dateInscription, token) VALUES (:pseudo,:email,:password,NOW(),:token)");

        $req->bindValue(':pseudo', htmlspecialchars($admins->getPseudo()), \PDO::PARAM_STR);
        $req->bindValue(':email', htmlspecialchars($admins->getEmail()), \PDO::PARAM_STR);
        $req->bindValue(':password', password_hash($admins->getPassword(), PASSWORD_DEFAULT), \PDO::PARAM_STR);
        $req->bindValue(':token',$admins->getToken(),\PDO::PARAM_STR);
        $req->execute();

    }

    /**
     * @param Admins $admins
     */
    public function UpDateAdmin(Admins $admins)
    {
        $req = $this->getConnexion()->prepare("UPDATE admins SET email=:email, password=:password WHERE pseudo=:pseudo");

        $req->bindValue(':pseudo', htmlspecialchars($admins->getPseudo()), \PDO::PARAM_STR);
        $req->bindValue(':email', htmlspecialchars($admins->getEmail()), \PDO::PARAM_STR);
        $req->bindValue(':password', password_hash($admins->getPassword(), PASSWORD_DEFAULT), \PDO::PARAM_STR);

        $req->execute();
    }

    /**
     * @param $tables
     *
     * @return mixed
     */
    public function InTable($tables)
    {
        foreach ($tables as $table) {

            $req = $this->getConnexion()->query("SELECT COUNT(id) FROM $table");
            $req->execute();

            return $req->fetch();
        }
    }

    /**
     *
     */
    public function createToken()
    {
       return bin2hex(random_bytes(64));

    }
}
