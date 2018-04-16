<?php


namespace Src\UI\Action;

use Src\Domain\Managers\AdminsManager;
use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EnrollAction
{
    private $adminManager;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->adminManager = new AdminsManager();
    }

    public function __invoke()
    {
        $pseudo = htmlspecialchars($this->request->get('pseudo'));
        $email = htmlspecialchars($this->request->get('email'));
        $password = htmlspecialchars($this->request->get('password'));
        $passwordverif = htmlspecialchars($this->request->get('passwordverif'));

        if (isset($_SESSION['connecte']) && $_SESSION['connecte'] == true) {

            $response = new Response(
                TwigService::getTwig()->render('RegisterView.html.twig', [
                    'posts' => $this->adminManager->addAdmin($pseudo, $email, $password)
                ])
            );
            return $response->send();

        }

    }
}