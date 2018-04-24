<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\Request;
use Swift_Mailer;
use Swift_Message;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;
use App\Services\ContactBuilder;


class ContactAction
{
    private $request;
    private $session;
    private $mailer;
    private $contactBuilder;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->contactBuilder = new ContactBuilder();
        $this->session = new Session();

    }

    public function __invoke()
    {
        {
            $this->contactBuilder->build(
                $this->request->get('firstname'),
                $this->request->get('lastname'),
                $this->request->get('email'),
                $this->request->get('message')
            );


            if (empty($firstname) || empty($lastname) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
                if (empty($firstname)) {
                    $this->session->getFlashBag()->add('Nom', 'Attention : Votre nom n\'est pas rempli !');
                } elseif (empty($lastname)) {
                    $this->session->getFlashBag()->add('lastname', 'Attention : Votre prenom n\'est pas rempli!');
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $this->session->getFlashBag()->add('emailInvalid', "Votre email est invalide");
                } else {

                    $message = new Swift_Message();

                    $message->setFrom('smtp.sendgrid.net,25');
                    $message->setTo('gthareau1@gmail.com');
                    $message->setBody(
                        '<h4> Demande de ' . $firstname . '</h4>
                        <p>' . nl2br($message) . '</p>',
                        'text/html'
                    );
                    $this->mailer = new Swift_Mailer();
                    $this->mailer->send($message);

                    $response = new RedirectResponse('/', $this->session->getFlashBag()->add('emailvalid', "Mail Reçu"));
                    return $response->send();

                }
            }
        }
    }


}
