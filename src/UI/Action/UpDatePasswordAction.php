<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminsBuilder;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Services\ValidatorService;

class UpDatePasswordAction
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
     * @var ValidatorService
     */
    private $validator;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->adminsManager = new AdminsManager();
        $this->adminsBuilder = new AdminsBuilder();
        $this->session = new Session();
        $this->validator = new ValidatorService();
    }

    /**
     * Check if the fields is validate and update admins
     *
     * @return RedirectResponse
     */
    public function __invoke()
    {
        if ($this->request->get('password') === $this->request->get('passwordVerif')) {
            $this->adminsBuilder->build(
                $this->request->get('pseudo'),
                $this->request->get('email'),
                $this->request->get('password'),
                '',
                $this->adminsManager->createToken()
            );
            $this->adminsManager->UpDateAdmin($this->adminsBuilder->getAdmins());
            $this->session->getFlashBag()->add('MotPasse', 'Mot de passe modifié!');
            $response = new RedirectResponse('/connect');
            return $response->send();
        } else {
            $this->session->getFlashBag()->add('ErreurPassword', 'Attention : les mots de passe ne sont identiques !');
            $response = new RedirectResponse('/update/password', [
                'errorPass' => $this->session->getFlashBag()->get('ErreurPassword')
            ]);
            return $response->send();
        }
    }
}
