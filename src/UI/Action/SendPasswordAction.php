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
    /**
     * @var Request mixed
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
     * @var
     */
    private $resetContactService;

    /**
     * SendPasswordAction constructor.
     *
     * @param Request $request
     */
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


        if (empty($this->request->get('pseudo')) || empty($this->request->get('email')))
        {
            $this->session->getFlashBag()->add('erreur', 'Attention :un champ n\'est pas rempli ');
        } else
        {

            $this->session->getFlashBag()->add('message','mail envoyé');
            $data = $this->adminsBuilder->getAdmins();
            $this->resetContactService = new ResetContactService($data['pseudo'],$data['email']);
            $response = new RedirectResponse('/connect');

            return $response->send();
        }
    }
}