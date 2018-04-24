<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Src\Domain\Managers\AdminsManager;
use App\Services\AdminsBuilder;
use Symfony\Component\HttpFoundation\Session\Session;

class RegisterAction
{
    private $adminsManager;
    private $request;
    private $adminsBuilder;
    private $session;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->session = new Session();
        $this->session->start();
        $this->adminsManager = new AdminsManager();
        $this->adminsBuilder = new AdminsBuilder();
    }
    public function __invoke()
    {
        if (!empty($this->request->get('pseudo')) && !empty($this->request->get('email')) && !empty($this->request->get('password') && !empty($this->request->get('passwordVerif')))) {
            $this->adminsBuilder->build(
                $id = null,
                $this->request->get('pseudo'),
                $this->request->get('email'),
                $this->request->get('password'),
                $this->request->get('passwordVerif'),
                $dateInscription = null
            );

            $this->adminsManager->addAdmin($this->adminsBuilder->getAdmins());

            $response = new RedirectResponse('/connect');
            return $response->send();
        } else {
            $this->session->getFlashBag()->add('empty','Attention : Tous les champs ne sont pas remplis !');
        }
    }
}
