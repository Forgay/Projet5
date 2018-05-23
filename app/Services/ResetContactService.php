<?php

namespace App\Services;

use Swift_Mailer;
use Swift_Message;
use Src\Domain\Models\Admins;

class ResetContactService
{
    /**
     * @var Admins
     */
    private $admins;
    /**
     * @var
     */
    private $mailer;

    /**
     * @var array
     */
    private $config = [];

    public function __construct(Admins $admins)
    {
        $this->admins = $admins;
        $this->loadConfig();
    }

    public function loadConfig()
    {
        $this->config = require __DIR__ . './../../Config/mailer.php';
    }

    public function sendMail()

    {
        $transport = (new \Swift_SmtpTransport($this->config['host'], $this->config['port'], $this->config['encryption']))
            ->setUsername($this->config['username'])
            ->setPassword($this->config['password']);
        //
        $this->mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Reinitialisation mot de passe'))
            ->setFrom('gthareau1@gmail.com')
            ->setTo($this->contact->getEmail())
            ->setBody(
                '<h4> Demande de ' . $this->contact->getFirstname() . '</h4>
                        <p> lien pour réinitialiser votre mot de passe. /reset/password </p>',
                'text/html'
            );
        $this->mailer->send($message);
    }
}
