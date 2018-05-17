<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminsBuilder;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\SessionBagInterface;
use Symfony\Component\HttpFoundation\Response;
use Src\Domain\Models\Admins;

class ConnectingAction
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var AdminsManager
     */
    private $adminsManager;

    /**
     * @var AdminsBuilder
     */
    private $adminsBuilder;

    /**
     * @var Session
     */
    private $session;

    /**
     * ConnectingAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->adminsManager = new AdminsManager();
        $this->adminsBuilder = new AdminsBuilder();
        $this->session = new Session();
    }

    /**
     * Check if he is an administrator and sends or redirects
     *
     * @return Response
     */
    public function __invoke()
    {

        if (!empty($this->request->get('pseudo')) && !empty($this->request->get('email')) && !empty($this->request->get('password'))) {

            $this->adminsBuilder->build(
                $this->request->get('pseudo'),
                $this->request->get('email'),
                $this->request->get('password'),
                '',
                $this->adminsManager->createToken()


            );

            if($this->adminsManager->isAdmin($this->adminsBuilder->getAdmins())){
                $admin= $this->adminsManager->getAdmin($this->adminsBuilder->getAdmins());
                $response = new RedirectResponse('/dashboard');
                $this->session->set('admin',$this->adminsBuilder->buildForSession($admin)->getAdmins());

                return $response->send();

            } else {
                $this->session->getFlashBag()->add('error', 'Attention : les mots de passe ne sont identiques !');

                $response = new Response(
                    TwigService::getTwig()->render('ConnectView.html.twig',[
                      'error'=> $this->session->getFlashBag()->get('error')
                    ]));
                return $response->send();
            }
        }
        $this->session->getFlashBag()->add('Empty', 'Attention : Tous les champs ne sont pas remplis !');
        $response = new Response(
           TwigService::getTwig()->render('ConnectView.html.twig',[
              'error'=>$this->session->getFlashBag()->get('Empty')
          ])
        );
        return $response->send();
    }
}
