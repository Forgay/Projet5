<?php


namespace Core\Bdd;


class Manager
{
    private $conf;

    public function __construct()
    {
        $this->loadConf();
        $this->getConnection();
    }

    public function loadConf()
    {
        $this->conf = require __DIR__.'./../Config/confDb.php';
    }

    public function getConnexion()
    {
        try{
            $db = new \PDO('mysql:host='.$this->conf['machine'].'; dbname='. $this->conf['db'] .';charset=utf8', $this->conf['user'], $this->conf['password'], array(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION));
        } catch (\Exception $e){
            die ('<p>Erreur :'.$e->getMessage().'</p>');
        }
        return $db;
    }
}