<?php

namespace Src\UI\Action;

use App\Services\TwigService;
use Src\Domain\Managers\PostManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Services\PostBuilder;

class UpdatePostAction
{
    private $postManager;
    private $request;
    private $postBuilder;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->postManager = new PostManager();
        $this->postBuilder = new PostBuilder();
    }

    public function __invoke()
    {
        $this->postBuilder->build(
            $this->request->attributes->get(0),
            $this->request->get('title'),
            $this->request->get('content'),
            $this->request->get('posted'));

        $response = new Response(
            TwigService::getTwig()->render('UpdatePostView.html.twig', [
                'post' => $this->postManager->updatePost(
                    $this->postBuilder->getPost()
                )
            ])
        );
        return $response->send();
    }
}
