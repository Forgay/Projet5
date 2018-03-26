<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Response;

class HomeAction
{
    private $postManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
    }

    public function __invoke()
    {
        return new Response(
            TwigService::getTwig()->render('listPostView.html.twig', [
                'posts'=> $this->postManager->getPosts()
            ])
        );
    }
}
