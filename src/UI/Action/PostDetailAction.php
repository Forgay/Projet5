<?php


namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\CommentManager;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Response;

class PostDetailAction
{
    private $postManager;
    private $commentManager;

    public function __construct()
    {
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    public function __invoke($id)
    {

        return new Response(
            TwigService::getTwig()->render('postView.html.twig', [
                'post' => $this->postManager->getPost($id),
                'comments' => $this->commentManager->getCommentById($id)
            ])
        );
    }

}

