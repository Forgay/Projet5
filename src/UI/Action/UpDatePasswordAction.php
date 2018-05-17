<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminsBuilder;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;

class UpDatePasswordAction
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
                    $this->request->get('password'),
                    '',
                    $token

                );
                $this->adminsManager->UpDateAdmin($this->adminsBuilder->getAdmins());
                $this->session->getFlashBag()->add('MotPasse','Mot de passe modifié!');
                $response = new RedirectResponse('/connect');
                return $response->send();
            } else {
                $this->session->getFlashBag()->add('ErreurPassword', 'Attention : les mots de passe ne sont identiques !');
                $response = new RedirectResponse('/update/password',[
                    'message' => $this->session->getFlashBag()->get('ErreurPassword')
                ]);
                return $response->send();
            }
        }
        $this->session->getFlashBag()->add('Empty', 'Attention : Tous les champs ne sont pas remplis !');
        $response = new RedirectResponse('/update/password',[
         'message' => $this->session->getFlashBag()->get('Empty')
        ]);
        return $response->send();
    }
}
