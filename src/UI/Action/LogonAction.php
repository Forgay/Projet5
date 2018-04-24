<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminsBuilder;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class LogonAction
{
    private $request;
    private $adminsManager;
    private $adminsBuilder;
    private $session;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->adminsManager = new AdminsManager();
        $this->adminsBuilder = new AdminsBuilder();
        $this->session = new Session();
    }

    public function __invoke()
    {

        if (!empty($this->request->get('pseudo')) && !empty($this->request->get('email')) && !empty($this->request->get('password')) && !empty($this->request->get('passwordVerif'))) {
            if ($this->request->get('password') === $this->request->get('passwordVerif')) {
                $this->adminsBuilder->build(
                    $this->request->get('pseudo'),
                    $this->request->get('email'),
                    $this->request->get('password')

                );
                $this->adminsManager->addAdmin($this->adminsBuilder->getAdmins());
                $response = new RedirectResponse('/connect');
                return $response->send();
            } else {
                $this->session->getFlashBag()->add('Erreur_password', 'Attention : les mots de passe ne sont identiques !');
            }
        }
        $this->session->getFlashBag()->add('Empty', 'Attention : Tous les champs ne sont pas remplis !');
    }
}