<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminsBuilder;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Response;
use App\Services\ValidatorService;

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
     * @var ValidatorService
     */
    private $validator;

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
        $this->validator = new ValidatorService();
    }

    /**
     * Check if he is an administrator and sends or redirects
     *
     * @return Response
     */
    public function __invoke()
    {

        if (empty($this->request->request->all())) {
            $this->session->getFlashBag()->add('vides', 'Les champs sont vides');
            $response = new RedirectResponse('/connect');
            return $response->send();
        }
        $this->request->request->remove('submit');
        $violations = $this->validator->validate($this->request->request->all(), ['empty', 'is_string']);

        if (\count(array_values($violations)) > 0) {
            foreach ($violations as $key => $value) {
                foreach ($value as $item => $val) {
                    $this->session->getFlashBag()->add($key, $val);
                }
            }
            $response = new RedirectResponse('/connect');
            return $response->send();
        }

        $this->adminsBuilder->build(
            htmlspecialchars($this->request->get('pseudo')),
            htmlspecialchars($this->request->get('email')),
            htmlspecialchars($this->request->get('password')),
            '',
            $this->adminsManager->createToken()
        );

        if ($this->adminsManager->isAdmin($this->adminsBuilder->getAdmins())) {
            $admin = $this->adminsManager->getAdmin($this->adminsBuilder->getAdmins());
            $response = new RedirectResponse('/dashboard');
            $this->session->set('admin', $this->adminsBuilder->buildForSession($admin)->getAdmins());

            return $response->send();

        } else {
            $this->session->getFlashBag()->add('error', 'Attention : les mots de passe ne sont pas identiques !');

            $response = new Response(
                TwigService::getTwig()->render('ConnectView.html.twig', [
                    'error' => $this->session->getFlashBag()->get('error')
                ]));
            return $response->send();
        }
    }
}
