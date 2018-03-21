<?php


namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\CommentManager;
use Src\Domain\Managers\PostManager;

class PostDetailAction
{
    public function __invoke($id)
    {

        return $this->getTwig()->render('postView.html.twig', ['post' => PostManager::getPost($id),
            'comments'=>CommentManager::getCommentById($id)]);
    }

}

