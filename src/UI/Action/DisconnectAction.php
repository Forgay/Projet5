<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DisconnectAction
{
    private $session;

    public function __construct()
    {
        $this->session = new Session();
    }

    public function __invoke()
    {
        $response = new RedirectResponse('/');
        $this->session->invalidate();
        $this->session->getFlashBag()->add('Disconnect','Au revoir, à la prochaine');
        return $response->send();
    }
}
