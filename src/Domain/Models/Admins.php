<?php


namespace Src\Domain\Models;

class Admins
{
    protected $pseudo;
    protected $email;
    protected $password;

    public function __construct(string $pseudo, string $email, string $password)
    {
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
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

    public function setPseudo($pseudo)
    {
        if (!preg_match('#^¨[a-zA-Z0-9].{3,20}$#', $pseudo)) {

            $this->errors[] = self::INVALID_PSEUDO;
        } else {
            $this->pseudo = $pseudo;
        }
    }

    public function setEmail($email)
    {
        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $this->errors[] = self::INVALID_EMAIL;
        } else {
            $this->email = $email;
        }
    }

    public function setPassword($password)
    {
        if (!preg_match('#(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9]).{8,20}"', $password)) {
            $this->errors[] = self::INVALID_PASSWORD;
        } else {
            $this->password = $password;
        }
    }
}
