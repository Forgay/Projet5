<?php

namespace App\Bdd;

class Manager
{
    private $conf;

    public function __construct()
    {
        $this->loadConf();
        $this->getConnexion();
    }

    public function loadConf()
    {
        $this->conf = require __DIR__.'./../../Config/confDb.php';
    }

    public function getConnexion()
    {
        try{
            $db = new \PDO('mysql:dbname='.$this->conf['db'].';host='.$this->conf['machine'], $this->conf['user'] , $this->conf['password']);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\Exception $e){
            die ('<p>Erreur :'.$e->getMessage().'</p>');
        }
        return $db;
    }
}