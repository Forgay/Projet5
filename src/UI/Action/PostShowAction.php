<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class PostShowAction
{
    /**
     * @var PostManager
     */
    private $postManager;

    /**
     * @var Request
     */
    private $request;

    /**
     * @var Session
     */
    private $session;

    /**
     * PostShowAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->postManager = new PostManager();
        $this->session = new Session();
    }

    public function __invoke()
    {
        $role = $this->session->get('admin')->getRole();
        if ($role === 'admin') {
            $response = new Response(
                TwigService::getTwig()->render('UpdatePostView.html.twig', [
                    'post' => $this->postManager->getPost($this->request->attributes->all()),
                ])
            );
            return $response->send();
        } else {
            $this->session->getFlashBag()->add('role', 'Attention : vous n\'avez pas le role !');
            $response = new Response(
                TwigService::getTwig()->render('DashboardView.html.twig',[
                    'role' => $this->session->getFlashBag()->get('role')
                ]));
            return $response->send();
        }
    }
}
