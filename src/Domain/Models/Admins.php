<?php


namespace Src\Domain\Models;

class Admins
{
    /**
     * @var string
     */
    protected $pseudo;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $role;
    /**
     * @var string
     */
    protected $token;

    /**
     * Admins constructor.
     *
     * @param string $pseudo
     * @param string $email
     * @param string $password
     * @param string $role
     * @param string $token
     */
    public function __construct(
        string $pseudo,
        string $email,
        string $password,
        string $role,
        string $token
    )
    {
        $this->pseudo = $pseudo;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
        $this->token = $token;
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

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    public function getToken()
    {
        return $this->token;
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

    public function setToken($token)
    {
        $this->token = $token;
    }
}
