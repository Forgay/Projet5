<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\CommentManager;
use Src\Domain\Managers\PostManager;
use Src\Domain\Managers\AdminsManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class DashboardAction
{
    private $commentManager;
    private $postManager;
    private $request;
    private $session;
    private $adminsManager;


    public function __construct(Request $request)
    {

        $this->request = $request;
        $this->commentManager = new CommentManager();
        $this->postManager = new PostManager();
        $this->adminsManager = new AdminsManager();
        $this->session = new Session();

    }

    public function __invoke()
    {

            $response = new Response(
                TwigService::getTwig()->render('DashboardView.html.twig', [
                        'comment' => $this->commentManager->getComments()
                    ]
                ));

        return $response->send();

    }
}
