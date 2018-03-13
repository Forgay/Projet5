<?php


namespace gthareau\Entity;


class Admins
{
    protected $id;
    protected $pseudo;
    protected $email;
    protected $password;
    protected $dateinscription;

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
        $this->pseudo = $pseudo;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function setDateinscription($dateinscription)
    {
        $this->dateinscription = $dateinscription;
    }
}
