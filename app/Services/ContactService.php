<?php

namespace App\Services;

use Swift_Mailer;
use Swift_Message;
use Src\Domain\Models\Contact;

class ContactService
{
    /**
     * @var Contact
     */
    private $contact;

    /**
     * @var
     */
    private $mailer;

    /**
     * @var array
     */
    private $config = [];

    public function __construct(Contact $contact)
    {
        $this->contact = $contact;
        $this->loadConfig();
    }

    public function loadConfig()
    {
        $this->config = require __DIR__.'./../../Config/mailer.php';
    }

    public function sendMail()
    {
        $transport = (new \Swift_SmtpTransport($this->config['host'], $this->config['port'], $this->config['encryption']))
            ->setUsername($this->config['username'])
            ->setPassword($this->config['password']);

        $this->mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Message du site'))
            ->setFrom('gthareau1@gmail.com')
            ->setTo($this->contact->getEmail())
            ->setBody(
                '<h4> Demande de ' . $this->contact->getFirstname() . '</h4>
                        <p>' . nl2br($this->contact->getMessage()) . '</p>',
                'text/html'
            );
        $this->mailer->send($message);
    }
}
