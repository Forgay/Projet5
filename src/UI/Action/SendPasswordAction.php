<?php

namespace Src\UI\Action;

use App\Services\ResetContactService;
use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminsBuilder;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
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

        if ($violations = $this->validator->validator($this->request->request->all(), ['is_string', 'email', 'empty'])){
            $this->session->getFlashBag()->add('violations', $violations['0']);
            return new RedirectResponse($this->request->getPathInfo());
        }
        $this->session->getFlashBag()->add('message','mail envoyé');
            $this->adminsBuilder->getAdmins();
            $this->resetContactService = new ResetContactService($this->adminsBuilder->getAdmins());
            $response = new RedirectResponse('/connect');

            return $response->send();

    }
}