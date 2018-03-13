<?php


namespace gthareau;


class Manager
{

    protected $db;

    public function __construct()
    {
        try {
            $this->setDb(new \PDO('mysql:dbname=blog; host=localhost', 'root', '', array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)));
        } catch (Exception $e) {
            die('erreur :' . $e->getMessage());
        }

    }

    public function setDb()
    {
        return $this->db;
    }

    public function getDb($db)
    {
        return $this->$db;
    }

}