<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeAction
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
     * HomeAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->postManager = new PostManager();
    }

    /**
     * Displays the home page and shows the articles
     *
     * @return Response
     */
    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('ListPostView.html.twig',[
                'posts'=> $this->postManager->getPosts()
            ]));
       return $response->send();
    }
}
