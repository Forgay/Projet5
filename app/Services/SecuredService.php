<?php


namespace App\Services;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class SecuredService
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function catchSecured($secured, $admin)
    {

        if ($secured && $admin === null) {
            $this->session->getFlashBag()->add('warning', 'Merci de vous inscrire !');
            $response = new Response(TwigService::getTwig()->render('ConnectView.html.twig',
                ['warning' => $this->session]
            ));
            return $response->send();
        }
    }
}
