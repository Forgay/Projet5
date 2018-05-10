<?php

namespace Src\UI\Action;

use App\Services\ResetContactService;
use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminsBuilder;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;

class SendPasswordAction
{
    private $request;
    private $adminsManager;
    private $adminsBuilder;
    private $session;
    private $resetContactService;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->adminsManager = new AdminsManager();
        $this->session = new Session();
        $this->adminsBuilder = new AdminsBuilder();
    }

    public function __invoke()
    {
        $this->adminsBuilder->buildForReset(
            htmlspecialchars($this->request->get('pseudo')),
            htmlspecialchars($this->request->get('email'))
        );

        dump($this->adminsManager->getAdmin($this->adminsBuilder->getAdmins()));

        if (empty($this->request->get('pseudo')) || empty($this->request->get('email')))
        {
            $this->session->getFlashBag()->add('erreur', 'Attention :un champ n\'est pas rempli ');
        } elseif ($this->adminsManager->getAdmin($this->adminsBuilder->getAdmins()) != false )
        {
            $this->session->getFlashBag()->add('message envoyee','mail envoyé');
            $data = $this->adminsManager->getAdmin($this->adminsBuilder->getAdmins());
            $this->resetContactService = new ResetContactService($data['pseudo'],$data['email']);
            $response = new RedirectResponse('/connect', $this->session);
            return $response->send();
        }
    }
}