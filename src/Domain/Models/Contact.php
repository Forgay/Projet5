<?php

namespace Src\Domain\Models;

class contact

{
    private $firstname;
    private $lastname;
    private $email;
    private $message;

    public function __construct(
        string $firstname,
        string $lastname,
        string $email,
        string $message
    )
    {
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->email = $email;
        $this->message = $message;

    }

    public function getFirstname()
    {
        return $this->firstname;
    }

    public function getLastname()
    {
        return $this->lastname;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getMessage()
    {
        return $this->message;
    }
}
