<?php


namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Response;

class ShowPostAction
{

    private $postManager;

    public function __construct()
    {

        $this->postManager = new PostManager();
    }

    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('ShowPostView.html.twig',[
                'posts'=> $this->postManager->getPosts()
            ])
        );
        return $response->send();
    }
}