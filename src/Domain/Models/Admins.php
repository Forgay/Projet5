<?php


namespace Src\Domain\Models;

use App\Bdd\Manager;

class Admins extends Manager
{
    protected $id;
    protected $pseudo;
    protected $email;
    protected $password;
    protected $passwordVerif;
    protected $dateInscription;

    public function __construct(
        string $id,
        string $pseudo,
        string $email,
        string $password,
        string $passwordVerif,
        string $dateInscription
    ) {
        $this->id = $id;
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->passwordVerif = $passwordVerif;
        $this->dateInscription =$dateInscription;

    }

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

    public function getPasswordVerif()
    {
        return $this->passwordVerif;
    }

    public function getDateInscription()
    {
        return $this->dateInscription;
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

    public function setDateInscription($dateInscription)
    {
        $this->dateInscription = $dateInscription;
    }
}
