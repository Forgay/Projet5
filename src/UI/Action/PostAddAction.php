<?php

namespace Src\UI\Action;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Src\Domain\Managers\PostManager;
use App\Services\PostBuilder;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class PostAddAction
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
        if (!empty($this->request->get('nom')) && !empty($this->request->get('email')) && !empty($this->request->get('content'))) {
            $this->postBuilder->build(
                $this->request->get('title'),
                $this->request->get('content'),
                $this->request->get('posted'),
                $this->request->get('writer'),
                $this->request->get('dateModify'),
                $this->request->get('posted')
            );
            $this->postManager->addPost($this->postBuilder->getPost());
            $response = new RedirectResponse('/post/add');
            return $response->send();
        } else {
            $this->session->getFlashBag()->add('Empty', 'Attention : Tous les champs ne sont pas remplis !');
        }
    }
}