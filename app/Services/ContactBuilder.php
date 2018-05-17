<?php
/**
 * Created by PhpStorm.
 * User: Guillaume
 * Date: 12/05/2018
 * Time: 14:55
 */

namespace App\Services;

use Src\Domain\Models\Contact;

class ContactBuilder
{
    /**
     * @var
     */
    private $contact;

    /**
     * @param string $firstname
     * @param string $lastname
     * @param string $email
     * @param string $message
     */
    public function buildContact(string $firstname,
                                 string $lastname,
                                 string $email,
                                 string $message

    )
    {
        $this->contact = new Contact($firstname, $lastname,$email,$message);
    }

    /**
     * @return mixed
     */
    public function getContact()
    {
        return $this->contact;
    }
}