<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\CommentManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DashboardAction
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
     * DashboardAction constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->commentManager = new CommentManager();
    }

    /**
     * Send the Dashboard View with uncommitted comments
     *
     * @return Response
     */
    public function __invoke()
    {
            $response = new Response(
                TwigService::getTwig()->render('DashboardView.html.twig', [
                        'comment' => $this->commentManager->getComments()
                    ]));
        return $response->send();
    }
}
