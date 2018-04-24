<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminsBuilder;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class ConnectingAction
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

        if (!empty($this->request->get('pseudo')) && !empty($this->request->get('email')) && !empty($this->request->get('password'))) {

            $this->adminsBuilder->build(
                $this->request->get('pseudo'),
                $this->request->get('email'),
                $this->request->get('password')
            );

            if($this->adminsManager->isAdmin($this->adminsBuilder->getAdmins())){
                $response = new RedirectResponse('/dashboard');
                $this->session->set('admin',$this->adminsBuilder->getAdmins());
                return $response->send();

            } else {
                $this->session->getFlashBag()->add('Erreur_password', 'Attention : les mots de passe ne sont identiques !');

                $response = new Response(
                    TwigService::getTwig()->render('ConnectView.html.twig',[
                     'error' => $this->session
                    ]));
                return $response->send();
            }
        }
        $this->session->getFlashBag()->add('Empty', 'Attention : Tous les champs ne sont pas remplis !');
    }
}
