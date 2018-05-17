<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DisconnectAction
{
    /**
     * @var Session
     */
    private $session;

    /**
     * DisconnectAction constructor.
     */
    public function __construct()
    {
        $this->session = new Session();
    }

    /**
     * Clears the Session and redirects to home
     *
     * @return RedirectResponse
     */
    public function __invoke()
    {
        $this->session->invalidate();
        $response = new RedirectResponse('/');
        return $response->send();
    }
}
