<?php

namespace Src\Domain\Models;

class Contact

{
    /**
     * @var string
     */
    private $firstname;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $message;

    /**
     * contact constructor.
     *
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $message
     */
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
