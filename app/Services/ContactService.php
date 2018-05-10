<?php

namespace App\Services;

use Swift_Mailer;
use Swift_Message;
use Symfony\Component\HttpFoundation\Request;

class ContactService
{
    private $request;
    private $mailer;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function __invoke()
    {
        $transport = (new \Swift_SmtpTransport('smtp.sendgrid.net', 25))
            ->setUsername('apikey')
            ->setPassword('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');
        //
        $this->mailer = new Swift_Mailer($transport);

        $message = (new Swift_Message('Message du site'))
            ->setFrom('gthareau1@gmail.com')
            ->setTo($this->request->get('email'))
            ->setBody(
                '<h4> Demande de ' . $this->request->get('lastname') . '</h4>
                        <p>' . nl2br($this->request->get('message')) . '</p>',
                'text/html'
            );

        $this->mailer->send($message);

    }
}
