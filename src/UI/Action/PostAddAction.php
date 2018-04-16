<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostAddAction
{
    private $postManager;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->postManager = new PostManager();
    }

    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('WritePost.html.twig',[
                'posts'=> $this->postManager->addPost(
                    $this->request->get('title'),
                    $this->request->get('content'),
                    $this->request->get('posted')
                )
            ])
        );
        return $response->send();
    }
}