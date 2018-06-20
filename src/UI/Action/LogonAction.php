<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use App\Services\AdminsBuilder;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Services\ValidatorService;

class LogonAction
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
     * LogonAction constructor
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

    public function __invoke()
    {
        if (empty($this->request->request->all())){
            $this->session->getFlashBag()->add('vides', 'les champs sont vides');
            $response = new RedirectResponse("/login");
            return $response->send();
        }

        $this->request->request->remove('submit');
        $violations = $this->validator->validate($this->request->request->all(),['empty','is_string']);

        if (\count(array_values($violations)) > 0) {

            foreach ($violations as $key => $value) {
                foreach ($value as $item => $val) {
                    $this->session->getFlashBag()->add($key, $val);
                }
            }

            $response = new RedirectResponse("/login");
            return $response->send();
        }

       if ($this->request->get('password') === $this->request->get('passwordVerif')) {
            $this->adminsBuilder->build(
                $this->request->get('pseudo'),
                $this->request->get('email'),
                $this->request->get('password'),
                '',
                $this->adminsManager->createToken()
            );

            $this->adminsManager->addAdmin($this->adminsBuilder->getAdmins());
            $this->session->getFlashBag()->add('Inscrit', 'Inscription OK !');
            $response = new RedirectResponse('/connect');
            return $response->send();

        } else {

            $this->session->getFlashBag()->add('Erreur_password', 'Attention : les mots de passe ne sont pas identiques !');

            $response = new Response(
                TwigService::getTwig()->render('ConnectView.html.twig', [
                'message' => $this->session->getFlashBag()->get('Erreur_password')
            ]));
            return $response->send();
        }

    }
}
