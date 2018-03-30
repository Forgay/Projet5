<?php


namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\CommentManager;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostDetailAction
{
    private $postManager;
    private $commentManager;
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->postManager = new PostManager();
        $this->commentManager = new CommentManager();
    }

    public function __invoke()
    {
        $response = new Response(
            TwigService::getTwig()->render('postView.html.twig', [
                'post' => $this->postManager->getPost($this->request->query->get('id')),
                'comments' => $this->commentManager->getCommentById($this->request->query->get('id'))
            ])
        );
        return $response->send();
    }
}

