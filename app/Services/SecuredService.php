<?php


namespace App\Services;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class SecuredService
{
    public function catchSecured($secured, SessionInterface $session)
    {
        if ($secured && $session->get('admin') === null) {
            $response = new RedirectResponse('/connecting');
            return $response->send();
        }
    }
}
