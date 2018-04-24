<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeAction
{
    private $postManager;

    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->postManager = new PostManager();

    }

    public function __invoke()
    {

        $response = new Response(
            TwigService::getTwig()->render('ListPostView.html.twig',[
                'posts'=> $this->postManager->getPosts()
            ]));
       return $response->send();
    }
}
