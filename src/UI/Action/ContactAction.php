<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Services\ContactService;

class ContactAction
{
    private $request;
    private $session;
    private $contactService;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->session = new Session();

    }

    public function __invoke()
    {

                if (empty($this->request->get('firstname')) || empty($this->request->get('lastname')) || !filter_var($this->request->get('email'), FILTER_VALIDATE_EMAIL) || empty($this->request->get('message'))) {
                if (empty($this->request->get('firstname'))) {
                    $this->session->getFlashBag()->add('Nom', 'Attention : Votre nom n\'est pas rempli !');
                } elseif (empty($this->request->get('lastname'))) {
                    $this->session->getFlashBag()->add('lastname', 'Attention : Votre prenom n\'est pas rempli!');
                } elseif (!filter_var($this->request->get('email'), FILTER_VALIDATE_EMAIL)) {
                    $this->session->getFlashBag()->add('emailInvalid', "Votre email est invalide");
                } else {

                    $this->contactService = new ContactService($this->request);
                    $response = new RedirectResponse('/', $this->session->getFlashBag()->add('emailvalid', "Mail Reçu"));
                    return $response->send();

                }
            }
        }



}
