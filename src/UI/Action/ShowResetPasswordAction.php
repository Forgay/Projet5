<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class ShowResetPasswordAction
{
    /**
     * @var Session
     */
    private $session;
    /**
     * @var Request
     */
    private $request;

    /**
     * @var AdminsManager
     */
    private $adminsManager;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->adminsManager = new AdminsManager();
    }

    public function __invoke()
    {

        if ($this->adminsManager->isToken($this->request->attributes->get(0))) {
            $response = new Response(
                TwigService::getTwig()->render('UpDatePassword.html.twig'));
            return $response->send();
        }
        $this->session->getFlashBag()->add('acces', 'Merci de me contacter !');
    }
}
