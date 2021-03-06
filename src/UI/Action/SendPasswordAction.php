<?php

namespace Src\UI\Action;

use App\Services\ResetContactService;
use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminsBuilder;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Services\ValidatorService;

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
     * @var ResetContactService
     */
    private $resetContactService;

    /**
     * @var ValidatorService
     */
    private $validator;

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
        $this->validator = new ValidatorService();
    }

    public function __invoke()
    {

        $this->adminsBuilder->buildForReset(
            htmlspecialchars($this->request->get('pseudo')),
            htmlspecialchars($this->request->get('email'))
        );


        $this->session->getFlashBag()->add('mailsend', 'mail envoyé');

        $this->resetContactService = new ResetContactService($this->adminsBuilder->getAdmins());
        $this->resetContactService->sendMail();
        $response = new RedirectResponse('/connect');

        return $response->send();

    }
}