<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Src\Domain\Managers\AdminsManager;
use App\Services\AdminsBuilder;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Services\ValidatorService;

class RegisterAction
{
    /**
     * @var AdminsManager
     */
    private $adminsManager;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var AdminsBuilder
     */
    private $adminsBuilder;

    /**
     * @var Session
     */
    private $session;
    /**
     * @var ValidatorService
     */
    private $validator;

    /**
     * RegisterAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->session = new Session();
        $this->session->start();
        $this->adminsManager = new AdminsManager();
        $this->adminsBuilder = new AdminsBuilder();
        $this->validator = new ValidatorService();
    }

    public function __invoke()
    {



        $this->adminsBuilder->build(
            $this->request->get('pseudo'),
            $this->request->get('email'),
            $this->request->get('password'),
            $this->request->get('passwordVerif'),
            $dateInscription = null
        );

        $this->adminsManager->addAdmin($this->adminsBuilder->getAdmins());

        $response = new RedirectResponse('/connect');
        return $response->send();
    }

}
