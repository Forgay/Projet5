<?php


namespace Src\Domain\Models;

use App\Bdd\Manager;

class Admins extends Manager
{
    protected $id;
    protected $pseudo;
    protected $email;
    protected $password;
    protected $dateinscription;

    const INVALID_PSEUDO = 'Le nom d\'utilisateur doit comprendre de 3 à 20 caractères alphanumériques.';
    const INVALID_EMAIL = 'l\'email saisis semble ne pas être valide.';
    const INVALID_PASSWORD = 'Le mot de passe doit être composé de 8 à 20 caractères, et doit contenir au moins 1 lettre majuscule, 1 lettre minuscule et 1 chiffre. ';

    public function getId()
    {
        return $this->id;
    }

    public function getPseudo()
    {
        return $this->pseudo;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getDateinscription()
    {
        return $this->dateinscription;
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function setPseudo($pseudo)
    {
        if(!preg_match('#^¨[a-zA-Z0-9].{3,20}$#',$pseudo )){

            $this->errors[] =  self::INVALID_PSEUDO;
        }else {
            $this->pseudo = $pseudo;
        }
    }

    public function setEmail($email)
    {
        if (empty($email)||!filter_var($email,FILTER_VALIDATE_EMAIL)){
            $this->errors[]= self::INVALID_EMAIL;
        }else{
        $this->email = $email;
        }
    }

    public function setPassword($password)
    {
        if (!preg_match('#(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,20}"',$password)){
            $this->errors[]= self::INVALID_PASSWORD;
        }else {
            $this->password = $password;
        }
    }

    public function setDateinscription($dateinscription)
    {
        $this->dateinscription = $dateinscription;
    }
}
