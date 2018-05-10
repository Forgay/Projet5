<?php

namespace App\Services;

use Swift_Mailer;
use Swift_Message;
use Symfony\Component\HttpFoundation\Request;

class ResetContactService
{

    private $mailer;

    public function __construct($pseudo,$email)
    {
        $this->pseudo = $pseudo;
        $this->email = $email;
    }
    public function __invoke()
    {
        $transport = (new \Swift_SmtpTransport('smtp.sendgrid.net', 25))
            ->setUsername('apikey')
            ->setPassword('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');
        //
        $this->mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Reinitialisation mot de passe'))
            ->setFrom('gthareau1@gmail.com')
            ->setTo($this->email)
            ->setBody(
                '<h4> Demande de ' . $this->pseudo . '</h4>
                        <p> lien pour réinitialiser votre mot de passe. /reset/password </p>',
                'text/html'
            );

        $this->mailer->send($message);

    }

}