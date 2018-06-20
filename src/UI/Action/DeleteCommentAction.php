<?php

namespace Src\UI\Action;

use Src\Domain\Managers\CommentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;

class DeleteCommentAction
{
    /**
     * @var CommentManager
     */
    private $commentManager;

    /**
     * @var Request
     */
    private $request;

    /**
     * DeleteCommentAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->commentManager = new CommentManager();

    }

    /**
     *
     * Delete comment and redirection to dashboard
     *
     * @return RedirectResponse
     */
    public function __invoke()
    {
        $this->commentManager->delComment($this->request->attributes->get(0));
        $response = new RedirectResponse('/dashboard');
        return $response->send();
    }
}
