<?php

namespace Src\UI\Action;

use Src\Domain\Managers\CommentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class DeleteCommentAction
{
    private $commentManager;
    private $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->commentManager = new CommentManager();

    }

    public function __invoke()
    {
        $this->commentManager->delComment($this->request->attributes->all());
        $response = new RedirectResponse('/dashboard');
        return $response->send();
    }
}
