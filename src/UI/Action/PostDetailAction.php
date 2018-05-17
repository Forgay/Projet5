<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\CommentManager;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostDetailAction
{
    /**
     * @var PostManager
     */
    private $postManager;

    /**
     * @var CommentManager
     */
    private $commentManager;

    /**
     * @var Request
     */
    private $request;

    /**
     * PostDetailAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    public function __invoke()
    {
           $response = new Response(
            TwigService::getTwig()->render('PostView.html.twig', [
                'post' => $this->postManager->getPost($this->request->attributes->all()),
                'comments' => $this->commentManager->getCommentById($this->request->attributes->all())
            ])
        );
         return $response->send();
    }
}

