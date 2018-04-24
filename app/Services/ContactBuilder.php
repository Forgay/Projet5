<?php

namespace App\Services;

use Src\Domain\Models\Contact;

class ContactBuilder
{
    private $contact;

    public function build(string $firstname,
                          string $lastname,
                          string $email,
                          string $message
    )
    {
        $this->contact = new Contact($firstname,$lastname,$email,$message);
    }

    public function getContact()
    {
        return $this->contact;
    }
}
