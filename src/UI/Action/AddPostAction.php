<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class AddPostAction
{
    /**
     * @var
     */
    private $session;

    /**
     * Validate access to writing an article or redirect to Dashboard
     *
     * @return Response
     *
     */
    public function __invoke()
    {
        $this->session = new Session();
        $role = $this->session->get('admin')->getRole();

        if ($role === 'admin'){
            $response = new Response(
            TwigService::getTwig()->render('WritePostView.html.twig')
        );
            return $response->send();
        }else{
            $this->session->getFlashBag()->add('role', 'Attention : vous n\'avez pas le role !');
            $response = new Response(
                TwigService::getTwig()->render('DashboardView.html.twig',[
                    'role'=>$this->session->getFlashBag()->get('role')
                ]));
            return $response->send();
        }
    }
}
